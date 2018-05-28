<?php

use yii\db\Migration;

/**
 * Class m180406_193246_create_tbl_categories
 */
class m180406_193246_create_tbl_categories extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tbl_categories', [
            'id' => $this->primaryKey(),
            's_id' => $this->integer()->notNull(),
            'cateWork' => $this->string(30)->notNull(),
            'workDetails' => $this->text()->notNull(),
            'placeOfWork' => $this->text()->notNull()
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tbl_categories');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180406_193246_create_tbl_categories cannot be reverted.\n";

        return false;
    }
    */
}
