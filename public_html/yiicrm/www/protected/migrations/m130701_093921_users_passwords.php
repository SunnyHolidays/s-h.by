<?php

class m130701_093921_users_passwords extends CDbMigration
{
    public function up()
    {

        $this->update(
            "{{users}}",
            array(
                'password' => crypt('1234', '$2a$10$s5EbdF7KRCmiUmZJKiLfeZ')
            ),
            'id=1'
        );
        $this->update(
            "{{users}}",
            array(
                'password' => crypt('pass', '$2a$10$s5EbdF7KRCmiUmZJKiLfeZ')
            ),
            'id=2'
        );
        $this->update(
            "{{users}}",
            array(
                'password' => crypt('ex12', '$2a$10$s5EbdF7KRCmiUmZJKiLfeZ')
            ),
            'id=3'
        );
        $this->insert(
            "{{users}}",
            array(
                'login' => 'admin',
                'password' => '$2a$10$s5EbdF7KRCmiUmZJKiLfeO453ZFCeKm4Ak6OlEPk4Eli2LyHjHhMS',
                'first_name' => 'admin_name',
                'last_name' => 'admin_last_name',
                'email' => 'admin@email.com',
                'role_id' => '2',
            )
        );
    }

    public function down()
    {
        $this->update(
            "{{users}}",
            array(
                'password' => '1234'
            ),
            'id=:id',
            array(':id' => 1)
        );
        $this->update(
            "{{users}}",
            array(
                'password' => 'pass'
            ),
            'id=:id',
            array(':id' => 2)
        );
        $this->update(
            "{{users}}",
            array(
                'password' => 'ex12'
            ),
            'id=:id',
            array(':id' => 3)
        );
        $this->delete("{{users}}", 'id=:id', array(':id' => '4'));

    }
}