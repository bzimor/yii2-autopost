<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ApiSettings */

$this->title = Yii::t('app', 'Create Api Settings');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Api Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="api-settings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
