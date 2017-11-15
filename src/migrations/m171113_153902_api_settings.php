<?php

use yii\db\Migration;

class m171113_153902_api_settings extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%api_settings}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string(30)->notNull(),
            'default_post' => $this->integer(1)->default(2),
            'bottom_text' => $this->string(100),
            'bot_token' => $this->string(255),
            'channel_id' => $this->string(255),
            'api_id' => $this->string(255),
            'page_id' => $this->string(255),
            'api_secret' => $this->string(255),
            'api_ver' => $this->string(255),
            'access_token' => $this->string(255),
            'token_secret' => $this->string(255),
            'update_at' => $this->timestamp()->notNull(),
            'status' => $this->integer(1)->default(1)
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%api_settings}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171113_153902_api_settings cannot be reverted.\n";

        return false;
    }
    */
}
