<?php

class m130706_162328_mail_templates_table_and_data extends CDbMigration
{
    public function up()
    {
        $this->createTable(
            '{{mail_templates}}',
            array(
                'id' => 'pk',
                'alias' => 'VARCHAR(255) NOT NULL',
                'title' => 'VARCHAR(255) NOT NULL',
                'from' => 'VARCHAR(255) NOT NULL',
                'email' => 'VARCHAR(255) NOT NULL',
                'subject' => 'VARCHAR(255) NOT NULL',
                'body' => 'TEXT NOT NULL',
                'body_text' => 'TEXT NOT NULL',
                'tags' => 'VARCHAR(255) NOT NULL',
            )
        );
        $this->execute('ALTER TABLE {{mail_templates}} ENGINE=INNODB');
        $this->insert(
            "{{mail_templates}}",
            array(
                'alias'=>'test',
                'title' => 'Тестовое',
                'from' => 'postmaster',
                'email' => 'postmaster@localhost',
                'subject' => 'Тестовое',
                'body' => ' <!doctype html>
                            <html lang="ru_RU">
                            <head>
                                <meta charset="UTF-8">
                                <title>{subject}</title>
                            </head>
                            <body>
                            Тестовое письмо от {user}
                            </body>
                            </html>',
                'body_text' => 'Тестовое письмо от {user}',
                'tags' => 'subject;user',
            )
        );
    }

    public function down()
    {
        $this->dropTable('{{mail_templates}}');
        $this->delete("{{mail_templates}}",'id=:id',array(':id' => 1));
    }

}

