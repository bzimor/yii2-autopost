<?php
use app\models\ApiSettings;

$bottoken = ApiSettings::find()->where(['type' => 'tg'])->one()->bot_token;

return [
    'components' => [
    	'telegram' => [
            'class' => 'aki\telegram\Telegram',
            'botToken' => $bottoken// '367832419:AAFQ681CBly2Puwol8t5hpOLL-oBBojmJKc',
        ],
        'apimanager' =>[
            'class' => 'bzimor\autopost\Apitest'
        ],
        'facebookapi' =>[
            'class' => 'bzimor\autopost\FacebookApi'
        ]
    ]
];
