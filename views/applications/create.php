<?php 

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ApplicationsModel */

$this->title = Yii::t('app', 'Create Applications Model');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Applications Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="applications-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
