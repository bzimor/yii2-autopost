<?php
namespace bzimor\autopost;

set_error_handler(function($errno, $errstr, $errfile, $errline ){
    throw new \ErrorException($errstr, $errno, 0, $errfile, $errline);
});
use Yii;
use bzimor\autopost\models\ApiSettings;
use bzimor\autopost\models\AutopostHistory;
use Facebook\Facebook;


//require_once \Yii::getAlias('@webroot'). '/../vendor/autoload.php';
/**
 * @author bzimor
 */
 class Apimanager extends \yii\base\Component
 {
    public $types = [1 => 'text', 2 => 'photo'];
    /*
    *  Yii::$app->getModule('autopost')->apimanager->share(
    *     array(
    *         'title' => 'text',
    *         'message' => 'text',
    *         'link' => 'http://example.com',
    *         'photo_url' => 'http://example.com/photo.jpg'
    *         'video' => 'http://example.com/video.mp4'
    *     ),
    *     'text' || 'photo' || 'video',
    *     1 - 7 //1-telegram, 2-facebook, 4-twitter
    * );
    */

    function share(array $content, $type, $share=7)
    {
        if (! $items = ApiSettings::find()->all()) {
            Yii::$app->session->setFlash('api_error', 'Bazada ma\'lumotlar mavjud emas');
            return FALSE;
        }
        $apis = $this->index_to_assoc($items);
        $post_infos = array();
        $issent = FALSE;
        $text = '';
        if ($share && $share % 2 != 0 && $apis['telegram']->status == 1) {
            if ($tgresponse = $this->tg_post($content, $type)) {
                $post_infos['tg_msg_id'] =$tgresponse;
                $issent = TRUE;
            }
            else{$text.='Telegram ';}
        }
        if ($share && $share != 1 && 42 % $share == 0 && $apis['facebook']->status == 1) {
            if($fbresponse = $this->fb_post($content, $type)){
                $post_infos['fb_msg_id'] =$fbresponse;
                $issent = TRUE;
            }
            else{$text.='Facebook ';}
        }
        if ($share && $share >3 && $apis['twitter']->status == 1) {
            if($twresponse = $this->tw_post($content, $type)){
                $post_infos['tw_msg_id'] =$twresponse;
                $issent = TRUE;
            }
            else{$text.='Twitter ';}
        }
        if ($issent) {
            $this->save_history($post_infos, $content, $type);
        }
        if ($text) {
            $text.='ga yuborilmadi';
            return $text;
        }
        else {
            return 'Xabar muvafaqqiyatli yuborildi';
        }

    }

    function delete($id)
    {
        $item =AutopostHistory::findOne($id);
        $fb = $tg = $tw = FALSE;
        if ($this->tg_delete($item->tg_msg_id)) {
            $tg = TRUE;
            $item->tg_msg_id = NULL;
        }
        if ($this->fb_delete($item->fb_msg_id)) {
            $fb = TRUE;
            $item->fb_msg_id = NULL;
        }
        if ($this->tw_delete($item->tw_msg_id)) {
            $tw = TRUE;
            $item->tw_msg_id = NULL;
        }
        if ($fb && $tg && $tw) {
            $item->soft_delete = 1;
            $item->save();
        }
        else{
            $text = '';
            $check = array('Telegram' => $tg, 'Facebook' => $fb, 'Twitter' => $tw);
            foreach ($check as $key => $value) {
                if (! $value) {
                    $text .= $key."\n";
                }
            }
            $text .= 'dagi xabarlar o\'chirilmay qoldi';
            Yii::$app->session->setFlash('api_error', $text);
            $item->save();
            return FALSE;
        }
    }

    function save_history($info, $content, $type)
    {
        $model = new AutopostHistory();
        if (isset($info['tg_msg_id'])) {
            $model->tg_msg_id = $info['tg_msg_id'];
        }
        if (isset($info['fb_msg_id'])) {
            $model->fb_msg_id = $info['fb_msg_id'];
        }
        if (isset($info['tw_msg_id'])) {
            $model->tw_msg_id = $info['tw_msg_id'];
        }
        if ($type == 'text') {
            $model->type = 1;
        }
        elseif ($type == 'photo') {
            $model->type = 2;
        }
        if (isset($content['title'])) {
            $model->title = $content['title'];
        }
        if (isset($content['message'])) {
            $model->text = $content['message'];
        }
        if (isset($content['link'])) {
            $model->link = $content['link'];
        }
        if (isset($content['photo_url'])) {
            $model->photo = $content['photo_url'];
        }
        $model->save();
    }

    function fb_post(array $content, $type='')
    {
        $fbk = ApiSettings::find()->where(['type' => 'facebook'])->one();
        $fb = new Facebook([
         'app_id' => $fbk->app_id,
         'app_secret' => $fbk->api_secret,
         'default_graph_version' => $fbk->api_ver
        ]);
        if ($type == '') {
            $type = $this->types[$fbk->default_post];
        }
        if (! $path = $this->fb_path($type)) {
            return FALSE;
        }
        if (! $this->fb_content($content, $type, $fbk->bottom_text) && $type != 'text') {
            $path = '/feed';
            $data = $this->fb_content($content, 'text', $fbk->bottom_text);
        }
        else {
            $data = $this->fb_content($content, $type, $fbk->bottom_text);
        }
        $pageAccessToken = $fbk->access_token;
        $url = '/'.$fbk->page_id.$path;
        try {
            $response = $fb->post($url, $data, $pageAccessToken);
            return json_decode($response->getGraphNode())->id;
        }
        catch(Exception $e) {
            $this->log_errors('facebook', $e->getMessage());
            return FALSE;
        }
    }

    function fb_delete($post_id)
    {
        if ($post_id) {
            $fbk = ApiSettings::find()->where(['type' => 'facebook'])->one();
            $fb = new Facebook([
             'app_id' => $fbk->app_id,
             'app_secret' => $fbk->api_secret,
             'default_graph_version' => $fbk->api_ver
            ]);
            $pageAccessToken = $fbk->access_token;
            try {
                $response = $fb->delete('/'.$post_id, array(), $pageAccessToken);
                return $response->getGraphNode();
            }
            catch(Exception $e) {
                $this->log_errors('facebook', $e->getMessage());
                return FALSE;
            }
        }
        return FALSE;

    }

    function tg_post(array $content, $type='')
    {
        $tg = ApiSettings::find()->where(['type' => 'telegram'])->one();
        if ($type == '') {
            $type = $this->types[$tg->default_post];
        }
        $path = $this->tg_path($type);
        if (! $post_fields = $this->tg_content($content, $type, $tg->bottom_text)) {
            $path = 'sendMessage';
            $post_fields = $this->tg_content($content, 'text', $tg->bottom_text);
        }
        $path.= "?chat_id=".$tg->channel_id;
        $url = $tg->bot_token.'/'.$path;
        return $this->tg_curl_call($post_fields, $url, $type);
    }


    function tg_delete($post_id)
    {
        if ($post_id) {
            $tg = ApiSettings::find()->where(['type' => 'telegram'])->one();
            $post_fields['message_id'] = $post_id;
            $path = 'deleteMessage';
            $path.= "?chat_id=".$tg->channel_id;
            $url = $tg->bot_token.'/'.$path;
            return $this->tg_curl_call($post_fields, $url, 'delete');
        }
    }

    private function tg_curl_call($post_fields, $url, $type){
        $apiurl = "https://api.telegram.org/bot";
        $url = $apiurl.$url;
        $ch = curl_init();
        if ($type != 'text') {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
        }
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($httpcode != 200) {
            $this->log_errors('telegram', $response);
                return FALSE;
        }
        if ($type != 'delete') {
            return json_decode($response)->result->message_id;
        }
        else {
            return TRUE;
        }

    }

    function tw_post(array $content, $type='') {
        require_once(__DIR__.'/../../../jublonet/codebird-php/src/codebird.php');
        $tw = ApiSettings::find()->where(['type' => 'twitter'])->one();
        if (! $tw) {
            return FALSE;
        }
        $attach = FALSE;
        $text = $nl = '';

        if ($type == '') {
            $type = $this->types[$tw->default_post];
        }
        if (isset($content['title'])) {
            $text .= $content["title"];
            $nl = "\n\n";
        }
        if (isset($content['message'])) {
            $text .= $nl.$content["message"];
            if(mb_strlen($text, 'UTF-8')>280){
                $text = $content["title"];
            }
            $nl = "\n\n";
        }
        if(isset($content["link"])){
            $text .= $nl.$content["link"];
            $nl = "\n\n";
            if(mb_strlen($text, 'UTF-8')>280){
                $text = $content["link"];
            }
        }
        if ($type == 'text' && $tw->bottom_text) {
            $text.=$nl.$tw->bottom_text;
        }
        if($type == 'photo' && isset($content["photo_url"])){
            $image = $content['photo_url'];
            $attach = TRUE;
        }
        try {
            \Codebird\Codebird::setConsumerKey($tw->api_key, $tw->api_secret);
            $cb = \Codebird\Codebird::getInstance();
            $cb->setToken($tw->access_token, $tw->token_secret);

            $params = array('status' => $text,);
            if($attach){
                $reply = $cb->media_upload(array('media' => $image));
                $mediaID = $reply->media_id;
                $params['media_ids'] = $mediaID;
            }
            $reply = $cb->statuses_update($params);
        }
        catch(Exception $e) {
            if ($attach) {
                $this->tw_post($content, 'text');
            }
            $this->log_errors('codebird', $e->getMessage());
            return FALSE;
        }
        return $reply->id;
    }

    function tw_delete($post_id){
        require_once(__DIR__.'/../../../jublonet/codebird-php/src/codebird.php');
        $tw = ApiSettings::find()->where(['type' => 'twitter'])->one();
        if (! $tw) {
            return FALSE;
        }
        try {
            \Codebird\Codebird::setConsumerKey($tw->api_key, $tw->api_secret);
            $cb = \Codebird\Codebird::getInstance();
            $cb->setToken($tw->access_token, $tw->token_secret);

            $params = array('id' => $post_id);
            $reply = $cb->statuses_destroy_ID($params);
        }
        catch(Exception $e) {
            if ($attach) {
                $this->tw_post($content, 'text');
            }
            $this->log_errors('codebird', $e->getMessage());
            return FALSE;
        }
        return $reply;
    }

    private function fb_content(array $content, $type, $bottomtext)
    {
        $data = array();
        $text = $nl = '';

        if (isset($content['title'])) {
            $text .= $content['title'];
            $nl = "\n\n";
        }
        if (isset($content['message'])) {
            $text .= $nl.$content['message'];
            $nl = "\n\n";
        }
        if(isset($content['link'])){
            if ($type == 'text') {
                $data['link'] = $content['link'];
            }
            else {
                $text .= $nl.$content['link'];
                $nl = "\n\n";
            }
        }
        if ($bottomtext) {
            $text .= $nl.$bottomtext;
        }
        if ($text == '' && $type == 'text') {
            return FALSE;
        }
        $data['message'] = $text;
        if ($type == 'photo') {
            if (isset($content['photo_url'])) {
                $data['url'] = $content['photo_url'];
            }
            elseif (isset($content['photo_source'])) {
                $data['source'] = $content['photo_source'];
            }
            else {
                return FALSE;
            }
        }
        elseif ($type == 'video') {
            if (isset($content['video'])) {
                $data['description'] = $text;
                $data['source'] = $fb->videoToUpload($content['video']);
            }
            else {
                return FALSE;
            }
        }
        return $data;
    }

    private function fb_path($type)
    {
        $content = array(
            'text' => '/feed',
            'photo' => '/photos',
            'video' => '/videos'
        );
        if (array_key_exists($type, $content)) {
            return $content[$type];
        }
        else {
            return FALSE;
        }
    }

    private function tg_content($content, $type, $bottomtext)
    {
        $data = array();
        $text = $nl = '';
        if (isset($content['title'])) {
            $text .= $content['title'];
            $nl = "\n\n";
        }
        if (isset($content['message'])) {
            $text .= $nl.$content['message'];
            $nl = "\n\n";
        }
        if (isset($content['link'])) {
            $text .= $nl.$content['link'];
            $nl = "\n\n";
        }
        if ($bottomtext) {
            if ($type == 'text' || mb_strlen($text.$nl.$bottomtext, 'UTF-8')<201){
                $text.=$nl.$bottomtext;
            }
        }
        if ($type == 'text') {
            $data['text'] = $text;
        }
        elseif ($type == 'photo') {
            $data['caption'] = $text;
            if (isset($content['photo_url'])) {
                $data['photo'] = $content['photo_url'];
            }
            elseif (isset($content['photo_source'])) {
                $realPath = realpath($content['photo_source']);
                if (class_exists('CURLFile')){
                    $data['photo'] = new \CURLFile($realPath);
                }
                else {
                    $data['photo'] = '@' . $realPath;
                }
            }
            else {
                return FALSE;
            }
        }
        elseif ($type == 'video') {
            if (isset($content['video'])) {
                $data['video'] = $content['video'];
                $data['caption'] = $text;
            }
            else {
                return FALSE;
            }
        }
        return $data;
    }

    private function tg_path($type)
    {
        $content = array(
            'text' => 'sendMessage',
            'photo' => 'sendPhoto',
            'video' => 'sendVideo'
        );
        if (array_key_exists($type, $content)) {
            return $content[$type];
        }
        else {
            return FALSE;
        }
    }

    //not used
    function fb_edit($post_id, $message)
    {
        if ($post_id && $message) {
            $fbk = ApiSettings::find()->where(['type' => 'facebook'])->one();
            $fb = new Facebook([
                'app_id' => $fbk->app_id,
                'app_secret' => $fbk->api_secret,
                'default_graph_version' => $fbk->api_ver
            ]);
            $pageAccessToken = $fbk->access_token;
            try {
                $response = $fb->post('/'.$post_id, $message, $pageAccessToken);
                return $response->getGraphNode();
            }
            catch(Facebook\Exceptions\FacebookResponseException $e) {
                $this->log_errors('facebook graph', $e->getMessage());
                return FALSE;
            }
            catch(Facebook\Exceptions\FacebookSDKException $e) {
                $this->log_errors('facebook SDK', $e->getMessage());
                return FALSE;
            }
        }
        return FALSE;
    }

    //not used
    function tg_edit($post_id, $message, $type)
    {
        if ($post_id) {
            $tg = ApiSettings::find()->where(['type' => 'telegram'])->one();
            $post_fields['message_id'] = $post_id;
            if ($type == 'text') {
                $path = 'editMessageText';
                $post_fields['text'] = $message;
            }
            else {
                $path = 'editMessageCaption';
                $post_fields['caption'] = $message;
            }
            $path.= "?chat_id=".$tg->channel_id;
            $url = $tg->bot_token.'/'.$path;
            return $this->tg_curl_call($post_fields, $url, $type);
        }
    }

    private function index_to_assoc(array $items)
    {
        foreach ($items as $item) {
            $newitems[$item->type] = $item;
        }
        return $newitems;
    }

    private function log_errors($api, $error)
    {
        $curdate = date('d.m.Y H:i:s');
        $myFile = __DIR__.'/logs/api_error_log_'.date('Y-m-d').'.txt';
        $fh = fopen($myFile, 'a') or die("can't open file");
        fwrite($fh, $curdate.' - '.$api.': '.$error."\n");
        fclose($fh);
    }
}
