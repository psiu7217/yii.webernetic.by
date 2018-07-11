<?php

/* @var $this yii\web\View */

$this->title = 'Бюджет | Регистрация';
use yii\widgets\Pjax;
?>


<?php Pjax::begin(); ?>
<?php
if ($error) {
    echo '<div class="alert alert-warning"><a class="close" data-dismiss="alert">×</a>'.$error.'</div>';
}
if ($success) {
    echo '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Пользователь '.$success.' зарегестрирован</div>';
} ?>

<div class="row">
    <div class="col-sm-12">
        <div class="title_h1">Регистрация нового пользователя</div>

        <form action="/users/registration" method="post" data-pjax="1">

            <div class="form-group">
                <label for="login">Логин</label>
                <input type="text" class="form-control" name="login" id="login" placeholder="Логин" value="<?php echo $login?>" required>
            </div>

            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Пароль" required>
            </div>

            <div class="form-group">
                <label for="password">Пароль еще раз</label>
                <input type="password" class="form-control" name="password_2" id="password_2" placeholder="Пароль еще раз" required>
            </div>

            <div class="form-group">
                <label for="name">Ваше имя</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Ваше имя" value="<?php echo $name?>">
            </div>

            <button type="submit" class="btn btn-default">Регистрация</button>
        </form>

    </div>
</div>


<?php Pjax::end(); ?>
<br>
<p><a href="<?php echo $url_login ?>">Уже зарегестрированы? Жми</a></p>
