<?php

namespace bzimor\autopost\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "autopost_history".
 *
 * @property integer $id
 * @property string $tg_msg_id
 * @property string $fb_msg_d
 * @property string $tw_msg_id
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property integer $type
 * @property string $link
 * @property string $photo
 * @property integer $created_at
 * @property integer $soft_delete
 */
class AutopostHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'autopost_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'soft_delete'], 'integer'],
            //[['text'], 'string'],
            //[['tg_msg_id', 'fb_msg_id', 'tw_msg_id'], 'string', 'max' => 35],
            //[['title', 'link', 'photo'], 'string', 'max' => 255],
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
            'tg_msg_id' => 'Telegram',
            'fb_msg_id' => 'Facebook',
            'tw_msg_id' => 'Twitter',
            'title' => 'Xabar',
            'text' => 'Matn',
            'type' => 'Turi',
            'link' => 'Link',
            'photo' => 'Rasm manzili',
            'updated_at' => 'Yuborildi',
            'soft_delete' => 'Status',
        ];
    }
}
