<?php

class m130719_084958_fixing_phone_field extends CDbMigration
{
    public function up()
    {
        $this->alterColumn('{{requests}}', 'phone', 'VARCHAR(255) NULL DEFAULT NULL');
        $this->alterColumn('{{participants}}', 'phone', 'VARCHAR(255) NULL DEFAULT NULL');

    }

    public function down()
    {
        $this->alterColumn('{{requests}}', 'phone', 'INT NULL DEFAULT NULL');
        $this->alterColumn('{{participants}}', 'phone', 'INT NULL DEFAULT NULL');

    }

}