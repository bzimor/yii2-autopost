<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

?>
<?= Html::a(Yii::t('app', 'Xabar yuborish'), ['index'], ['class' => 'btn btn-warning pull-right']) ?>
<h3>Autpost kengaytmasi API ma'lumotlari</h3>
<hr>
<ul class="nav nav-tabs">
    <li <?=($active=='telegram' || $active == NULL)?'class="active"':'' ?>><a data-toggle="tab" href="#tg"><?= ucfirst($tg->type) ?></a></li>
    <li <?=($active=='facebook')?'class="active"':'' ?>><a data-toggle="tab" href="#fb"><?= ucfirst($fb->type) ?></a></li>
    <li <?=($active=='twitter')?'class="active"':'' ?>><a data-toggle="tab" href="#tw"><?= ucfirst($tw->type) ?></a></li>
</ul>
<div class="tab-content">
    <div id="tg" class="tab-pane fade in active">
    <?php if (isset($tg) && $tg): ?>
        <div class="api-settings-view">
            <p><?= Html::a(Yii::t('app', 'O‘zgartirish'), ['update', 'type' => $tg->type], ['class' => 'btn btn-primary pull-right']) ?></p>
            <h2><?= ucfirst($tg->type) ?></h2>
            <?= DetailView::widget([
                'model' => $tg,
                'options' => [
                    'class' => 'table table-hover detail-view',
                    'style' => 'table-layout:fixed; width:100%'
                ],
                'attributes' => [
                    [
                        'label' => 'Status',
                        'value' => ($tg->status == 1)?'<span class="label label-success">Faol</span>':'<span class="label label-default">Faol emas</span>',
                        'format' => 'html'
                    ],
                    [
                        'label' => 'Xabar turi',
                        'value' => ($tg->default_post == 1)?'Matn':'Rasm',
                        'contentOptions' => ['class' => 'bold'],
                    ],
                    'bottom_text',
                    'bot_token',
                    'channel_id',
                    [
                        'label' => 'Yangilangan vaqti',
                        'value' => date('d.m.Y H:i', $tg->updated_at),
                    ]
                ],
            ]) ?>
        </div>
    <?php else: ?>
        <br>
        <h4>Bazada ma'lumot mavjud emas</h4>
    <?php endif; ?>
    </div>
    <div id="fb" class="tab-pane fade">
    <?php if (isset($fb) && $fb): ?>
        <div class="api-settings-view">
            <p><?= Html::a(Yii::t('app', 'O‘zgartirish'), ['update', 'type' => $fb->type], ['class' => 'btn btn-primary pull-right']) ?></p>
            <h2><?= ucfirst($fb->type) ?></h2>
            <?= DetailView::widget([
                'model' => $fb,
                'options' => [
                    'class' => 'table table-hover detail-view',
                    'style' => 'table-layout:fixed; width:100%'
                ],
                'attributes' => [
                    [
                        'label' => 'Status',
                        'value' => ($fb->status == 1)?'<span class="label label-success">Faol</span>':'<span class="label label-default">Faol emas</span>',
                        'format' => 'html'
                    ],
                    [
                        'label' => 'Xabar turi',
                        'value' => ($fb->default_post == 1)?'Matn':'Rasm',
                        'contentOptions' => ['class' => 'bold']
                    ],
                    'bottom_text',
                    'page_id',
                    'app_id',
                    'api_secret',
                    [
                        'label' => 'Access token',
                        'value' => $fb->access_token,
                        'contentOptions' => ['style' => 'word-wrap: break-word']
                    ],
                    'api_ver',
                    [
                        'label' => 'Yangilangan vaqti',
                        'value' => date('d.m.Y H:i', $fb->updated_at),
                    ]
                ],
            ]) ?>
        </div>
    <?php else: ?>
        <br>
        <h4>Bazada ma'lumot mavjud emas</h4>
    <?php endif; ?>
    </div>
    <div id="tw" class="tab-pane fade">
    <?php if (isset($tw) && $tw): ?>
        <div class="api-settings-view">
            <p><?= Html::a(Yii::t('app', 'O‘zgartirish'), ['update', 'type' => $tw->type], ['class' => 'btn btn-primary pull-right']) ?></p>
            <h2><?= ucfirst($tw->type) ?></h2>
            <?= DetailView::widget([
                'model' => $tw,
                'options' => [
                    'class' => 'table table-hover detail-view',
                    'style' => 'table-layout:fixed; width:100%'
                ],
                'attributes' => [
                    [
                        'label' => 'Status',
                        'value' => ($tw->status == 1)?'<span class="label label-success">Faol</span>':'<span class="label label-default">Faol emas</span>',
                        'format' => 'html'
                    ],
                    [
                        'label' => 'Xabar turi',
                        'value' => ($tw->default_post == 1)?'Matn':'Rasm',
                        'contentOptions' => ['class' => 'bold']
                    ],
                    'bottom_text',
                    'api_key',
                    'api_secret',
                    'access_token',
                    'token_secret',
                    [
                        'label' => 'Yangilangan vaqti',
                        'value' => date('d.m.Y H:i', $tw->updated_at),
                    ]
                ],
            ]) ?>
        </div>
    <?php else: ?>
        <br>
        <h4>Bazada ma'lumot mavjud emas</h4>
    <?php endif; ?>
    </div>
</div>
