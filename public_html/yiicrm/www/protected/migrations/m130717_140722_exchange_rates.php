<?php

class m130717_140722_exchange_rates extends CDbMigration
{
	public function up()
	{
        $this->alterColumn('{{exchange_rates}}', 'rate', 'double NOT NULL');
        $this->insert('{{currency}}', array(
           'title'=> 'GBP',
           'symbol' => '£'
        ));
        $this->insert('{{currency}}', array(
           'title'=> 'JPY',
           'symbol' => '¥'
        ));

        $this->insert('{{exchange_rates}}', array(
                'date' => '2013-07-02',
                'first_currency_id' => 1,
                'second_currency_id' => 3,
                'rate' => '8905'
            )
        );
        $this->insert('{{exchange_rates}}', array(
                'date' => '2013-07-03',
                'first_currency_id' => 2,
                'second_currency_id' => 1,
                'rate' => '11665'
            )
        );
        $this->insert('{{exchange_rates}}', array(
                'date' => '2013-07-10',
                'first_currency_id' => 1,
                'second_currency_id' => 2,
                'rate' => '0.7607'
            )
        );
        $this->insert('{{exchange_rates}}', array(
                'date' => '2013-07-21',
                'first_currency_id' => 2,
                'second_currency_id' => 1,
                'rate' => '1.3069'
            )
        );
        $this->insert('{{exchange_rates}}', array(
                'date' => '2013-07-21',
                'first_currency_id' => 5,
                'second_currency_id' => 1,
                'rate' => '0.0099'
            )
        );
        $this->insert('{{exchange_rates}}', array(
                'date' => '2013-07-21',
                'first_currency_id' => 1,
                'second_currency_id' => 5,
                'rate' => '99.7340'
            )
        );
        $this->insert('{{exchange_rates}}', array(
                'date' => '2013-07-21',
                'first_currency_id' => 2,
                'second_currency_id' => 5,
                'rate' => '130.1485'
            )
        );
        $this->insert('{{exchange_rates}}', array(
                'date' => '2013-07-21',
                'first_currency_id' => 1,
                'second_currency_id' => 4,
                'rate' => '0.6637'
            )
        );
        $this->insert('{{exchange_rates}}', array(
                'date' => '2013-07-22',
                'first_currency_id' => 1,
                'second_currency_id' => 4,
                'rate' => '0.6608'
            )
        );
        $this->insert('{{exchange_rates}}', array(
                'date' => '2013-07-23',
                'first_currency_id' => 1,
                'second_currency_id' => 4,
                'rate' => '0.6627'
            )
        );
	}

	public function down()
	{
        $this->delete('{{exchange_rates}}', 'first_currency_id=:first_currency_id and second_currency_id=:second_currency_id', array(':first_currency_id'=>1,':second_currency_id' => 3));
        $this->delete('{{exchange_rates}}', 'first_currency_id=:first_currency_id and second_currency_id=:second_currency_id', array(':first_currency_id'=>2,':second_currency_id' => 1));
        $this->delete('{{exchange_rates}}', 'first_currency_id=:first_currency_id and second_currency_id=:second_currency_id', array(':first_currency_id'=>1,':second_currency_id' => 2));
        $this->delete('{{exchange_rates}}', 'first_currency_id=:first_currency_id and second_currency_id=:second_currency_id', array(':first_currency_id'=>2,':second_currency_id' => 1));
        $this->delete('{{exchange_rates}}', 'first_currency_id=:first_currency_id and second_currency_id=:second_currency_id', array(':first_currency_id'=>5,':second_currency_id' => 1));
        $this->delete('{{exchange_rates}}', 'first_currency_id=:first_currency_id and second_currency_id=:second_currency_id', array(':first_currency_id'=>1,':second_currency_id' => 5));
        $this->delete('{{exchange_rates}}', 'first_currency_id=:first_currency_id and second_currency_id=:second_currency_id', array(':first_currency_id'=>2,':second_currency_id' => 5));
        $this->delete('{{exchange_rates}}', 'first_currency_id=:first_currency_id and second_currency_id=:second_currency_id', array(':first_currency_id'=>1,':second_currency_id' => 4));

        $this->delete('{{currency}}', 'id=:id', array(':id'=>4));
        $this->delete('{{currency}}', 'id=:id', array(':id'=>5));

        $this->alterColumn('{{exchange_rates}}', 'rate', 'integer NOT NULL');

    }

}