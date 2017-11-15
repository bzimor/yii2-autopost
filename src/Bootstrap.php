<?php

namespace bzimor\autopost;

use Yii;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface{

    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules([
            'autopost' => 'autopost/autopost/index',
            'autopost/<action:\w+>' => 'autopost/autopost/<action>',
            'autopost/<action:\w+>/<id:\d+>' => 'autopost/autopost/<action>',
            'autopost/<id:\d+>' => 'autopost/autopost/view',
        ], false);

         $app->setModule('autopost', 'bzimor\autopost\Module');
    }
}
