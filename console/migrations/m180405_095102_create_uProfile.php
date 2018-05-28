<?php

use yii\db\Migration;

/**
 * Class m180405_095102_create_uProfile
 */
class m180405_095102_create_uProfile extends Migration
{

    public function safeUp()
    {
        $this->createTable('uProfile', [
            'id' => $this->primaryKey(),
            //'password' => $this->string(100)->notNull(),
            'firstName' => $this->string(100)->notNull(),
            'lastName' => $this->string(100)->notNull(),
            //'email' => $this->string(100)->notNull(),
            'tel' => $this->string(30),
            'userType' => $this->string(5)->notNull()->defaultValue('U'),
            'u_id' => $this->integer()->notNull(),
            'email' => $this->string(255)->notNull(),
            'imgProfile' => $this->string(255)->defaultValue('')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //echo "m180403_143910_create_table_userdb cannot be reverted.\n";
       $this->dropTable('uProfile');
       //return true;
    }

}
