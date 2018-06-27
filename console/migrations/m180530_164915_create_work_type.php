<?php

use yii\db\Migration;

/**
 * Class m180530_164915_create_work_type
 */
class m180530_164915_create_work_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('work_type', [
            'id' => $this->primaryKey(),
            'name_type' => $this->string(50)->notNull(),
            'name_type_TH' => $this->string(50)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('work_type');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180530_164915_create_work_type cannot be reverted.\n";

        return false;
    }
    */
}
