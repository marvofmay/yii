<?php

class m231227_130939_create_post_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('post', [
            'id' => 'pk',
            'title' => 'string NOT NULL',
            'description' => 'text',
            'content' => 'text',
            'active' => 'bool DEFAULT TRUE',
            'user_id' => 'integer',
            'created' => 'datetime',
            'updated' => 'datetime',
            'deleted' => 'datetime',
        ]);

        $this->addForeignKey(
            'fk_post_user',
            'post',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );
	}

	public function down()
	{
        $this->dropForeignKey('fk_post_user', 'post');
        $this->dropTable('post');
	}
}