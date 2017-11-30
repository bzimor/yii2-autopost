<?php

namespace bzimor\autopost\controllers;

use Yii;
use bzimor\autopost\models\ApiSettings;
use bzimor\autopost\models\AutopostHistory;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\base\modules;

class AutopostController extends Controller
{

    public function actionIndex()
    {
        $data = array();
        $post_id = Yii::$app->request->get('id');
        if ($post_id) {
            $data['data'] = AutopostHistory::findOne($post_id);
        }
        \bzimor\autopost\AutopostAssetsBundle::register($this->view);
        $dataProvider = new ActiveDataProvider([
            'query' => AutopostHistory::find(),
            'sort'=> ['defaultOrder' => ['updated_at'=>SORT_DESC]],
            'pagination' => [
                'pageSize' => 30,
            ],
        ]);
        $data['settings'] = ApiSettings::find()->all();
        $data['dataProvider'] = $dataProvider;
        return $this->render('index', $data);
    }

    public function actionSetting()
    {
        \bzimor\autopost\AutopostAssetsBundle::register($this->view);
        return $this->render('setting', [
            'tg' => $this->findModel('telegram'),
            'fb' => $this->findModel('facebook'),
            'tw' => $this->findModel('twitter'),
            'active' => Yii::$app->request->get('type')
        ]);
    }

    public function actionUpdate($type)
    {
        $model = $this->findModel($type);

        if ($model->load(Yii::$app->request->post()) && $model->save(FALSE)) {
            return $this->redirect(['setting', 'type'=>$type]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete()
    {
        $post_id = Yii::$app->request->get('id');
        if ($post_id) {
            if(Yii::$app->getModule('autopost')->apimanager->delete($post_id)){
                return $this->redirect(['index']);
            }
            else{
                return $this->redirect(['index', 'id'=>$post_id]);
            }
        }

    }

    protected function findModel($type)
    {
        if (($model = ApiSettings::find()->where(['type' => $type])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSuccess()
    {
        $request = Yii::$app->request;
        $apimanager = Yii::$app->getModule('autopost')->apimanager;
        if ($request->isPost) {
            $content = array();
            if ($request->post('title')) {
                $content['title'] = $request->post('title');
            }
            if ($request->post('message')) {
                $content['message'] = $request->post('message');
            }
            if ($request->post('link')) {
                $content['link'] = $request->post('link');
            }
            if ($request->post('photo')) {
                $content['photo_url'] = $request->post('photo');
            }
            $share = $request->post('share');
            if (! $message = $apimanager->share($content, $request->post('type'), $share)) {
                $message = Yii::$app->session->getFlash('api_error');
            }
            echo $message;
        }
        else {
            $this->redirect(['index']);
        }
    }

}
