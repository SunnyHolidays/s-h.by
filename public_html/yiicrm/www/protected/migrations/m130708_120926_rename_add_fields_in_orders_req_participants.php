<?php

class m130708_120926_rename_add_fields_in_orders_req_participants extends CDbMigration
{
    public function up()
    {
        $this->renameColumn('{{requests}}', 'food', 'pension_type');
        $this->addColumn('{{orders}}', 'room_type', 'varchar(255)');
        $this->addColumn('{{orders}}', 'request_id', 'integer NOT NULL');
        $this->addColumn('{{participants}}', 'email', 'varchar(100)');
        $this->addForeignKey('fk_order_request', '{{orders}}', 'request_id', 'requests', 'id');
        $this->insert(
            '{{tour_operators}}',
            array(
                'id' => 1,
                'title' => 'Туроператор Минск'
            )
        );
        $this->insert(
            '{{tour_operators}}',
            array(
                'id' => 2,
                'title' => 'Туроператор Гродно'
            )
        );
        $this->insert(
            '{{tour_operators}}',
            array(
                'id' => 3,
                'title' => 'Туроператор Брест'
            )
        );
        $this->insert(
            '{{regions}}',
            array(
                'id' => 1,
                'title' => 'Region Name in Minsk',
                'country_id' => 1
            )
        );
        $this->insert(
            '{{regions}}',
            array(
                'id' => 2,
                'title' => 'Region Name in Hrodno',
                'country_id' => 1
            )
        );
        $this->insert(
            '{{regions}}',
            array(
                'id' => 3,
                'title' => 'Region Name Brest',
                'country_id' => 1
            )
        );
        $this->insert(
            '{{hotels}}',
            array(
                'id' => 1,
                'title' => 'Hotel Plaza',
                'region_id' => 1
            )
        );
        $this->insert(
            '{{hotels}}',
            array(
                'id' => 2,
                'title' => 'Hotel Hotel',
                'region_id' => 1
            )
        );
        $this->insert(
            '{{hotels}}',
            array(
                'id' => 3,
                'title' => 'Plaza Plaza',
                'region_id' => 1
            )
        );
        $this->insert(
            '{{currency}}',
            array(
                'id' => 1,
                'title' => 'USD',
                'symbol' => '$'
            )
        );
        $this->insert(
            '{{currency}}',
            array(
                'id' => 2,
                'title' => 'EUR',
                'symbol' => '€'
            )
        );
        $this->insert(
            '{{currency}}',
            array(
                'id' => 3,
                'title' => 'BLR',
                'symbol' => 'BLR'
            )
        );

        $this->insert(
            '{{orders}}',
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
                'price' => '1000',
                'comission' => '12',
                'currency_id' => 2,
                'user_id' => 1,
                'comment' => 'poehalipoehali',
                'room_type' => 'room_type',
                'request_id' => 1

            )
        );
        $this->insert(
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
                'price' => '1000',
                'comission' => '12',
                'currency_id' => 2,
                'user_id' => 2,
                'comment' => 'poehalipoehalipoehali',
                'room_type' => 'room_type',
                'request_id' => 1

            )
        );
        $this->insert(
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
                'price' => '1000',
                'comission' => '12',
                'currency_id' => 2,
                'user_id' => 3,
                'comment' => 'poehalipoehalipoehalipoehali',
                'room_type' => 'room_type',
                'request_id' => 1

            )
        );
    }

    public function down()
    {
        $this->delete("{{orders}}", 'id=:id', array(':id' => 1));
        $this->delete("{{orders}}", 'id=:id', array(':id' => 2));
        $this->delete("{{orders}}", 'id=:id', array(':id' => 3));
        $this->delete("{{currency}}", 'id=:id', array(':id' => 1));
        $this->delete("{{currency}}", 'id=:id', array(':id' => 2));
        $this->delete("{{currency}}", 'id=:id', array(':id' => 3));
        $this->delete("{{hotels}}", 'id=:id', array(':id' => 1));
        $this->delete("{{hotels}}", 'id=:id', array(':id' => 2));
        $this->delete("{{hotels}}", 'id=:id', array(':id' => 3));
        $this->delete("{{regions}}", 'id=:id', array(':id' => 1));
        $this->delete("{{regions}}", 'id=:id', array(':id' => 2));
        $this->delete("{{regions}}", 'id=:id', array(':id' => 3));
        $this->delete("{{tour_operators}}", 'id=:id', array(':id' => 1));
        $this->delete("{{tour_operators}}", 'id=:id', array(':id' => 2));
        $this->delete("{{tour_operators}}", 'id=:id', array(':id' => 3));

        $this->dropForeignKey('fk_order_request', '{{orders}}');
        $this->renameColumn('{{requests}}', 'pension_type', 'food');
        $this->dropColumn('{{orders}}', 'room_type');
        $this->dropColumn('{{orders}}', 'request_id');
        $this->dropColumn('{{participants}}', 'email');
    }

}