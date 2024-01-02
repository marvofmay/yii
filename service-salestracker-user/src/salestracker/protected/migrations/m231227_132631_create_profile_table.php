<?php

class m231227_132631_create_profile_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('profile', [
            'id' => 'pk',
            'avatar' => 'text',
            'www' => 'text',
            'user_id' => 'integer',
            'created' => 'datetime',
            'updated' => 'datetime',
            'deleted' => 'datetime',
        ]);

        $this->addForeignKey(
            'fk_profile_user',
            'profile',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );
	}

	public function down()
	{
        $this->dropForeignKey('fk_profile_user', 'profile');
        $this->dropTable('profile');
	}
}