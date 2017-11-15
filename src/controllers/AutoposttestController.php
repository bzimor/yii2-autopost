<?php

namespace bzimor\autopost\controllers;

use Yii;
use app\models\ApiSettings;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\base\modules;
/**
 * AutopostController implements the CRUD actions for ApiSettings model.
 */
class AutopostController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ApiSettings models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ApiSettings::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ApiSettings model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ApiSettings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ApiSettings();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ApiSettings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ApiSettings model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ApiSettings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ApiSettings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ApiSettings::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionTest()
    {
        //$this->botToken = '367832419:AAFQ681CBly2Puwol8t5hpOLL-oBBojmJKc';
        // Yii::$app->getModule('autopost')->telegram->sendMessage([
        // 	'chat_id' => '75157851',
        // 	'text' => 'test'
        // ]);
        $feed['message'] = 'salom';
        Yii::$app->getModule('autopost')->apimanager->fb_post($feed);
        \bzimor\autopost\AutopostAssetsBundle::register($this->view);
        $datas = ApiSettings::find()->all();
        return $this->render('test',[
            'datas' => $datas
        ]);
    }

    public function actionSuccess()
    {

        $request = Yii::$app->request;
        $feed['message'] = $request->post('message');
        Yii::$app->getModule('autopost')->apimanager->fb_post($feed);
        $message = 'yuborildi';
        echo $message;
    }
}
