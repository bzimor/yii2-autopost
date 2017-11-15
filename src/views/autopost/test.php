<div class="container">
    <a href="autopost" class="btn btn-success pull-right">Sozlash</a>
    <h3>Tekshirish uchun xabar yuborish</h3>
    <hr>
    <form class="form" action="" method="post">
        <div class="form-group">
            <textarea class="form-control" rows="4" id="postmessage"></textarea>
        </div>
        <div class="form-group">
            <label>Rasm manzili</label>
            <input class="form-control" type="text" name="image" id="postimage" value="autopost/web/assets/8fd665c5/logo.png">
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="tg-checkbox" checked>
                    Telegram
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" id="fb-checkbox">
                    Facebook
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" id="tw-checkbox">
                    Twitter
                </label>
            </div>
        </div>

        <button class="btn btn-primary" type="button" id="sharebtn">Xabar yuborish</button>
        <div id="sharemsg">

        </div>
    </form>
</div>
