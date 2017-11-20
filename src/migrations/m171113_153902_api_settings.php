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
            'default_post' => $this->integer(1)->defaultValue(2),
            'bottom_text' => $this->string(100),
            'bot_token' => $this->string(45),
            'channel_id' => $this->string(50),
            'app_id' => $this->string(16),
            'page_id' => $this->string(16),
            'api_key' => $this->string(25),
            'api_secret' => $this->string(50),
            'api_ver' => $this->string(5),
            'access_token' => $this->string(250),
            'token_secret' => $this->string(50),
            'updated_at' => $this->integer(11),
            'status' => $this->integer(1)->default(1)
        ], $tableOptions);
        $this->insert('{{%api_settings}}',
            ['id' => '1', 'type' => 'telegram'],
            ['id' => '2', 'type' => 'facebook'],
            ['id' => '3', 'type' => 'twitter']
        );
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
