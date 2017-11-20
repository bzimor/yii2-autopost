<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ApiSettings */

$this->title = ucfirst($model->type). ' sozlamalari';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Api Settings'), 'url' => ['setting']];
$this->params['breadcrumbs'][] = Yii::t('app', 'O\'zgartirish');
?>
<div class="api-settings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
