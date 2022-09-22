<h1 style="text-align: center;">Регистрация</h1>
<?php 
$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
Pjax::begin();
$form=ActiveForm::begin(['options'=>['data' => ['pjax' => true]],'class'=>'form-horizontal']);
?>
<?= $form->field($model,'fullname')->textInput(['autofocus'=>true]) ?>
<?= $form->field($model,'login')->textInput() ?>
<?= $form->field($model,'email')->textInput() ?>
<?= $form->field($model,'password')->passwordInput() ?>
<?= $form->field($model,'passwordRepeat')->passwordInput() ?>

<a style="display: flex; align-items: stretch;"><input type="checkbox" required style="margin-right: 0.5vw; cursor: pointer;"><label style="cursor: pointer;">Согласие на обработку персональных данных</label></a>
<div>
	<button type="submit">Отправить</button>
</div>
<?php
ActiveForm::end();
Pjax::end();
?>