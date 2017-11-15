<?php

namespace bzimor\autopost\controllers;

use Yii;
use yii\web\Controller;
use bzimor\autopost\models\ApiSettings;

class AutopostController extends Controller
{
    public function actionIndex()
    {
        \bzimor\autopost\AutopostAssetsBundle::register($this->view);
        $request = Yii::$app->request;
        $apis = ApiSettings::find()->all();
        if ($request->isPost && isset($request->post('apitype'))) {
            $api = ApiSettings::find()->where(['type' => $request->post('apitype')])->one();
            // $api->status = $request->post('status');
            // $api->default_post = $request->post('posttype');
            // $api->bottom_text = $request->post('bottomtext');
            // $tg->bot_token = $request->post('bottoken');
            // $tg->channel_id = $request->post('channelid');
            // $fb->page_id = $request->post('pageid');
            // $fb->api_id = $request->post('apiid');
            // $fb->api_ver = $request->post('apiver');
            // $fb->api_secret = $request->post('apisecret');
            // $fb->access_token = $request->post('accesstoken');
            $api->updateAttributes($request->post());
            }
            // elseif ($request->post('apitype') == 'fb') {
            //     $fb->status = $request->post('status');
            //     $fb->default_post = $request->post('posttype');
            //     $fb->bottom_text = $request->post('bottomtext');
            //
            //     $fb->update();
            // }
            // elseif ($request->post('apitype') == 'tw') {
            //     $tw->status = $request->post('status');
            //     $tw->default_post = $request->post('posttype');
            //     $tw->bottom_text = $request->post('bottomtext');
            //     $tw->api_id = $request->post('apiid');
            //     $tw->api_secret = $request->post('apisecret');
            //     $tw->access_token = $request->post('accesstoken');
            //     $tw->token_secret = $request->post('tokensecret');
            //     $tw->update();
            }
            $this->redirect('autopost');
        }else{
            return $this->render('index',[
                'apis' => $apis,
            ]);
        }

    }

    public function actionTest()
    {
        \bzimor\autopost\AutopostAssetsBundle::register($this->view);
        $datas = ApiSettings::find()->all();
        return $this->render('test',[
            'datas' => $datas
        ]);
    }

    public function actionSend()
    {

    }
}
