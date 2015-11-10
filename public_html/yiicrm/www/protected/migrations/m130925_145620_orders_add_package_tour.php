<?php

class m130925_145620_orders_add_package_tour extends CDbMigration
{
	public function up()
	{
        $this->createTable(
            '{{package_tour}}',
            array(
                'id' => 'pk',
                'number' => 'INT NOT NULL',
                'tour_operator_id' => 'INT NOT NULL',
                'date' => 'DATE NOT NULL',
                'date_departure' => 'DATE NOT NULL',
                'date_return' => 'DATE NOT NULL',
                'country_id' => 'INT NOT NULL',
                'region_id' => 'INT NOT NULL',
                'hotel_id' => 'INT NOT NULL',
                'airport_id' => 'INT NOT NULL',
            )
        );
        $this->execute('ALTER TABLE {{package_tour}} ENGINE=INNODB');
        $this->insert(
            '{{package_tour}}',
            array(
                'id' => 1,
                'number' => '1',
                'tour_operator_id' => 1,
                'date' => '2013-07-08',
                'date_departure' => '2013-07-08',
                'date_return' => '2013-07-08',
                'country_id' => 1,
                'region_id' => 3,
                'hotel_id' => 3,
                'airport_id' => 2,
            )
        );
        $this->insert(
            '{{package_tour}}',
            array(
                'id' => 2,
                'number' => '1',
                'tour_operator_id' => 1,
                'date' => '2013-07-08',
                'date_departure' => '2013-07-08',
                'date_return' => '2013-07-08',
                'country_id' => 11,
                'region_id' => 2,
                'hotel_id' => 1,
                'airport_id' => 2,
            )
        );
        $this->insert(
            '{{package_tour}}',
            array(
                'id' => 3,
                'number' => '1',
                'tour_operator_id' => 1,
                'date' => '2013-07-08',
                'date_departure' => '2013-07-08',
                'date_return' => '2013-07-08',
                'country_id' => 1,
                'region_id' => 1,
                'hotel_id' => 1,
                'airport_id' => 2,
            )
        );

        $this->dropForeignKey('fk_order_tour_operator', '{{orders}}');
        $this->dropForeignKey('fk_order_country', '{{orders}}');
        $this->dropForeignKey('fk_order_region', '{{orders}}');
        $this->dropForeignKey('fk_order_hotel', '{{orders}}');
        $this->dropForeignKey('fk_order_airport', '{{orders}}');

        $this->dropColumn('{{orders}}','number');
        $this->dropColumn('{{orders}}','tour_operator_id');
        $this->dropColumn('{{orders}}','date');
        $this->dropColumn('{{orders}}','date_departure');
        $this->dropColumn('{{orders}}','date_return');
        $this->dropColumn('{{orders}}','country_id');
        $this->dropColumn('{{orders}}','region_id');
        $this->dropColumn('{{orders}}','hotel_id');
        $this->dropColumn('{{orders}}','airport_id');

        $this->addColumn(
            '{{orders}}',
            'package_tour_id',
            'INT NOT NULL'
        );

        $this->update(
            '{{orders}}',
            array(
                'package_tour_id' => 1
            ),
            'id=1'
        );
        $this->update(
            '{{orders}}',
            array(
                'package_tour_id' => 2
            ),
            'id=2'
        );
        $this->update(
            '{{orders}}',
            array(
                'package_tour_id' => 3
            ),
            'id=3'
        );

        $this->addForeignKey(
            'fk_order_package_tour',
            '{{orders}}',
            'package_tour_id',
            '{{package_tour}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_package_tour_operator',
            '{{package_tour}}',
            'tour_operator_id',
            '{{tour_operators}}',
            'id'
        );
        $this->addForeignKey(
            'fk_package_tour_country',
            '{{package_tour}}',
            'country_id',
            '{{countries}}',
            'id'
        );
        $this->addForeignKey(
            'fk_package_tour_region',
            '{{package_tour}}',
            'region_id',
            '{{regions}}',
            'id'
        );
        $this->addForeignKey(
            'fk_package_tour_hotel',
            '{{package_tour}}',
            'hotel_id',
            '{{hotels}}',
            'id'
        );
        $this->addForeignKey(
            'fk_package_tour_airport',
            '{{package_tour}}',
            'airport_id',
            '{{airports}}',
            'id'
        );
        $this->addColumn(
            '{{package_tour}}',
            'pension_type',
            'VARCHAR(255) NULL DEFAULT NULL'
        );
	}

	public function down()
	{
        $this->dropForeignKey('fk_package_tour_operator','{{package_tour}}');
        $this->dropForeignKey('fk_package_tour_country','{{package_tour}}');
        $this->dropForeignKey('fk_package_tour_region','{{package_tour}}');
        $this->dropForeignKey('fk_package_tour_hotel','{{package_tour}}');
        $this->dropForeignKey('fk_package_tour_airport','{{package_tour}}');
        $this->dropForeignKey('fk_order_package_tour','{{orders}}');

        $this->dropColumn('{{orders}}','package_tour_id');

        $this->dropTable('{{package_tour}}');

        $this->addColumn(
            '{{orders}}',
            'number',
            'INT NOT NULL AFTER id'
        );
        $this->addColumn(
            '{{orders}}',
            'tour_operator_id',
            'INT NOT NULL AFTER number'
        );
        $this->addColumn(
            '{{orders}}',
            'date',
            'DATE NOT NULL AFTER tour_operator_id'
        );
        $this->addColumn(
            '{{orders}}',
            'date_departure',
            'DATE NOT NULL AFTER date'
        );
        $this->addColumn(
            '{{orders}}',
            'date_return',
            'DATE NOT NULL AFTER date_departure'
        );
        $this->addColumn(
            '{{orders}}',
            'country_id',
            'INT NOT NULL AFTER date_return'
        );
        $this->addColumn(
            '{{orders}}',
            'region_id',
            'INT NOT NULL AFTER country_id'
        );
        $this->addColumn(
            '{{orders}}',
            'hotel_id',
            'INT NOT NULL AFTER region_id'
        );
        $this->addColumn(
            '{{orders}}',
            'airport_id',
            'INT NOT NULL AFTER hotel_id'
        );

        $this->update(
            '{{orders}}',
            array(
                'number' => '1',
                'tour_operator_id' => 1,
                'date' => '2013-07-08',
                'date_departure' => '2013-07-08',
                'date_return' => '2013-07-08',
                'country_id' => 1,
                'region_id' => 3,
                'hotel_id' => 3,
                'airport_id' => 2,
            ),
            'id=1'
        );
        $this->update(
            '{{orders}}',
            array(
                'number' => '1',
                'tour_operator_id' => 1,
                'date' => '2013-07-08',
                'date_departure' => '2013-07-08',
                'date_return' => '2013-07-08',
                'country_id' => 11,
                'region_id' => 2,
                'hotel_id' => 1,
                'airport_id' => 2,
            ),
            'id=2'
        );
        $this->update(
            '{{orders}}',
            array(
                'number' => '1',
                'tour_operator_id' => 1,
                'date' => '2013-07-08',
                'date_departure' => '2013-07-08',
                'date_return' => '2013-07-08',
                'country_id' => 1,
                'region_id' => 1,
                'hotel_id' => 1,
                'airport_id' => 2,
            ),
            'id=3'
        );

        $this->addForeignKey(
            'fk_order_tour_operator',
            '{{orders}}',
            'tour_operator_id',
            '{{tour_operators}}',
            'id'
        );
        $this->addForeignKey(
            'fk_order_country',
            '{{orders}}',
            'country_id',
            '{{countries}}',
            'id'
        );
        $this->addForeignKey(
            'fk_order_region',
            '{{orders}}',
            'region_id',
            '{{regions}}',
            'id'
        );
        $this->addForeignKey(
            'fk_order_hotel',
            '{{orders}}',
            'hotel_id',
            '{{hotels}}',
            'id'
        );
        $this->addForeignKey(
            'fk_order_airport',
            '{{orders}}',
            'airport_id',
            '{{airports}}',
            'id'
        );
       $this->dropColumn('{{package_tour}}','pension_type');
    }

}