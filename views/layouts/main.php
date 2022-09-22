<!-- <link rel="icon" type="image/png" href="logo2.png"> -->

<?php 

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="shortcut icon" href="../logo/logo2.png" type="image/png" >
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <!-- <img src="../logo/logo1.png"> -->
    <?php
    NavBar::begin([
        // 'brandLabel' => Yii::$app->name,
        'brandLabel' => '<img src="../logo/logo2.png" style="display:inline; vertical-align: top; height:32px; class="pull-left"/>Городской портал',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'Создать заявку', 'url' => ['/site/newapplication'], 'visible' => !Yii::$app->user->isGuest],
            // ['label' => 'Contact', 'url' => ['/site/contact']],
//            ['label' => 'Изменение статуса', 'url' => ['/site/changestatus'], 'visible'=> Yii::$app->user->identity->role===2],
//            ['label' => 'Изменение категорий', 'url' => ['/site/updatecategories'], 'visible'=> Yii::$app->user->identity->role===2],
            
            Yii::$app->user->isGuest ? (
            ['label' => 'Регистрация', 'url' => ['/site/register'],'visible' => Yii::$app->user->isGuest]
            ) : (
            // ['label' => 'Личный кабинет'. Yii::$app->user->identity->login, 'url' => ['/site/profile']]
            ['label' => 'Личный кабинет', 'url' => ['/site/profile']]
            ),

            Yii::$app->user->isGuest ? (
                ['label' => 'Логин', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->login . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            ),
            
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; City Portal <?= date('Y') ?></p>

        <!-- <p class="pull-right"><?= Yii::powered() ?></p> -->
    </div>
</footer>

<?php if (class_exists('yii\debug\Module')) {$this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);} 
$this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
