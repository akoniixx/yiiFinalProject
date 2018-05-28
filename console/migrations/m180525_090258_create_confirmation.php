<?php

use yii\db\Migration;

/**
 * Class m180525_090258_create_confirmation
 */
class m180525_090258_create_confirmation extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('confirmation', [
            'confirm_id' => $this->primaryKey(),
            'confirm_name' => $this->string(20)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('confirmation');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180525_090258_create_confirmation cannot be reverted.\n";

        return false;
    }
    */
}
