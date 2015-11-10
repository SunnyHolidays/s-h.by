<?php

class m130612_110107_users_test_data extends CDbMigration
{
    public function up()
    {
        $this->insert("{{users}}",array(
            'login'=>'andrey',
            'password'=>'1234',
            'first_name'=>'andrey',
            'last_name'=>'ivanov',
            'email'=>'ivanov@example.com',
            'role_id'=>'1'
        ));

        $this->insert("{{users}}",array(
            'login'=>'example',
            'password'=>'pass',
            'first_name'=>'alexei',
            'last_name'=>'pupkin',
            'email'=>'pupkin@example.com',
            'role_id'=>'1'
        ));

        $this->insert("{{users}}",array(
            'login'=>'ivan',
            'password'=>'ex12',
            'first_name'=>'ivan',
            'last_name'=>'sidorov',
            'email'=>'sidorov@example.com',
            'role_id'=>'1'
        ));

        $this->insert("{{requests}}",array(
            'date'=>'2013-06-13',
            'date_departure'=>'2013-06-22',
            'date_return'=>'2013-06-23',
            'duration'=>'1-14',
            'adults'=>'3',
            'children'=>'4',
            'budget'=>'100',
            'category'=>'1',
            'params'=>'',
            'first_name'=>'vladislav',
            'last_name'=>'romanovskyj',
            'email'=>'romanovskyj@gmail.com',
            'phone'=>'2323323',
            'user_id'=>'2',
            'status'=>'1',
            'comment'=>'',
            'date_next_step'=>'0000-00-00',
            'description_next_step'=>'',
            'source'=>'',
            'food'=> '0',
            'child_age' => '4;15;12;11'
        ));

        $this->insert("{{requests}}",array(
            'date'=>'2013-06-13',
            'date_departure'=>'2013-06-18',
            'date_return'=>'2013-06-20',
            'duration'=>'1-14',
            'adults'=>'2',
            'children'=>'1',
            'budget'=>'200',
            'category'=>'1',
            'params'=>'params',
            'first_name'=>'alexey',
            'last_name'=>'danilovich',
            'email'=>'danilovich@gmail.com',
            'phone'=>'23292939',
            'user_id'=>'3',
            'status'=>'2',
            'comment'=>'',
            'date_next_step'=>'2013-06-19',
            'description_next_step'=>'call',
            'source'=>'',
            'food'=> '0',
            'child_age' => '15'
        ));

        $this->insert("{{requests}}",array(
            'date'=>'2013-06-13',
            'date_departure'=>'2013-06-13',
            'date_return'=>'2013-06-15',
            'duration'=>'1-14',
            'adults'=>'1',
            'children'=>'2',
            'budget'=>'100',
            'category'=>'1',
            'params'=>'params',
            'first_name'=>'alexandr',
            'last_name'=>'shimovolos',
            'email'=>'shimovolos@gmail.com',
            'phone'=>'2147483647',
            'user_id'=>'1',
            'status'=>'1',
            'comment'=>'comment',
            'date_next_step'=>'2013-06-14',
            'description_next_step'=>'call',
            'source'=>'',
            'food'=> '0',
            'child_age' => '4;15'
        ));
    }

    public function down()
    {
        $this->delete("{{users}}",'email=:email',array(':email' => 'ivanov@example.com'));
        $this->delete("{{users}}",'email=:email',array(':email' => 'sidorov@example.com'));
        $this->delete("{{users}}",'email=:email',array(':email' => 'pupkin@example.com'));
        $this->delete("{{requests}}",'email=:email',array(':email' => 'romanovskyj@gmail.com'));
        $this->delete("{{requests}}",'email=:email',array(':email' => 'danilovich@gmail.com'));
        $this->delete("{{requests}}",'email=:email',array(':email' => 'shimovolos@gmail.com'));
    }

}