<?php

class m130717_105549_visas_addrelation extends CDbMigration
{
	public function up()
	{
        $this->addForeignKey(
            'fk_visas_participants',
            '{{visas}}',
            'participant_id',
            '{{participants}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
	}

	public function down()
	{
        $this->dropForeignKey('fk_visas_participants', '{{visas}}');
    }
}