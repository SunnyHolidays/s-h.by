<?php

class m130911_081038_add_fields_in_orders_and_delete_fields_from_participants extends CDbMigration
{
	public function up()
	{
        $this->addColumn(
            '{{orders}}',
            'first_name',
            'VARCHAR(255) NOT NULL'
        );
        $this->addColumn(
            '{{orders}}',
            'last_name',
            'VARCHAR(255) NOT NULL'
        );
        $this->addColumn(
            '{{orders}}',
            'email',
            'VARCHAR(255) NOT NULL'
        );
        $this->addColumn(
            '{{orders}}',
            'phone',
            'INT NULL DEFAULT NULL'
        );
        $this->addColumn(
            '{{orders}}',
            'address',
            'VARCHAR(255) DEFAULT NULL'
        );

        $this->update(
            '{{orders}}',
            array(
                'first_name' => 'ivan',
                'last_name' => 'ivanov',
                'email' => 'ivantest@gmail.com',
                'phone' => '1234321',
                'address' => 'RB,Hrodna'
            ),
            'id=1'
        );
        $this->update(
            '{{orders}}',
            array(
                'first_name' => 'alexey',
                'last_name' => 'alexeev',
                'email' => 'alextest@gmail.com',
                'phone' => '+273528209',
                'address' => 'RB,Brest'
            ),
            'id=2'
        );
        $this->update(
            '{{orders}}',
            array(
                'first_name' => 'alexandr',
                'last_name' => 'alexandrov',
                'email' => 'alexandrtest@gmail.com',
                'phone' => '+12345678',
                'address' => 'RB,Minsk'
            ),
            'id=3'
        );

        $this->dropColumn(
            '{{participants}}',
            'passport_number'
        );
        $this->dropColumn(
            '{{participants}}',
            'email'
        );
        $this->dropColumn(
            '{{participants}}',
            'phone'
        );

        $this->alterColumn('{{orders}}','user_id','INT NULL DEFAULT NULL');
	}

	public function down()
	{

        $this->addColumn(
            '{{participants}}',
            'passport_number',
            'VARCHAR(255) NULL DEFAULT NULL'
        );
        $this->addColumn(
            '{{participants}}',
            'email',
            'VARCHAR(255) NOT NULL'
        );
        $this->addColumn(
            '{{participants}}',
            'phone',
            'INT NULL DEFAULT NULL'
        );

        $this->dropColumn(
            '{{orders}}',
            'first_name'
        );
        $this->dropColumn(
            '{{orders}}',
            'last_name'
        );
        $this->dropColumn(
            '{{orders}}',
            'email'
        );
        $this->dropColumn(
            '{{orders}}',
            'phone'
        );
        $this->dropColumn(
            '{{orders}}',
            'address'
        );
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