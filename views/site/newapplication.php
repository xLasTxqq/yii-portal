<?php 

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\models\Categories;
use app\models\Applications;
use yii\helpers\ArrayHelper;


$this->title = 'Создать заявку';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- ?php foreach (Categories::find()->select(['categories'])->column() as $cat): ?> <?= Html::encode($cat) ?> ?php endforeach; ?> -->
<!-- <div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>

    <code><?= __FILE__ ?></code>
</div> -->
<?php
use yii\widgets\ActiveForm;
$form=ActiveForm::begin(['class'=>'form-horizontal']);
?>
<?= $form->field($model,'name')->textInput(['autofocus'=>true]) ?>
<?= $form->field($model,'description')->textInput() ?>

<!-- ?= $form->field($model,'category')->radioList(['Строительство'=>'Строительство', 'Ремонт'=>'Ремонт', 'Помощь'=>'Помощь']) ?> -->

<!-- ?= $form->field($model, 'category')->radioList(Categories::find()->select(['categories'])->column())?> -->
<?= $form->field($model, 'category')->radioList(ArrayHelper::map(Categories::find()->all(),'categories','categories') )?>


<?= $form->field($model,'img')->fileInput() ?>

<!-- <a style="display: flex; align-items: stretch;"><input type="checkbox" required style="margin-right: 0.5vw; cursor: pointer;"><label style="cursor: pointer;">Согласие на обработку персональных данных</label></a> -->
<div>
    <button type="submit">Отправить</button>
</div>
<?php
ActiveForm::end();
?>