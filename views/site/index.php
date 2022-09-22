<link rel="stylesheet" type="text/css" href="site.css">
<?php

/* @var $this yii\web\View */
$this->title = 'Городской портал «Сделаем лучше вместе!»';
// $this->params['breadcrumbs'][] = $this->title;
use app\models\Users;
use app\models\Applications;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
?>

<!-- ?php if(!Yii::$app->user->isGuest) echo "<a class='btn btn-success' href = /web/index.php?r=site%2Fabout>Создать заявку</a>"?> -->
<div class="copy">
<div class="head" id="head">
<?php if(Yii::$app->user->isGuest) echo Html::a('Логин',['/site/login'], ['class' => 'btn btn-success']) ?>
<?php if(Yii::$app->user->isGuest) echo Html::a('Регистрация',['/site/register'], ['class' => 'btn btn-success']) ?>
<?php if(!Yii::$app->user->isGuest) echo Html::a('Создать заявку', ['/site/newapplication'], ['class' => 'btn btn-success']) ?>
<?php Pjax::begin(); ?><h1 class="odometer" id="odometer"><div class="adometer">Заявок решено: <?=count(Applications::find()->where(['status'=>'Решена'])->all())?></div></h1> <?php Pjax::end(); ?>
</div>
</div>
<!-- <button onclick="music()">Кликни сюда</button>
<h1 class="bug">апвпвап</h1> -->
<div class="main">
<?php
    Pjax::begin(); 
    echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',],
        ['attribute'=>'date','format' => 'datetime',],
        'name',
        'category',
        // ['attribute'=>'img2','format'=>'image','value'=>function($data) { return \Yii::$app->request->BaseUrl.'/uploads/'.$data->img; }],
        ['attribute'=>'img','format'=>'html','value'=>function($data) {  
        return Html::decode("<div class=images><img class=img2 src=/web/uploads/$data->img ><img class=img1 src=/web/uploads/$data->img2>");
        //Html::tag('div',array('key'=>Html::img('/web/uploads/' . $data['img']),'key2'=>Html::img('/web/uploads/' . $data['img'])));
        // Html::img('/web/uploads/' . $data['img'],['alt'=>'/web/uploads/' . $data['img2'],'width' => '80px','height' => '80px','data-toggle'=>'tooltip','data-placement'=>'right',
        // 'title' => 'Первая' ,'style'=>'cursor:default;']);
        }]
                ],
]);

Pjax::end(); ?>
</div>
<script type="text/javascript">
var Schet=document.getElementById('odometer').innerHTML;
setInterval(function(){
$(".copy").load("index.php #head");
}, 5000);
setInterval(function(){
if(document.getElementById('odometer').innerHTML!=Schet){new Audio('/logo/Sound_17211.mp3').play();Schet=document.getElementById('odometer').innerHTML;}
}, 1000);
// function music(){
// new Audio('/logo/Sound_17211.mp3').play();
// }
</script>
<!-- <link rel="stylesheet" href="http://github.hubspot.com/odometer/themes/odometer-theme-car.css" />
<script src="http://github.hubspot.com/odometer/odometer.js"></script> -->
