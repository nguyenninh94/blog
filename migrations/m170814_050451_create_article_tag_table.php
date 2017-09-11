<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_tag`.
 */
class m170814_050451_create_article_tag_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_tag', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer(),
            'tag_id' => $this->integer(),
        ]);

        //create index for column article_id
        $this->createIndex(
            'idx-article_id',
            'article_tag',
            'article_id'
        );

        //add foreign key for the table article
        $this->addForeignKey(
            'fk-article_id',
            'article_tag',
            'article_id',
            'article',
            'id',
            'CASCADE'
        );

        //create index for column tag_id
        $this->createIndex(
            'idx-tag_id',
            'article_tag',
            'tag_id'
        );

        //add foreign key for the table tag
        $this->addForeignKey(
            'fk-tag_id',
            'article_tag',
            'tag_id',
            'tag',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_tag');
    }
}
