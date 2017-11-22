<?php
use yii\helpers\Html;
use yii\helpers\BaseStringHelper;
use yii\grid\GridView;
?>

    <h4>Yuborilgan xabarlar ro'yxati</h4>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => "Jami {totalCount} ta xabar, {begin} - {end} lar",
        'layout' => "{items}\n{summary}\n{pager}",
        'emptyText' => 'Hech qanday yuborilgan xabar mavjud emas',
        'tableOptions' => array(
            'class' => 'table table-hover',
            'style' => 'text-align:center'
        ),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'title',
                'format' => 'html',
                'value' => function ($model){
                    return  Html::a(
                        BaseStringHelper::truncate(
                            $model->title.' '.$model->text.' '.$model->link, 32, '...'
                        ), ['index', 'id'=>$model->id]);
                },
                'headerOptions' =>[
                    'style' => 'text-align:center'
                ],
                'contentOptions' =>[
                    'style' => 'text-align:left'
                ],

            ],
            [
                'attribute' => 'type',
                'value' => function ($model){
                    return ($model->type ==1)?'Matn':'Rasm';
                },
                'headerOptions' =>[
                    'style' => 'text-align:center'
                ],
            ],
            [
                'attribute' => 'tg_msg_id',
                'format' => 'html',
                'value' => function ($model){
                    return ($model->tg_msg_id ==NULL)?'':'<b>•</b>';
                },
                'headerOptions' =>[
                    'style' => 'text-align:center'
                ],
            ],
            [
                'attribute' => 'fb_msg_id',
                'format' => 'html',
                'value' => function ($model){
                    return ($model->fb_msg_id ==NULL)?'':'<b>•</b>';
                },
                'headerOptions' =>[
                    'style' => 'text-align:center'
                ],
            ],
            [
                'attribute' => 'tw_msg_id',
                'format' => 'html',
                'value' => function ($model){
                    return ($model->tw_msg_id ==NULL)?'':'<b>•</b>';
                },
                'headerOptions' =>[
                    'style' => 'text-align:center'
                ],

            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:d.m.y H:i'],
                'headerOptions' =>[
                    'style' => 'text-align:center'
                ],
            ],
            [
                'attribute' => 'soft_delete',
                'format' => 'html',
                'value' => function ($model){
                    return ($model->soft_delete == 0)?'<span class="label label-success">Yuborilgan</span>':'<span class="label label-danger">O\'chirilgan</span>';
                },
                'headerOptions' =>[
                    'style' => 'text-align:center'
                ],
            ],
        ],
    ]); ?>
