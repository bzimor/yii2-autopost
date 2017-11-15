<?php
namespace bzimor\autopost;

use app\models\ApiSettings;
use Facebook\Facebook;

/**
 * @author bzimor
 */
 class Apitest extends \yii\base\Component
 {



    public function fb_post($feed, $type='feed')
    {
        $fbk = ApiSettings::find()->where(['type' => 'fb'])->one();
        $fb = new Facebook([
         'app_id' => $fbk->api_id,
         'app_secret' => $fbk->api_secret,
         'default_graph_version' => 'v2.10'
        ]);
        $linkData['message'] = $feed['message'];

        $path = '/feed';


        $pageAccessToken = $fbk->access_token;

        try {
            $response = $fb->post('/'.$fbk->page_id.'/feed', $linkData, $pageAccessToken);
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
        $myFile = 'api_error_log_'.date('Y-m-d').'.txt';
        $fh = fopen($myFile, 'a') or die("can't open file");
        fwrite($fh, $curdate.' - '.$api.': '.$error."\n");
        fclose($fh);
    }
}
