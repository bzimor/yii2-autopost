<?php
namespace bzimor\autopost;
use Yii;
use yii\base\BootstrapInterface;
class Bootstrap implements BootstrapInterface{
    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules([
            'autopost' => 'autopost/index',
        ], false);

         $app->setModule('autopost', 'bzimor\autopost\Module');
    }
}
