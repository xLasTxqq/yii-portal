<?php   

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ApplicationsModel */

$this->title = Yii::t('app', 'Изменение заявки: {name}', [
    'name' => $modelinfo->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Изменение статуса'), 'url' => ['changestatus']];
// $this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Изменить');
?>
<div class="applications-model-update">

    <h1><?= Html::encode($this->title) ?></h1>
    
</div>
<div class="applications-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- ?= $form->field($model, 'iduser')->textInput() ?>

    ?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    ?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    ?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>

    ?= $form->field($model, 'img')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'status')->radioList(['Отклонена'=>'Отклонена','Решена'=>'Решена']) ?>
    <?= $form->field($model, 'comment')->textArea(['maxlength'=>true]) ?>
    <?= $form->field($model, 'img2')->fileInput() ?>

    <!-- ?= $form->field($model, 'date')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
