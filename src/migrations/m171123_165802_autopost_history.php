<?php

use yii\db\Migration;

class m171123_165802_autopost_history extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%autopost_history}}', [
            'id' => $this->primaryKey(),
            'tg_msg_id' => $this->string(35),
            'fb_msg_id' => $this->string(35),
            'tw_msg_id' => $this->string(35),
            'type' => $this->integer(1)->defaultValue(1),
            'title' => $this->string(255),
            'text' => $this->text(),
            'link' => $this->string(255),
            'photo' => $this->string(255),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'soft_delete' => $this->integer(1)->defaultValue(0)
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%autopost_history}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171123_165802_autopost_history cannot be reverted.\n";

        return false;
    }
    */
}
