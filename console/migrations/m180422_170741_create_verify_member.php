<?php

use yii\db\Migration;

/**
 * Class m180422_170741_create_verify_member
 */
class m180422_170741_create_verify_member extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('verify_member', [
            'verify_id' => $this->primaryKey(),
            'img_idCard' => $this->string(255),
            'img_profile' => $this->string(255),
            'fname' => $this->string(100)->notNull(),
            'lname' => $this->string(100)->notNull(),
            'tel' => $this->string(20),
            'studio_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp(),
            'verify_status' => $this->string(50)->defaultValue('wait')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('verify_member');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180422_170741_create_verify_member cannot be reverted.\n";

        return false;
    }
    */
}
