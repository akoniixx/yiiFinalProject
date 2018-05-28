<?php

use yii\db\Migration;

/**
 * Class m180420_164014_create_occupation
 */
class m180420_164014_create_occupation extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('occupation', [
            'id' => $this->primaryKey(),
            'occupationName' => $this->string(100)->notNull(),
            'TH_name' => $this->string(100)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('occupation');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180420_164014_create_occupation cannot be reverted.\n";

        return false;
    }
    */
}
