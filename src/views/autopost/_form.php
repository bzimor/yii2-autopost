<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ApiSettings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="api-settings-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'status')->dropDownList(
                ['Faol emas', 'Faol'])?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'default_post')->dropDownList(
                [1=>'Matn', 2=>'Rasm'])?>
        </div>
    </div>
    <?= $form->field($model, 'bottom_text')->textInput(['maxlength' => true]) ?>

    <?php if ($model->type == 'telegram') {
        echo $form->field($model, 'bot_token')->textInput(['maxlength' => true]);
        echo $form->field($model, 'channel_id')->textInput(['maxlength' => true]);
    }
    if ($model->type == 'facebook') {
        echo $form->field($model, 'app_id')->textInput(['maxlength' => true]);
        echo $form->field($model, 'page_id')->textInput(['maxlength' => true]);
        echo $form->field($model, 'api_ver')->textInput(['maxlength' => true]);
    }
    if ($model->type != 'telegram') {
        echo $form->field($model, 'api_secret')->textInput(['maxlength' => true]);
        echo $form->field($model, 'access_token')->textInput(['maxlength' => true]);
    }
    if ($model->type == 'twitter') {
        echo $form->field($model, 'token_secret')->textInput(['maxlength' => true]);
    }?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Yangilash'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Bekor qilish'), ['setting'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
