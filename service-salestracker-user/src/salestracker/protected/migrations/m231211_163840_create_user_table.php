<?php

class m231211_163840_create_user_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('user', [
            'id' => 'pk',
            'firstname' => 'string',
            'lastname' => 'string',
            'birth' => 'date',
            'email' => 'string NOT NULL',
            'password' => 'string NOT NULL',
            'datePassword' => 'date',
            'created' => 'datetime',
            'updated' => 'datetime',
            'deleted' => 'datetime',
        ]);
	}

	public function down()
	{
        $this->dropTable('user');
	}
}