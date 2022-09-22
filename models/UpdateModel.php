<?php 

namespace app\models; 

use Yii;

/**
 * This is the model class for table "applications".
 *
 * @property int $id
 * @property int|null $iduser
 * @property string|null $name
 * @property string|null $description
 * @property string|null $category
 * @property string|null $img
 * @property int|null $status
 * @property string|null $date
 */
class UpdateModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'applications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['img2'],'required','when'=>function ($model) {return ($model->status == 'Решена');},'whenClient' => 'function(attribute,value){return ($("#applications-status").val()=="Решена");}',],
            [['comment'],'required','when'=>function ($model) {return ($model->status == 'Отклонена');},'whenClient' => 'function(attribute,value){return ($("#applications-status").val()=="Отклонена");}',],
            [['status'],'required'],
            [['iduser'], 'integer'],
            [['date'], 'safe'],
            [['name', 'description', 'category', 'img', 'status', 'comment'], 'string', 'max' => 255],
            [['img2'], 'image', 'extensions'=>'jpg, jpeg, png, bmp', 'maxSize' => '1310720', 'message' => '{attribute} Должна быть формате jpg, jpeg, png, bmp и размером до 10Мб!'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'iduser' => Yii::t('app', 'Iduser'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'category' => Yii::t('app', 'Category'),
            'img' => Yii::t('app', 'Img'),
            'status' => Yii::t('app', 'Status'),
            'date' => Yii::t('app', 'Date'),
            'img2' => Yii::t('app', 'Img2'),
            'comment' => Yii::t('app', 'Comment'),
        ];
    }
}
