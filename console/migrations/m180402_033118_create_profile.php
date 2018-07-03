<?php

use yii\db\Migration;

/**
 * Class m180402_033118_create_profile
 */
class m180402_033118_create_profile extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('profile', [
            'userID' => $this->primaryKey(),
            'firstname' => $this->string(100)->notNull(),
            'lastname' => $this->string(100)->notNull(),
            'address' => $this->text(),
            'tel' => $this->string(20),
            'link' => $this->string(300),
            'imgProfile' => $this->string(200)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //echo "m180402_033118_create_profile cannot be reverted.\n";
        $this->dropTable('profile');
        //return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180402_033118_create_profile cannot be reverted.\n";

        return false;
    }
    */
}
