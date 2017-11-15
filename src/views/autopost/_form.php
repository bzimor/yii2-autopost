<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ApiSettings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="api-settings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'api_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'default_post')->textInput() ?>

    <?= $form->field($model, 'bottom_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bot_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'channel_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'api_secret')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'api_ver')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'access_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'token_secret')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'page_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'update_at')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
