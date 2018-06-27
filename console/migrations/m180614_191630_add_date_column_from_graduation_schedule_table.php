<?php

use yii\db\Migration;

/**
 * Class m180614_191630_add_date_column_from_graduation_schedule_table
 */
class m180614_191630_add_date_column_from_graduation_schedule_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('graduation_schedule', 'date', $this->date());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('graduation_schedule', 'date');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180614_191630_add_date_column_from_graduation_schedule_table cannot be reverted.\n";

        return false;
    }
    */
}
