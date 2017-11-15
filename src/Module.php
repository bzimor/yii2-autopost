<?php
namespace bzimor\autopost;
use yii\base\Module as BaseModule;
class Module extends BaseModule
{
    public $controllerNamespace = 'bzimor\autopost\controllers';

    public function init()
    {
        parent::init();
        // initialize the module with the configuration loaded from config.php
        \Yii::configure($this, require __DIR__ . '/config.php');
    }
}
