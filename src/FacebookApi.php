<?php
define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__.'/Facebook/');
require_once(__DIR__.'/Facebook/autoload.php');

namespace bzimor\autopost;
use app\models\ApiSettings;
use Facebook\Facebook;


/**
 * @author bzimor
 */
 <?php



 class FacebookApi extends Facebook {

     public $app_id = '{app-id}';
     public $app_secret = '{app-secret}';
     public $default_graph_version = 'v2.5';

     public function __construct()
     {
          parent::__construct([
              'app_id' => $this->app_id,
              'app_secret' => $this->app_secret,
              'default_graph_version' => $this->default_graph_version
          ]);
     }
 }
