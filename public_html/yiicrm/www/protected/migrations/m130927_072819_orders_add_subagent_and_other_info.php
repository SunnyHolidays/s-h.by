<?php

class m130927_072819_orders_add_subagent_and_other_info extends CDbMigration
{
	public function up()
	{
        $this->createTable(
            '{{subagent}}',
            array(
                'id' => 'pk',
                'title' => 'VARCHAR(255) NOT NULL',
                'address' => 'VARCHAR(255) NULL DEFAULT NULL'
            )
        );

        $this->execute('ALTER TABLE {{subagent}} ENGINE=INNODB');
        $this->insert(
            '{{subagent}}',
            array(
                'id' => 1,
                'title' => 'Subagent Travel First',
                'address' => 'RB,Minsk'
            )
        );
        $this->insert(
            '{{subagent}}',
            array(
                'id' => 2,
                'title' => 'Subagent Travel Second',
                'address' => 'RB,Brest'
            )
        );
        $this->insert(
            '{{subagent}}',
            array(
                'id' => 3,
                'title' => 'Subagent Travel Third',
                'address' => null
            )
        );

        $this->addColumn(
            '{{orders}}',
            'travel_service_fee',
            'DOUBLE NOT NULL AFTER commission'
        );
        $this->addColumn(
            '{{orders}}',
            'subcommission',
            'DOUBLE NULL DEFAULT NULL AFTER travel_service_fee'
        );
        $this->addColumn(
            '{{orders}}',
            'discount',
            'DOUBLE NULL DEFAULT NULL AFTER subcommission'
        );
        $this->addColumn(
            '{{orders}}',
            'amount_paid',
            'DOUBLE NOT NULL AFTER discount'
        );
        $this->addColumn(
            '{{orders}}',
            'travel_service_fee_currency_id',
            'INT NOT NULL'
        );
        $this->addColumn(
            '{{orders}}',
            'city',
            'VARCHAR(255) NULL DEFAULT NULL'
        );
        $this->addColumn(
            '{{orders}}',
            'index',
            'VARCHAR(255) NULL DEFAULT NULL'
        );
        $this->addColumn(
            '{{orders}}',
            'company',
            'VARCHAR(255) NULL DEFAULT NULL'
        );
        $this->addColumn(
            '{{orders}}',
            'sub_agent_id',
            'INT NULL DEFAULT NULL'
        );

        $this->addColumn(
            '{{orders}}',
            'middle_name',
            'VARCHAR(255) NULL DEFAULT NULL AFTER first_name'
        );
        $this->addColumn(
            '{{orders}}',
            'mobile_phone',
            'VARCHAR(255) NULL DEFAULT NULL AFTER phone'
        );
        $this->addColumn(
            '{{orders}}',
            'tour_type_id',
            'INT NOT NULL DEFAULT 1'
        );
        $this->addColumn(
            '{{orders}}',
            'discount_currency_id',
            'INT NOT NULL DEFAULT 0'
        );

        $this->update(
            '{{orders}}',
            array(
                'travel_service_fee' => '100',
                'subcommission' => '10',
                'discount' => '5',
                'amount_paid' => '200',
                'travel_service_fee_currency_id' => 1,
                'city' => 'Hrodna',
                'index' => '230000',
                'company' => null,
                'sub_agent_id' => 3
            ),
            'id=1'
        );
        $this->update(
            '{{orders}}',
            array(
                'travel_service_fee' => '150',
                'subcommission' => '20',
                'discount' => '10',
                'amount_paid' => '300',
                'travel_service_fee_currency_id' => 2,
                'city' => 'Brest',
                'index' => '224000',
                'company' => 'IT-Company',
                'sub_agent_id' => 1
            ),
            'id=2'
        );
        $this->update(
            '{{orders}}',
            array(
                'travel_service_fee' => '200',
                'subcommission' => '30',
                'discount' => '15',
                'amount_paid' => '400',
                'travel_service_fee_currency_id' => 1,
                'city' => 'Brest',
                'index' => '224000',
                'company' => 'Company',
                'sub_agent_id' => 2
            ),
            'id=3'
        );

        $this->addForeignKey(
            'fk_travel_fee_currency_id',
            '{{orders}}',
            'travel_service_fee_currency_id',
            '{{currency}}',
            'id'

        );
        $this->addForeignKey(
            'fk_order_subagent',
            '{{orders}}',
            'sub_agent_id',
            '{{subagent}}',
            'id'

        );

        $this->addColumn(
            '{{participants}}',
            'passport_number',
            'VARCHAR(255) NULL DEFAULT NULL'
        );
        $this->addColumn(
            '{{participants}}',
            'date_of_issue',
            'DATE NULL DEFAULT NULL'
        );
        $this->addColumn(
            '{{participants}}',
            'date_of_expiry',
            'DATE NULL DEFAULT NULL'
        );
        $this->addColumn(
            '{{participants}}',
            'nationality',
            'VARCHAR(255) NULL DEFAULT NULL'
        );

        $this->dropColumn('{{orders}}','comment');

        $this->addColumn(
            '{{request_comments}}',
            'order_id',
            'INT NULL DEFAULT NULL'
        );

        $this->addForeignKey(
            'fk_comments_orders',
            '{{request_comments}}',
            'order_id',
            '{{orders}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->alterColumn(
            '{{request_comments}}',
            'request_id',
            'INT NULL DEFAULT NULL'
        );

	}

	public function down()
	{
        $this->addColumn('{{orders}}','comment','TEXT NULL DEFAULT NULL');

        $this->dropForeignKey('fk_travel_fee_currency_id','{{orders}}');
        $this->dropForeignKey('fk_order_subagent','{{orders}}');
        $this->dropForeignKey('fk_comments_orders','{{request_comments}}');

        $this->dropColumn('{{orders}}','travel_service_fee');
        $this->dropColumn('{{orders}}','subcommission');
        $this->dropColumn('{{orders}}','discount');
        $this->dropColumn('{{orders}}','amount_paid');
        $this->dropColumn('{{orders}}','travel_service_fee_currency_id');
        $this->dropColumn('{{orders}}','city');
        $this->dropColumn('{{orders}}','index');
        $this->dropColumn('{{orders}}','company');
        $this->dropColumn('{{orders}}','sub_agent_id');
        $this->dropColumn('{{orders}}','middle_name');
        $this->dropColumn('{{orders}}','mobile_phone');
        $this->dropColumn('{{orders}}','tour_type_id');
        $this->dropColumn('{{orders}}','discount_currency_id');
        $this->dropColumn('{{request_comments}}','order_id');

        $this->dropColumn('{{participants}}','passport_number');
        $this->dropColumn('{{participants}}','date_of_issue');
        $this->dropColumn('{{participants}}','date_of_expiry');
        $this->dropColumn('{{participants}}','nationality');

        $this->dropTable('{{subagent}}');

    }

}