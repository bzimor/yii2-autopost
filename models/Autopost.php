<?php
namespace bzimor\autopost\models;
use Yii;
use yii\db\ActiveRecord;
class Autopost extends ActiveRecord{
    public function rules()
    {
        return [
            [['type'], 'required'],
        ];
    }
}
