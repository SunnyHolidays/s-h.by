<?php

class m130712_064832_remove_request_id_title extends CDbMigration
{
    public function up()
    {
        $this->dropColumn('{{participants}}', 'title');
        $this->alterColumn('{{participants}}', 'order_id', 'integer');
        $this->alterColumn('{{orders}}', 'request_id', 'integer');
    }

    public function down()
    {
        $this->addColumn('{{participants}}', 'title', 'varchar(255)');
        $this->alterColumn('{{participants}}', 'order_id', 'integer NOT NULL');
        $this->alterColumn('{{orders}}', 'request_id', 'integer NOT NULL');

    }

}