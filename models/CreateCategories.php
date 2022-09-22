<?php 

namespace app\models;
use yii\base\Model;
use Yii;

class CreateCategories extends Model
{
public $categories;

public function rules()
{ 
	return[
		[['categories'],'required'],
		[['categories'],'string','max'=>254],
	];
}

public function createapplication()
{
	$cate=new Categories();
	$cate->categories=$this->categories;
	$cate->save();
	return True;
}

}
?>