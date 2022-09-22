<?php  

namespace app\models;
use yii\base\Model;
use Yii;

class CreateApplic extends Model
{
public $name;
public $description;
public $category;
public $img;

public function rules()
{ 
	return[
		[['name','description','category','img'],'required'],
		[['name','description'],'string','max'=>254],
		['img', 'image', 'extensions'=>'jpg, jpeg, png, bmp', 'maxSize' => '1310720', 'message' => '{attribute} Должна быть формате jpg, jpeg, png, bmp и размером до 10Мб!'],
	];
}

public function createapplication()
{
	$naming = md5(uniqid($this->img->baseName)).'.'.$this->img->extension;
	$this->img->saveAs('uploads/'.$naming);
	$appl=new Applications();
	$appl->name=$this->name;
	$appl->iduser=Yii::$app->user->identity->id;
	$appl->description=$this->description;
	$appl->category=$this->category;
	$appl->img=$naming;
	$appl->date=date('Y-m-d H:i:s');
	$appl->save();
	return true;
}

}
?>