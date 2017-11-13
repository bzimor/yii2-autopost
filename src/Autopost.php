<?php
define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__.'/Facebook/');
require_once(__DIR__.'/Facebook/autoload.php');

namespace bzimor\autopost;
use app\models\ApiSettings;


/**
 * @author bzimor
 */
class Autopost extends \yii\base\Component
{
    public $botToken = ApiSettings::find()->where(['api_type' => 'telegram'])->one()->bot_token;


    public function fb_post($feed, $type='feed')
    {
        $fb = new Facebook\Facebook([
         'app_id' => ApiSettings::find()->where(['api_type' => 'facebook'])->one()->app_id;,
         'app_secret' => ApiSettings::find()->where(['api_type' => 'facebook'])->one()->api_secret,
         'default_graph_version' => ApiSettings::find()->where(['api_type' => 'facebook'])->one()->api_ver,
        ]);

        if (isset($feed['message']) && $type != 'video') {
            $linkData['message'] = $feed['message'];
        }
        if (isset($feed['link']) && $type != 'video') {
                $linkData['link'] = $feed['link'];
        }
        if ($type == 'feed') {
            $path = '/feed';
        }
        elseif ($type == 'photo') {
            $path = '/photos';
            if (isset($feed['photo'])) {
                $linkData['url'] = base_url().$feed['photo'];
                if (isset($feed['link'])) {
                    $linkData['message'] .= "\n".$feed['link'];
                }
            }
        }
        elseif ($type == 'video') {
            $path = '/videos';
            if (isset($feed['video'])) {
                $linkData['description'] = $feed['message']."\n".$feed['link'];
                $linkData['source'] = $fb->fileToUpload(FCPATH.$feed['video']);
            }
        }

        $pageAccessToken = $this->fb_conf['ACCESS_TOKEN'];

        try {
            $response = $fb->post('/'.$this->fb_conf['PAGE_ID'].$path, $linkData, $pageAccessToken);
            return $response->getGraphNode();
        }
        catch(Facebook\Exceptions\FacebookResponseException $e) {
            $e_msg = 'Graph returned an error: '.$e->getMessage();
            $this->log_errors('facebook', $e_msg);
            return FALSE;
        }
        catch(Facebook\Exceptions\FacebookSDKException $e) {
            $e_msg = 'Facebook SDK returned an error: '.$e->getMessage();
            $this->log_errors('facebook', $e_msg);
            return FALSE;
        }
    }

    function tw_post($feed) {
        require_once(__DIR__.'/codebird/codebird.php');

        $img = FALSE;
        $text = $feed["message"];

        if(isset($feed["link"])){
            $text .= "\nhttp://".$feed["idlink"];
            if(mb_strlen($text, 'UTF-8')>140){
                $text = "http://".$feed["link"];
            }
        }
        $message = $text;
        if(isset($feed["photo"])){
            $imgf = pathinfo($feed['photo']);
            $image = "http://azon.uz".$imgf['dirname'].'/'.$imgf['filename'].'_710x399'.'.'.$imgf['extension'];
            $img = TRUE;
        }
        try {
            \Codebird\Codebird::setConsumerKey($this->tw_conf['API_KEY'], $this->tw_conf['API_SECRET']);
            $cb = \Codebird\Codebird::getInstance();
            $cb->setToken($this->tw_conf['ACCESS_TOKEN'], $this->tw_conf['TOKEN_SECRET']);

            $params = array(
                'status' => $message,
            );
            if($img){
                $reply = $cb->media_upload(array('media' => $image));
                $mediaID = $reply->media_id;
                $params['media_ids'] = $mediaID;
            }
            $reply = $cb->statuses_update($params);
        }
        catch(Exception $e) {
            $reply = FALSE;
            $e_msg = $e->getMessage();
            $this->log_errors('codebird', $e_msg);
        }
        return $reply;
    }

    public function log_errors($api, $error)
    {
        $curdate = date('d.m.Y h:i:s');
        $myFile = 'API-LOGS/api_error_log_'.date('Y-m-d').'.txt';
        $fh = fopen($myFile, 'a') or die("can't open file");
        fwrite($fh, $curdate.' - '.$api.': '.$error."\n");
        fclose($fh);
    }
}
