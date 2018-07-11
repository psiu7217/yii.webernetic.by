<?php

/* @var $this yii\web\View */

$this->title = 'Бюджет | Пользователи';
?>

<?php
use yii\widgets\Pjax;

?>

    <div class="row top_items">
        <div class="col-sm-9">
            <h1>Чеки</h1>
        </div>
        <div class="col-sm-3 text-right">
            <a href="<?php echo $url_add ?>" class="btn btn_green">
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>

<?php Pjax::begin(['enablePushState' => false]); ?>
    <div class="filter_checks">
        <div class="row">
            <div class="col-sm-12">
                <form action="/checks" method="post" data-pjax="1">
                    <p class="title">Диапозон</p>
                    <div class="form-group">
                        <label for="date_start">Дата начало</label>
                        <input type="date" class="form-control" name="date_start" id="date_start" placeholder="Дата начало" value="<?php echo $date_start ?>">
                    </div>

                    <div class="form-group">
                        <label for="date_end">Дата конец</label>
                        <input type="date" class="form-control" name="date_end" id="date_end" placeholder="Дата конец" value="<?php echo $date_end ?>">
                    </div>

                    <button type="submit" class="btn">Применить</button>
                </form>
                <form action="/checks" method="post" data-pjax="1">
                    <input type="hidden" name="all_check" value="1">
                    <button type="submit" class="btn">Показать все</button>
                </form>
            </div>
        </div>
    </div>

<?php if ($checks) { ?>
    <div class="row">
        <div class="col-sm-12">
            <table class="table">
                <caption><?php echo $date_start ?> : <?php echo $date_end ?></caption>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Имя</th>
                    <th>Категория</th>
                    <th>Сумма</th>
                    <th>Дата</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 0; ?>
                <?php Pjax::begin(); ?>
                <?php foreach ($checks as $check) {
                    $i++ ?>

                    <tr>
                        <th scope="row"><?php echo $check->id ?></th>
                        <td><?php echo $check->name ?></td>
                        <td><?php echo $check->id_category ?></td>
                        <td><?php echo $check->price ?></td>
                        <td><?php echo $check->data ?></td>
                        <td>
                            <a class="btn btn_red" href="/checks/remove?id=<?php echo $check->id ?>" data-pjax="1">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            <a class="btn btn_blue" href="<?php echo $url_edit . '?id=' . $check->id; ?>">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>

                <?php } ?>
                <?php Pjax::end(); ?>
                </tbody>
            </table>
        </div>
    </div>

<?php } else { ?>
    <div class="row">
        <div class="col-sm-12">
            <p>Упс... Чеков нету. Пожалуйста добавьте или изменить фильтр</p>
        </div>
    </div>
<?php } ?>

<?php Pjax::end(); ?>
