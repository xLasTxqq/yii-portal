<?php

use yii\db\Migration;

/**
 * Class m210704_200050_users
 */
class m210704_200050_users extends Migration
{

    public function up()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'fullname'=>$this->string(),
            'login'=>$this->string()->unique(),
            'email'=>$this->string()->unique(),
            'password'=>$this->string(),
            'role'=>$this->integer()->defaultValue(1),
            'date'=>$this->dateTime(),
        ]);
        $this->createTable('applications', [
            'id' => $this->primaryKey(),
            'iduser' => $this->integer(),
            'name' => $this->string(),
            'description' => $this->string(),
            'category' => $this->string(),
            'img' => $this->string(),
            'img2' => $this->string(),
            'status' => $this->string()->defaultValue('Новая'),
            'date'=>$this->dateTime(), 
            'comment'=>$this->string(),
        ]);
        $this->createTable('categories',[
            'id'=>$this->primaryKey(),
            'categories'=>$this->string(),
        ]);
        //Новая Решена Отклонена
        //1-new, 2-complete 3-canceled
        $this->insert('users',[
        'fullname'=>'Дядя Админ',
        'login'=>'admin',
        'password'=>sha1('adminWSR'),
        'role'=>'2',
        'email'=>'admin@gmail.com',
        'date'=>date('Y-m-d H:i:s'),
        ]);
    }
    public function down()
    {
        $this->dropTable('users');
        $this->dropTable('applications');
        $this->delete('users',['login'=>'admin']);
    }
}
