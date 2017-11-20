<?php
namespace bzimor\autopost\models;
use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class ApiSettings extends ActiveRecord{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'api_settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['default_post', 'status'], 'integer'],
            [['type'], 'string', 'max' => 30],
            [['bottom_text'], 'string', 'max' => 100],
            [['bot_token'], 'string', 'max' => 45],
            [['app_id', 'page_id'], 'string', 'max' => 16],
            [['api_ver'], 'string', 'max' => 5],
            [['channel_id', 'api_secret', 'token_secret'], 'string', 'max' => 50],
            [['access_token'], 'string', 'max' => 250],
            [['api_key'], 'string', 'max' => 25],
        ];
    }


    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'app_id' => 'App ID',
            'type' => 'Type',
            'default_post' => 'Xabar shakli',
            'bottom_text' => 'Xabar osti matni',
            'bot_token' => 'Bot Token',
            'channel_id' => 'Kanal nomi (ID si)',
            'api_key' => 'Api Key',
            'api_secret' => 'Api Secret',
            'api_ver' => 'Api Versiyasi',
            'access_token' => 'Access Token',
            'token_secret' => 'Token Secret',
            'page_id' => 'Sahifa id si',
            'updated_at' => 'Yangilangan vaqti',
            'status' => 'Status',
        ];
    }
}
