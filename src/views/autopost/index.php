<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Api Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="api-settings-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Api Settings'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'api_id',
            'type',
            'default_post',
            'bottom_text',
            // 'bot_token',
            // 'channel_id',
            // 'api_secret',
            // 'api_ver',
            // 'access_token',
            // 'token_secret',
            // 'page_id',
            // 'update_at',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
