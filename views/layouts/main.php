<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>


<header>
    <div class="container-fluid">
        <div class="left_block">
            <a href="<?php echo Yii::$app->homeUrl ?>" class="logo">Бюджет</a>
            <button id="hide_sidebar"><i class="fas fa-bars"></i></button>
        </div>
    </div>
</header>


<div class="wrap">

    <div class="sidebar">
        <?php
        echo Nav::widget([
            'items' => [
                //['label' => 'Главная', 'url' => Yii::$app->homeUrl, 'active'=>\Yii::$app->controller->id ==  '/'],
                ['label' => 'Пользователи', 'url' => ['/users'], 'active' => \Yii::$app->controller->id == 'users'],
                ['label' => 'Категории', 'url' => ['/categorys'], 'active' => \Yii::$app->controller->id == 'categorys'],
                ['label' => 'Чеки', 'url' => ['/checks'], 'active' => \Yii::$app->controller->id == 'checks'],
                ['label' => 'Статистика', 'url' => ['/statistics'], 'active' => \Yii::$app->controller->id == 'statistics'],
            ],
        ]);
        ?>
    </div>

    <div class="container-fluid">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>

        <footer class="footer">
            <div class="col-sm-12">
                <p class="pull-left">&copy; Psiu <?= date('Y') ?></p>
                <p class="pull-right">Работает на чистой магии</p>
            </div>
        </footer>
    </div>
</div>


<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
