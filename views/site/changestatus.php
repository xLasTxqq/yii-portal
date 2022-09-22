<?php
use app\models\Users;
use app\models\Applications;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\widgets\Pjax;
$this->title = 'Изменение статуса';
$this->params['breadcrumbs'][] = $this->title;
?>

<center>
<h1><?= Html::encode($this->title) ?></h1>
<?php if(count(Applications::find()->orderBy('date DESC')->all())>0){?>

<?php Pjax::begin(); ?>
<div class="main">
<?php

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
            // ['class' => 'yii\grid\CheckboxColumn',],
            ['class' => 'yii\grid\SerialColumn',],
            ['class' => 'yii\grid\ActionColumn','template'=>'{delete}{update}',/*'header'=>'Delete',*/'visibleButtons'=>['delete' => 
            function ($model, $key, $index) {return $model->status === 'Новая'&&$model->iduser===Yii::$app->user->identity->id;},
            'update'=>function ($model, $key, $index){return $model->status === 'Новая';}],
        	],
        // ['class' => 'yii\grid\DataColumn',],
        ['attribute'=>'date','format' => 'datetime',],
        'name',
        'description',
        'category',
        'status',
        // ['attribute'=>'status', 'value'=>function($data){if($data->status==1)return 'Новая';if($data->status==2)return 'Решена';if($data->status==3)return 'Отклонена';},],

    ],
]);
?>

</div>
<?php Pjax::end(); ?>
<?php }else echo "<h1>Сейчас нет заявок!</h1>";?>
</center>