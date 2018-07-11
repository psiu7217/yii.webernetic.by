<?php

/* @var $this yii\web\View */

$this->title = 'Бюджет | Пользователи';
use yii\widgets\Pjax;
?>

<div class="row">
    <div class="col-sm-12 text-right">
        <a href="<?php echo $url_logout?>">Выход</a>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <p>Добро пожаловать: <strong><?php echo $user_info->name ?></strong></p>
        <p>Если вы хотите изменить свои профиль то идите нафиг =))</p>
    </div>
</div>

<?php Pjax::begin(['enablePushState' => false]); ?>
    <a class="btn btn_red" href="/users/?id=1" data-pjax="1">Го вк</a>

    <pre>
        <?php print_r($ACCESS_TOKEN) ?>
    </pre>
    <pre>
        <?php print_r($user_info) ?>
    </pre>
<?php Pjax::end(); ?>
