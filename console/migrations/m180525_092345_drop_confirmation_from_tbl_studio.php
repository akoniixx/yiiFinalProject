<?php

use yii\db\Migration;

/**
 * Class m180525_092345_drop_confirmation_from_tbl_studio
 */
class m180525_092345_drop_confirmation_from_tbl_studio extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('tbl_studio', 'confirmation', $this->integer(2)->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        /*echo "m180525_092345_drop_confirmation_from_tbl_studio cannot be reverted.\n";

        return false;*/
        $this->alterColumn('tbl_studio', 'confirmation', 'string');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180525_092345_drop_confirmation_from_tbl_studio cannot be reverted.\n";

        return false;
    }
    */
}
