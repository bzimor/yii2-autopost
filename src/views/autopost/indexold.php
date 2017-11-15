<div class="container">
    <a href="autopost/test" class="btn btn-primary pull-right">Tekshirish</a>
    <h3>Autpost kengaytmasi API ma'lumotlari</h3>
    <hr>
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#telegram">Telegram</a></li>
        <li><a data-toggle="tab" href="#facebook">Facebook</a></li>
        <li><a data-toggle="tab" href="#twitter">Twitter</a></li>
    </ul>
    <div class="tab-content">
        <div id="telegram" class="tab-pane fade in active">
        <?php if (isset($telegram) && $telegram): ?>
            <div class="table-responsive api-tables">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td>Holati</td>
                            <td id="tg-status" data-id="<?=$telegram->status ?>">
                                <? echo ($telegram->status == 1)?'<span class="label label-success">Faol</span>':'<span class="label label-default">Faol emas</span>'?>
                            </td>
                        </tr>
                        <tr>
                            <td>Xabar yuborish turi</td>
                            <td id="tg-posttype" data-id="<?=$telegram->default_post ?>"><? echo ($telegram->default_post == 1)?'<b>Matn</b>':'<b>Rasm</b>'?></td>
                        </tr>
                        <tr>
                            <td>Xabar osti matni</td>
                            <td id="tg-bottomtext"><?=$telegram->bottom_text?></td>
                        </tr>
                        <tr>
                            <td>Kanal id si</td>
                            <td id="tg-channelid"><?=$telegram->channel_id?></td>
                        </tr>
                        <tr>
                            <td>Bot token</td>
                            <td id="tg-bottoken"><?=$telegram->bot_token?></td>
                        </tr>
                        <tr>
                            <td>Yangilangan sana</td>
                            <td><?=date('d.m.Y H:i', strtotime($telegram->update_at))?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="pull-right" style="margin-bottom:5px;">
                    <button type="button" class="btn btn-warning btn-change" data-id="tg" data-toggle="modal" data-target="#apiedit">O'zgartirish</button>
                </div>
            </div>
        <?php else: ?>
            <br>
            <h4>Bazada ma'lumot mavjud emas</h4>
        <?php endif; ?>
        </div>
        <div id="facebook" class="tab-pane fade">
        <?php if (isset($facebook) && $facebook): ?>
            <div class="table-responsive api-tables">
                <table class="table table-hover" style="table-layout:fixed; width:100%">
                    <tbody>
                        <tr>
                            <td>Holati</td>
                            <td id="fb-status" data-id="<?=$facebook->status ?>"><? echo ($facebook->status == 1)?'<span class="label label-success">Faol</span>':'<span class="label label-default">Faol emas</span>'?></td>
                        </tr>
                        <tr>
                            <td>Xabar yuborish turi</td>
                            <td id="fb-posttype" data-id="<?=$facebook->default_post ?>"><? echo ($facebook->default_post == 1)?'<b>Matn</b>':'<b>Rasm</b>'?></td>
                        </tr>
                        <tr>
                            <td>Xabar osti matni</td>
                            <td id="fb-bottomtext"><?=$facebook->bottom_text?></td>
                        </tr>
                        <tr>
                            <td>Sahifa id si</td>
                            <td id="fb-pageid"><?=$facebook->page_id?></td>
                        </tr>
                        <tr>
                            <td>Api ID</td>
                            <td id="fb-apiid"><?=$facebook->api_id?></td>
                        </tr>
                        <tr>
                            <td>Api Secret</td>
                            <td id="fb-apisecret"><?=$facebook->api_secret?></td>
                        </tr>
                        <tr>
                            <td>Api versiya</td>
                            <td id="fb-apiver"><?=$facebook->api_ver?></td>
                        </tr>
                        <tr>
                            <td>Access token</td>
                            <td id="fb-accesstoken" style="word-wrap: break-word;"><?=$facebook->access_token?></td>
                        </tr>
                        <tr>
                            <td>Yangilangan sana</td>
                            <td><?=date('d.m.Y H:i', strtotime($facebook->update_at))?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="pull-right" style="margin-bottom:5px;">
                    <button type="button" class="btn btn-warning btn-change" data-id="fb" data-toggle="modal" data-target="#apiedit">O'zgartirish</button>
                </div>
            </div>
        <?php else: ?>
            <br>
            <h4>Bazada ma'lumot mavjud emas</h4>
        <?php endif; ?>
        </div>
        <div id="twitter" class="tab-pane fade">
        <?php if (isset($twitter) && $twitter): ?>
            <div class="table-responsive api-tables">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td>Holati</td>
                            <td id="tw-status" data-id="<?=$twitter->status ?>"><? echo ($twitter->status == 1)?'<span class="label label-success">Faol</span>':'<span class="label label-default">Faol emas</span>'?></td>
                        </tr>
                        <tr>
                            <td>Xabar yuborish turi</td>
                            <td id="tw-posttype" data-id="<?=$twitter->default_post ?>"><? echo ($twitter->default_post == 1)?'<b>Matn</b>':'<b>Rasm</b>'?></td>
                        </tr>
                        <tr>
                            <td>Xabar osti matni</td>
                            <td id="tw-bottomtext"><?=$twitter->bottom_text?></td>
                        </tr>
                        <tr>
                            <td>Api key</td>
                            <td id="tw-apiid"><?=$twitter->api_id?></td>
                        </tr>
                        <tr>
                            <td>Api Secret</td>
                            <td id="tw-apisecret"><?=$twitter->api_secret?></td>
                        </tr>
                        <tr>
                            <td>Access token</td>
                            <td id="tw-accesstoken"><?=$twitter->access_token?></td>
                        </tr>
                        <tr>
                            <td>Token secret</td>
                            <td id="tw-tokensecret"><?=$twitter->token_secret?></td>
                        </tr>
                        <tr>
                            <td>Yangilangan sana</td>
                            <td><?=date('d.m.Y H:i', strtotime($twitter->update_at))?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="pull-right" style="margin-bottom:5px;">
                    <button type="button" class="btn btn-warning btn-change" data-id="tw" data-toggle="modal" data-target="#apiedit">O'zgartirish</button>
                </div>
            </div>
        <?php else: ?>
            <br>
            <h4>Bazada ma'lumot mavjud emas</h4>
        <?php endif; ?>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="apiedit" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form" id="apieditform" action="" method="post">
                        <div class="row">
                            <input type="hidden" name="apitype" id="api-type">
                            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>"/>
                            <div class="col-sm-6">
                                <label>Api holati</label>
                                <div class="form-group" id="status">
                                    <select class="form-control" name="status">
                                        <option value="1">Faol</option>
                                        <option value="0">Faol emas</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <label>Jo'natiladigan xabar turi</label>
                                <div class="form-group" id="posttype">
                                    <select class="form-control" name="posttype">
                                        <option value="1">Matn</option>
                                        <option value="2">Rasm</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Xabar osti matn</label>
                            <input class="form-control" type="text" id="bottomtext" name="bottomtext" value="">
                        </div>
                        <div class="hidden form-group tg toggleable">
                            <label>Kanal id si</label>
                            <input class="form-control" type="text" id="channelid" name="channelid" value="">
                        </div>
                        <div class="hidden form-group tg toggleable">
                            <label>Bot token</label>
                            <input class="form-control" type="text" id="bottoken" name="bottoken" value="">
                        </div>
                        <div class="hidden form-group fb toggleable">
                            <label>Sahifa id si</label>
                            <input class="form-control" type="text" id="pageid" name="pageid" value="">
                        </div>
                        <div class="hidden form-group fb tw toggleable">
                            <label>Api id/api key</label>
                            <input class="form-control" type="text" id="apiid" name="apiid" value="">
                        </div>
                        <div class="hidden form-group fb tw toggleable">
                            <label>Api secret</label>
                            <input class="form-control" type="text" id="apisecret" name="apisecret" value="">
                        </div>
                        <div class="hidden form-group fb toggleable">
                            <label>Api versiya</label>
                            <input class="form-control" type="text" id="apiver" name="apiver" value="">
                        </div>
                        <div class="hidden form-group fb tw toggleable">
                            <label>Access token</label>
                            <input class="form-control" type="text" id="accesstoken" name="accesstoken" value="">
                        </div>
                        <div class="hidden form-group tw toggleable">
                            <label>Token secret</label>
                            <input class="form-control" type="text" id="tokensecret" name="tokensecret" value="">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="apichange" class="btn btn-primary" value="O'zgartirish">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Bekor qilish</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
