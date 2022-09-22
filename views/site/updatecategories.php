<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
$this->title = 'Изменение категорий';
$this->params['breadcrumbs'][] = $this->title;
Pjax::begin(); 
$form=ActiveForm::begin(['options'=>['data' => ['pjax' => true]],'class'=>'form-horizontal']);
?>
<?= $form->field($model,'categories')->textInput([/*'autofocus'=>true,*/'maxlength'=>true]) ?>
<!-- <div>
    <button type="submit" onclick="confirm('Вы хотите создать новую категорию?')">Отправить</button>
</div> -->
<?= Html::submitButton(Yii::t('app', 'Отправить'), [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => Yii::t('app', 'Вы точно хотите создать новую категорию?'),
                'method' => 'post',
            ],
        ]) ?>
<?php
ActiveForm::end();
Pjax::end();
?>
<center>
<h1><?= Html::encode($this->title) ?></h1>
<div class="main">
<?php Pjax::begin(); 

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',],
            ['class' => 'yii\grid\ActionColumn','template'=>'{delete}','header'=>'Delete','urlCreator' => function ($action, $model, $key, $index) {
            // if ($action === ['delete','id'=>$model->id]) {
            // $url = Yii::$app->controller->actionDelete1($index);
            // return $url;
            return \yii\helpers\Url::toRoute(['delete1', 'id' => $model->id]);
            }
            // }
            // else {$url = Yii::$app->controller->actionDelete($model->id); return $url;}
            ],
    'categories',
    ],
]);

Pjax::end(); ?>
</div>
</center> 