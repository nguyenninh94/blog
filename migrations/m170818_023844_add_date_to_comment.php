<?php

use yii\db\Migration;

/**
 * Class m170818_023844_add_date_to_comment
 */
class m170818_023844_add_date_to_comment extends Migration
{
    /**
     * @inheritdoc
     */

    /*
    public function safeUp()
    {
        //
    }*/

    /**
     * @inheritdoc
     */
    /*
    public function safeDown()
    {
        
        //
    }*/

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('comment', 'date', $this->date());
    }

    public function down()
    {
        $this->dropColumn('comment', 'date');
    }
    
}
