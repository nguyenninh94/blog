<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comment`.
 */
class m170814_042342_create_comment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'text' => $this->string(),
            'user_id' => $this->integer(),
            'article_id' => $this->integer(),
            'status' => $this->integer()

        ]);

        //create index for column 'user_id'
        $this->createIndex(
             'idx-user_id',
             'comment',
             'user_id'
        );

        //add foreign key for the table user
        $this->addForeignKey(
             'fk-user_id',
             'comment',
             'user_id',
             'user',
             'id',
             'CASCADE'
        );

        //create index for column 'article_id'
        $this->createIndex(
             'idx-article_id',
             'comment',
             'article_id'
        );

        //create foreign key for the table article
        $this->addForeignKey(
              'fk-article_id',
              'comment',
              'article_id',
              'article',
              'id',
              'CASCADE'
        );
    }


    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('comment');
    }
}
