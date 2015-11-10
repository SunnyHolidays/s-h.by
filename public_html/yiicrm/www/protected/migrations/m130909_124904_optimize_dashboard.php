<?php

class m130909_124904_optimize_dashboard extends CDbMigration
{
	public function up()
	{
        $this->dropColumn('{{user_widgets}}', 'size_x');
        $this->dropColumn('{{user_widgets}}', 'size_y');
        $this->dropColumn('{{user_widgets}}', 'type');
        $this->dropColumn('{{user_widgets}}', 'params');
	}

	public function down()
	{
        $this->addColumn('{{user_widgets}}', 'size_x','INT NOT NULL');
        $this->addColumn('{{user_widgets}}', 'size_y','INT NOT NULL');
        $this->addColumn('{{user_widgets}}', 'type','VARCHAR(50) NOT NULL');
        $this->addColumn('{{user_widgets}}', 'params','VARCHAR(250) NOT NULL');
	}


}