<?php

class m231228_121954_create_comment_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('comment', [
            'id' => 'pk',
            'post_id' => 'int',
            'content' => 'text',
            'created' => 'datetime',
            'updated' => 'datetime',
            'deleted' => 'datetime',
        ]);

        $this->addForeignKey(
            'fk_comment_post',
            'comment',
            'post_id',
            'post',
            'id',
            'CASCADE',
            'CASCADE'
        );
	}

	public function down()
	{
        $this->dropTable('comment');
	}
}