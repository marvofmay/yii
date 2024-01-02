<?php

class m231227_133140_post_category_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('post_category', [
            'id' => 'pk',
            'post_id' => 'integer',
            'category_id' => 'integer'
        ]);

        $this->addForeignKey(
            'fk_post_category_post',
            'post_category',
            'post_id',
            'post',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_post_category_category',
            'post_category',
            'category_id',
            'category',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'unique_post_category',
            'post_category',
            'post_id, category_id',
            true
        );
    }

	public function down()
	{
        $this->dropForeignKey('fk_post_category_post', 'post_category');
        $this->dropForeignKey('fk_post_category_category', 'post_category');
        $this->dropIndex('unique_post_category', 'post_category');
        $this->dropTable('post_category');
	}
}