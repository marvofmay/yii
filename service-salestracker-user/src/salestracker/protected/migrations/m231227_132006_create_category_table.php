<?php

class m231227_132006_create_category_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('category', [
            'id' => 'pk',
            'name' => 'string NOT NULL',
            'description' => 'text',
            'active' => 'bool DEFAULT TRUE',
            'created' => 'datetime',
            'updated' => 'datetime',
            'deleted' => 'datetime',
        ]);
	}

	public function down()
	{
        $this->dropTable('category');
	}
}