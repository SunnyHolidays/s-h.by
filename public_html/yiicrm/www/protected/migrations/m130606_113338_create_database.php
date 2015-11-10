<?php

class m130606_113338_create_database extends CDbMigration
{
    public function up()
    {
        $this->createTable(
            '{{users}}',
            array(
                'id' => 'pk',
                'login' => 'VARCHAR(255) NOT NULL',
                'password' => 'VARCHAR(255) NOT NULL',
                'first_name' => 'VARCHAR(255) NOT NULL',
                'last_name' => 'VARCHAR(255) NOT NULL',
                'email' => 'VARCHAR(255)  NOT NULL',
                'role_id' => 'INT NOT NULL',
            )
        );

        $this->createTable(
            '{{requests}}',
            array(
                'id' => 'pk',
                'date' => 'DATE NOT NULL',
                'date_departure' => 'DATE NULL DEFAULT NULL',
                'date_return' => 'DATE NULL DEFAULT NULL',
                'duration' => 'INT NULL DEFAULT NULL',
                'adults' => 'INT NULL DEFAULT NULL',
                'children' => 'VARCHAR(255) NULL DEFAULT NULL',
                'child_age' => 'VARCHAR(255) NULL DEFAULT NULL',
                'budget' => 'INT NULL DEFAULT NULL',
                'category' => 'INT NULL DEFAULT NULL',
                'params' => 'TEXT NULL DEFAULT NULL',
                'first_name' => 'VARCHAR(255) NULL DEFAULT NULL',
                'last_name' => 'VARCHAR(255) NULL DEFAULT NULL',
                'email' => 'VARCHAR(255) NULL DEFAULT NULL',
                'phone' => 'INT NULL DEFAULT NULL',
                'user_id' => 'INT NOT NULL',
                'status' => 'TINYINT NULL DEFAULT NULL',
                'comment' => 'TEXT NULL DEFAULT NULL',
                'date_next_step' => 'DATE NULL DEFAULT NULL',
                'description_next_step' => 'TEXT NULL DEFAULT NULL',
                'source' => 'VARCHAR(255) NULL DEFAULT NULL',
                'food' => 'INT NULL DEFAULT NULL'
            )
        );

        $this->createTable(
            '{{request_countries}}',
            array(
                'id' => 'pk',
                'request_id' => 'INT NOT NULL',
                'country_id' => 'INT NOT NULL',
            )
        );

        $this->createTable(
            '{{request_airports}}',
            array(
                'id' => 'pk',
                'request_id' => 'INT NOT NULL',
                'airport_id' => 'INT NOT NULL',
            )
        );

        $this->createTable(
            '{{request_comments}}',
            array(
                'id' => 'pk',
                'request_id' => 'INT NOT NULL',
                'user_id' => 'INT NOT NULL',
                'date' => 'DATE NOT NULL',
                'comment' => 'TEXT NOT NULL',
            )
        );

        $this->createTable(
            '{{attachments}}',
            array(
                'id' => 'pk',
                'path' => 'TEXT NULL DEFAULT NULL',
                'type' => 'VARCHAR(255) NULL DEFAULT NULL',
                'owner' => 'INT NULL DEFAULT NULL',
            )
        );

        $this->createTable(
            '{{tour_operators}}',
            array(
                'id' => 'pk',
                'title' => 'VARCHAR(255) NOT NULL',
            )
        );
        $this->createTable(
            '{{countries}}',
            array(
                'id' => 'pk',
                'title' => 'VARCHAR(255) NOT NULL',
            )
        );
        $this->createTable(
            '{{regions}}',
            array(
                'id' => 'pk',
                'title' => 'VARCHAR(255) NOT NULL',
                'country_id' => 'INT NOT NULL',
            )
        );
        $this->createTable(
            '{{hotels}}',
            array(
                'id' => 'pk',
                'title' => 'VARCHAR(255) NOT NULL',
                'region_id' => 'INT NOT NULL',
            )
        );
        $this->createTable(
            '{{airports}}',
            array(
                'id' => 'pk',
                'title' => 'VARCHAR(255) NOT NULL',
            )
        );
        $this->createTable(
            '{{currency}}',
            array(
                'id' => 'pk',
                'title' => 'VARCHAR(255) NOT NULL',
                'symbol' => 'VARCHAR(255) NOT NULL',
            )
        );
        $this->createTable(
            '{{exchange_rates}}',
            array(
                'id' => 'pk',
                'date' => 'DATE NOT NULL',
                'first_currency_id' => 'INT NOT NULL',
                'second_currency_id' => 'INT NOT NULL',
                'rate' => 'INT NOT NULL',
            )
        );
        $this->createTable(
            '{{orders}}',
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
                'price' => 'INT NOT NULL',
                'comission' => 'INT NOT NULL',
                'currency_id' => 'INT NOT NULL',
                'user_id' => 'INT NOT NULL',
                'comment' => 'TEXT NULL DEFAULT NULL',
            )
        );
        $this->createTable(
            '{{participants}}',
            array(
                'id' => 'pk',
                'first_name' => 'VARCHAR(255) NOT NULL',
                'last_name' => 'VARCHAR(255) NOT NULL',
                'title' => 'VARCHAR(255) NOT NULL',
                'birthday' => 'DATE NULL DEFAULT NULL',
                'passport_number' => 'VARCHAR(255) NULL DEFAULT NULL',
                'phone' => 'INT NULL DEFAULT NULL',
                'order_id' => 'INT NOT NULL',
            )
        );
        $this->createTable(
            '{{payment_customers}}',
            array(
                'id' => 'pk',
                'date' => 'DATE NOT NULL',
                'amount_due' => 'INT NOT NULL',
                'date_payment' => 'DATE NULL DEFAULT NULL',
                'amount_paid' => 'INT NOT NULL',
                'currency_id' => 'INT NOT NULL',
                'exchange_rate_id' => 'INT NOT NULL',
                'order_id' => 'INT NOT NULL',
            )
        );
        $this->createTable(
            '{{payment_operators}}',
            array(
                'id' => 'pk',
                'date' => 'DATE NOT NULL',
                'amount_due' => 'INT NOT NULL',
                'date_payment' => 'DATE NULL DEFAULT NULL',
                'amount_paid' => 'INT NOT NULL',
                'order_id' => 'INT NOT NULL',
            )
        );
        $this->createTable(
            '{{visas}}',
            array(
                'id' => 'pk',
                'participant_id' => 'INT NOT NULL',
                'type' => 'INT NOT NULL',
                'fee' => 'INT NULL DEFAULT NULL',
                'amount' => 'INT NULL DEFAULT NULL',
                'status' => 'INT NULL DEFAULT NULL',
                'date_next_step' => 'DATE NULL DEFAULT NULL',
                'description_next_step' => 'TEXT NULL DEFAULT NULL',
                'comment' => 'TEXT NULL DEFAULT NULL',
            )
        );


        $this->execute('ALTER TABLE {{users}} ENGINE=INNODB');
        $this->execute('ALTER TABLE {{requests}} ENGINE=INNODB');
        $this->execute('ALTER TABLE {{request_countries}} ENGINE=INNODB');
        $this->execute('ALTER TABLE {{request_airports}} ENGINE=INNODB');
        $this->execute('ALTER TABLE {{request_comments}} ENGINE=INNODB');
        $this->execute('ALTER TABLE {{attachments}} ENGINE=INNODB');
        $this->execute('ALTER TABLE {{tour_operators}} ENGINE=INNODB');
        $this->execute('ALTER TABLE {{countries}} ENGINE=INNODB');
        $this->execute('ALTER TABLE {{regions}} ENGINE=INNODB');
        $this->execute('ALTER TABLE {{hotels}} ENGINE=INNODB');
        $this->execute('ALTER TABLE {{airports}} ENGINE=INNODB');
        $this->execute('ALTER TABLE {{currency}} ENGINE=INNODB');
        $this->execute('ALTER TABLE {{exchange_rates}} ENGINE=INNODB');
        $this->execute('ALTER TABLE {{orders}} ENGINE=INNODB');
        $this->execute('ALTER TABLE {{participants}} ENGINE=INNODB');
        $this->execute('ALTER TABLE {{payment_customers}} ENGINE=INNODB');
        $this->execute('ALTER TABLE {{payment_operators}} ENGINE=INNODB');
        $this->execute('ALTER TABLE {{visas}} ENGINE=INNODB');


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
        $this->addForeignKey(
            'fk_order_currency',
            '{{orders}}',
            'currency_id',
            '{{currency}}',
            'id'
        );
        $this->addForeignKey(
            'fk_order_user',
            '{{orders}}',
            'user_id',
            '{{users}}',
            'id'
        );
        $this->addForeignKey(
            'fk_participant_order',
            '{{participants}}',
            'order_id',
            '{{orders}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_payment_customer_currency',
            '{{payment_customers}}',
            'currency_id',
            '{{currency}}',
            'id'
        );
        $this->addForeignKey(
            'fk_payment_customer_exchange_rate',
            '{{payment_customers}}',
            'exchange_rate_id',
            '{{exchange_rates}}',
            'id'
        );
        $this->addForeignKey(
            'fk_payment_customer_order',
            '{{payment_customers}}',
            'order_id',
            '{{orders}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_payment_operator_order',
            '{{payment_operators}}',
            'order_id',
            '{{orders}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_region_country',
            '{{regions}}',
            'country_id',
            '{{countries}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_hotel_region',
            '{{hotels}}',
            'region_id',
            '{{regions}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_exchange_rate_first_currency',
            '{{exchange_rates}}',
            'first_currency_id',
            '{{currency}}',
            'id'
        );
        $this->addForeignKey(
            'fk_exchange_rate_second_currency',
            '{{exchange_rates}}',
            'second_currency_id',
            '{{currency}}',
            'id'
        );
        $this->addForeignKey(
            'fk_request_user',
            '{{requests}}',
            'user_id',
            '{{users}}',
            'id'
        );
        $this->addForeignKey(
            'fk_request_comment_request',
            '{{request_comments}}',
            'request_id',
            '{{requests}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_request_comment_user',
            '{{request_comments}}',
            'user_id',
            '{{users}}',
            'id'
        );
        $this->addForeignKey(
            'fk_request_country_request',
            '{{request_countries}}',
            'request_id',
            '{{requests}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_request_country_country',
            '{{request_countries}}',
            'country_id',
            '{{countries}}',
            'id'
        );
        $this->addForeignKey(
            'fk_request_airport_request',
            '{{request_airports}}',
            'request_id',
            '{{requests}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_request_airport_airport',
            '{{request_airports}}',
            'airport_id',
            '{{airports}}',
            'id'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk_order_tour_operator', '{{orders}}');
        $this->dropForeignKey('fk_order_country', '{{orders}}');
        $this->dropForeignKey('fk_order_region', '{{orders}}');
        $this->dropForeignKey('fk_order_hotel', '{{orders}}');
        $this->dropForeignKey('fk_order_airport', '{{orders}}');
        $this->dropForeignKey('fk_order_currency', '{{orders}}');
        $this->dropForeignKey('fk_order_user', '{{orders}}');
        $this->dropForeignKey('fk_participant_order', '{{participants}}');
        $this->dropForeignKey('fk_payment_customer_currency', '{{payment_customers}}');
        $this->dropForeignKey('fk_payment_customer_exchange_rate', '{{payment_customers}}');
        $this->dropForeignKey('fk_payment_customer_order', '{{payment_customers}}');
        $this->dropForeignKey('fk_payment_operator_order', '{{payment_operators}}');
        $this->dropForeignKey('fk_region_country', '{{regions}}');
        $this->dropForeignKey('fk_hotel_region', '{{hotels}}');
        $this->dropForeignKey('fk_exchange_rate_first_currency', '{{exchange_rates}}');
        $this->dropForeignKey('fk_exchange_rate_second_currency', '{{exchange_rates}}');
        $this->dropForeignKey('fk_request_user', '{{requests}}');
        $this->dropForeignKey('fk_request_comment_request', '{{request_comments}}');
        $this->dropForeignKey('fk_request_comment_user', '{{request_comments}}');
        $this->dropForeignKey('fk_request_country_request', '{{request_countries}}');
        $this->dropForeignKey('fk_request_country_country', '{{request_countries}}');
        $this->dropForeignKey('fk_request_airport_request', '{{request_airports}}');
        $this->dropForeignKey('fk_request_airport_airport', '{{request_airports}}');


        $this->dropTable('{{users}}');
        $this->dropTable('{{requests}}');
        $this->dropTable('{{request_countries}}');
        $this->dropTable('{{request_airports}}');
        $this->dropTable('{{request_comments}}');
        $this->dropTable('{{attachments}}');
        $this->dropTable('{{tour_operators}}');
        $this->dropTable('{{countries}}');
        $this->dropTable('{{regions}}');
        $this->dropTable('{{hotels}}');
        $this->dropTable('{{airports}}');
        $this->dropTable('{{currency}}');
        $this->dropTable('{{exchange_rates}}');
        $this->dropTable('{{orders}}');
        $this->dropTable('{{participants}}');
        $this->dropTable('{{payment_customers}}');
        $this->dropTable('{{payment_operators}}');
        $this->dropTable('{{visas}}');
    }


}