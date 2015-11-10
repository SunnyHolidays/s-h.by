<?php

class m130715_141458_rename_comission_column_in_orders extends CDbMigration
{
	public function up()
	{
	 $this->renameColumn('{{orders}}', 'comission', 'commission');
	}

	public function down()
	{
	 $this->renameColumn('{{orders}}', 'commission', 'comission');
	}

}