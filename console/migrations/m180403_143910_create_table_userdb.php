<?php

use yii\db\Migration;

/**
 * Class m180403_143910_create_table_userdb
 */
class m180403_143910_create_table_userdb extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('userdb', [
            'id' => $this->primaryKey(),
            'password' => $this->string(100)->notNull(),
            'firstName' => $this->string(100)->notNull(),
            'lastName' => $this->string(100)->notNull(),
            'email' => $this->string(100)->notNull(),
            'tel' => $this->string(30),
            'usreType' => $this->string(5)->notNull()->defaultValue('U'),
            'imgProfile' => $this->string(255)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //echo "m180403_143910_create_table_userdb cannot be reverted.\n";
       $this->dropTable('userdb');
       //return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180403_143910_create_table_userdb cannot be reverted.\n";

        return false;
    }
    */
}
