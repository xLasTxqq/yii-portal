<?php
$this->title = 'Личный кабинет';
// $this->title = Yii::t('app', 'Applications Models');
$this->params['breadcrumbs'][] = $this->title;
use app\models\Users;
use app\models\Applications;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\widgets\Pjax;
?>
<?= Html::a(Yii::t('app', 'New appliction'), ['newapplication'], ['class' => 'btn btn-success']) ?>
<center>
<h1><?= Html::encode($this->title) ?></h1>
<?php if(count(Applications::find()->orderBy('date DESC')->where(['iduser'=>Yii::$app->user->identity->id])->all())>0){?>
<h1 style="text-align:center;">Ваши заявки</h1>
<div class="main">
<?php Pjax::begin(); ?>
<?php

// $dataProvider = new ActiveDataProvider([
//     'query' => Applications::find()->where(['iduser'=>Yii::$app->user->identity->id]),
//     'pagination' => [
//         'pageSize' => 20,
//     ],
//     'sort' => [
//         'defaultOrder' => [
//             'date' => SORT_DESC, 
//         ],
//     ],
// ]);
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
            // ['class' => 'yii\grid\CheckboxColumn',],
            ['class' => 'yii\grid\SerialColumn',],
            ['class' => 'yii\grid\ActionColumn','template'=>'{delete}',/*'header'=>'Delete',*/'visibleButtons'=>['delete' => 
            function ($model, $key, $index) {return $model->status === 'Новая';},],],
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

<!-- <table>
    <tr><th>Time</th><th>Name</th><th>Description</th><th>Category</th><th>Status</th></tr>
<? /* php $appl=Applications::find()->orderBy('date DESC')->where(['iduser'=>Yii::$app->user->identity->id])->all();

foreach ($appl as $key) {
    echo "<tr><td>{$key['date']}</td><td>{$key['name']}</td><td>{$key['description']}</td><td>{$key['category']}</td>";
    if($key['status']==1)
    echo "<td>Новая</td></tr>";
    else if($key['status']==2)
    echo "<td>Решена</td></tr>";
    else echo "<td>Отклонена</td></tr>";
}
*/
?> 
</table> -->

<?php Pjax::end(); ?>
<?php }else echo "<h1>У вас нет созданных заявок!</h1>";?>
</center>