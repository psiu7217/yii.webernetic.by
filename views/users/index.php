<?php

/* @var $this yii\web\View */

$this->title = 'Бюджет | Пользователи';

use yii\widgets\Pjax;

?>

<div class="top_block">
    <div class="row">
        <div class="col-sm-12 text-right">
            <a href="<?php echo $url_logout ?>" class="btn btn_dark">Выход</a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card_header">
        <p class="title">Добро пожаловать: <strong><?php echo $user_info->name ?></strong></p>
    </div>
    <div class="card_body">
        <p>Если вы хотите изменить свои профиль то идите нафиг =))</p>
    </div>
</div>

<div class="card">
    <div class="card_header">
        <p class="title">Информация о пользователе</p>
    </div>
    <div class="card_body">
        <?php Pjax::begin(['enablePushState' => false]); ?>

            <a class="btn btn_red" href="/users/?id=1" data-pjax="1">Го вк</a>

            <pre>
                <?php print_r($ACCESS_TOKEN) ?>
            </pre>

            <pre>
                <?php print_r($user_info) ?>
            </pre>

        <?php Pjax::end(); ?>

    </div>
</div>