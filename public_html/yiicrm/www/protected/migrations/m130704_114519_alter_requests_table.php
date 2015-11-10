<?php

class m130704_114519_alter_requests_table extends CDbMigration
{
    public function up()
    {
        $this->alterColumn('{{requests}}', 'user_id', 'INT NULL DEFAULT NULL');
        $this->alterColumn('{{requests}}', 'duration', 'VARCHAR(10) NULL DEFAULT NULL');
    }

    public function down()
    {
        $this->alterColumn('{{requests}}', 'user_id', 'INT NOT NULL');
        $this->alterColumn('{{requests}}', 'duration', 'INT NULL DEFAULT NULL');
    }

}