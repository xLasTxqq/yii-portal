<?php  

namespace app\models;
use yii\base\Model;

class Reg extends Model
{
public $fullname;
public $login;
public $email;
public $password;
public $passwordRepeat;

public function rules()
{
	return[
		[['email','password','login','fullname','passwordRepeat'],'required'],
		['email','email'],
		[['email','login'],'unique','targetClass'=>'app\models\Users'],
		['password','string','min'=>5],
		['passwordRepeat', 'compare', 'compareAttribute' => 'password'],
		['fullname','match','pattern'=> '/^[А-я]+[А-я -]+[А-я]+$/ui','message' => '{attribute} должен начинаться и заканчиваться буквой и содержать только кириллицу, дефис и пробелы!'],
		['login','match','pattern'=> '/^[A-z]*$/i','message' => '{attribute} должен содержать только латиницу!'],
	];
}

public function register()
{
	$user=new Users();
	$user->fullname=$this->fullname;
	$user->login=$this->login;
	$user->email=$this->email;
	$user->setPassword($this->password);
	$user->date=date('Y-m-d H:i:s');
	$user->save();
	return True;
}
}

?>