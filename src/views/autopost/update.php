<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ApiSettings */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Api Settings',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Api Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="api-settings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
