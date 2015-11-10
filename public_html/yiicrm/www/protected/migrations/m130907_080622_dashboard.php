<?php

class m130907_080622_dashboard extends CDbMigration
{
	public function up()
	{
        $this->createTable(
            '{{user_widgets}}',
            array(
                'id' => 'pk',
                'user_id' => 'INT NOT NULL',
                'col' => 'INT NOT NULL',
                'row' => 'INT NOT NULL',
                'size_x' => 'INT NOT NULL',
                'size_y' => 'INT  NOT NULL',
                'type' => 'VARCHAR(50) NOT NULL',
                'widget_name' => 'VARCHAR(50) NOT NULL',
                'params' => 'VARCHAR(250) NOT NULL',
            )
        );
        $this->execute('ALTER TABLE {{user_widgets}} ENGINE=INNODB');

        $this->addForeignKey(
            'fk_dashboard_users',
            '{{user_widgets}}',
            'user_id',
            '{{users}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
	}

	public function down()
	{
        $this->dropForeignKey('fk_dashboard_users', '{{user_widgets}}');
        $this->dropTable('{{user_widgets}}');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}