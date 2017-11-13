<?php
namespace bzimor\autopost\models;
use Yii;
use yii\db\ActiveRecord;
class ApiSettings extends ActiveRecord{
    public function rules()
    {
        return [
            [['type'], 'required'],
        ];
    }
}
