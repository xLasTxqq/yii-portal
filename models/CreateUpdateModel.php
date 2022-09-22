<?php 

namespace app\models;
use yii\base\Model;
use Yii;

class CreateUpdateModel extends Model
{
public $status;
public $img2;
public $comment;

public function rules()
{ 
	return [
            [['img2'],'required','when'=>function ($model) {return ($model->status == 'Решена');},'whenClient' => 'function(attribute,value){return ($("#applications-status").val()=="Решена");}',],
            [['comment'],'required','when'=>function ($model) {return ($model->status == 'Отклонена');},'whenClient' => 'function(attribute,value){return ($("#applications-status").val()=="Отклонена");}',],
            [['status'],'required'],
            [['status', 'comment'], 'string', 'max' => 255],
            [['img2'], 'image', 'extensions'=>'jpg, jpeg, png, bmp', 'maxSize' => '1310720', 'message' => '{attribute} Должна быть формате jpg, jpeg, png, bmp и размером до 10Мб!'],
        ];
}

public function createapplication($id)
{
	$appl=Applications::findOne($id);
	if($this->img2!=Null)
	{
		$naming = md5(uniqid($this->img2->baseName)).'.'.$this->img2->extension;
		$this->img2->saveAs('uploads/'.$naming);		
		$appl->img2=$naming;
	}
	if($this->comment!=Null)$appl->comment=$this->comment;
	$appl->status=$this->status;
	$appl->save();
	return True;
}

}
?>