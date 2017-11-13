<?php
namespace bzimor\autopost\controllers;
use Yii;
use yii\web\Controller;
use bzimor\autopost\models\ApiSettings;
class AutopostController extends Controller
{
    public $layout = 'main';
    public function actionIndex()
    {
        \bzimor\autopost\AutopostAssetsBundle::register($this->view);
        $datas = ApiSettings::find()->all();
        return $this->render('index',[
            'datas' => $datas
        ]);
    }
}
