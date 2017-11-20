<?php
use yii\helpers\Html;

?>

<?= Html::a(Yii::t('app', 'Sozlash'), ['setting'], ['class' => 'btn btn-success pull-right']) ?>
<h3>API orqali yuborilgan xabarlar</h3>
<div class="apisettings-post">
    <hr>
    <div class="row">
        <div class="col-sm-4" style="border-right: 1px solid #e1e1e1">
            <?php $error = Yii::$app->session->getFlash('api_error'); ?>
            <?php if($error): ?>
                <div class="alert alert-danger">
                    <?=$error ?>
                </div>
            <?php endif; ?>
            <h4>Xabar yuborish</h4>
            <?php if (isset($data)&&$data->soft_delete==1): ?>
                <div class="alert alert-danger">
                    <?='Xabar '.date('d.m.Y H:i', $data->updated_at).' da o\'chirilgan'?>
                </div>
            <?php elseif(isset($data)&&$data->soft_delete==0 && time()-$data->created_at>172800): ?>
                <div class="alert alert-warning">
                    Xabar yuborilganiga 48 soatdan oshgan, Telegram kanalidan o'chirish imkonsiz
                </div>
            <?php endif; ?>
            <form class="form" action="" method="post">
                <div class="form-group">
                    <label>Sarlavha</label>
                    <input class="form-control" type="text" name="title" id="posttitle" value="<?=(isset($data))?$data->title:''?>">
                </div>
                <div class="form-group">
                    <label>Matn</label>
                    <textarea class="form-control" rows="4" id="postmessage" style="resize:vertical;"><?=(isset($data))?$data->text:''?></textarea>
                </div>
                <div class="form-group">
                    <label>Link</label>
                    <input class="form-control" type="text" name="image" id="postlink" value="<?=(isset($data))?$data->link:''?>">
                </div>
                <div class="form-group">
                    <label>Rasm manzili</label>
                    <input class="form-control" type="text" name="image" id="postphotourl" value="<?=(isset($data))?$data->photo:''?>">
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="tg-check" <?=(! isset($data)||$data->tg_msg_id)?'checked':''?>>
                                    Telegram
                                </label>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="fb-check" <?=(isset($data)&&$data->fb_msg_id)?'checked':''?>>
                                    Facebook
                                </label>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="tw-check" <?=(isset($data)&&$data->tw_msg_id)?'checked':''?>>
                                    Twitter
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="posttype" id="radioDefault" value="" <?=(! isset($data))?'checked':''?>>
                                    Sozlamadagi bo'yicha
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="posttype" id="radioText" value="text" <?=(isset($data)&&$data->type ==1)?'checked':''?>>
                                    Matn
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="posttype" id="radioPhoto" value="photo" <?=(isset($data)&&$data->type ==2)?'checked':''?>>
                                    Rasm
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="button" id="sharebtn"><?=(isset($data))?'Qayta yuborish':'Xabar yuborish'?></button>
                    <?php if(isset($data) && $data->soft_delete != 1): ?>
                        <?= Html::a(Yii::t('app', 'Yangi xabar'), ['index'], ['class' => 'btn btn-success']) ?>
                        <?php if($data->soft_delete != 1): ?>
                            <?= Html::a(Yii::t('app', 'O\'chirish'), ['delete', 'id'=>$data->id], ['class' => 'btn btn-warning']) ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div  class="alert alert-success" id="sharemsg">

                </div>
            </form>
        </div>
        <div class="col-sm-8">
            <?= $this->render('_table', [
                'dataProvider' => $dataProvider ,
            ]) ?>
        </div>
    </div>
</div>
