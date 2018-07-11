<?php

/* @var $this yii\web\View */

$this->title = 'Бюджет | Авторизация';
use yii\widgets\Pjax;
?>


<?php Pjax::begin(); ?>
<?php
if ($error) {
    echo '<div class="alert alert-warning"><a class="close" data-dismiss="alert">×</a>'.$error.'</div>';
}
if ($success) {
    echo '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Пользователь '.$success.' авторизирован</div>';
} ?>

<div class="row">
    <div class="col-sm-12">


        <form action="/users/login" method="post" data-pjax="1">

            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" class="form-control" name="login" id="login" placeholder="Login">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>

            <button type="submit" class="btn btn-default">Вход</button>
        </form>

    </div>
</div>


<?php Pjax::end(); ?>
<br>
<p><a href="<?php echo $url_registration ?>">Регистрация нового пользователя</a></p>
