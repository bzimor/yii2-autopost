<?php

namespace bzimor\autopost;

use yii\web\AssetBundle;

class AutopostAssetsBundle extends AssetBundle
{
    public $sourcePath = '@vendor/bzimor/yii2-autopost/assets';
    public $css = [
        'css/styles.css'
    ];
    public $js = [
        'js/scripts.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
