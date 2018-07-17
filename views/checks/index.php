<?php

/* @var $this yii\web\View */

$this->title = 'Бюджет | Пользователи';
?>

<?php
use yii\widgets\Pjax;

?>

    <div class="row top_items">
        <div class="col-sm-9">

        </div>
        <div class="col-sm-3 text-right">
            <a href="<?php echo $url_add ?>" class="btn btn_green">
                <i class="fas fa-plus"></i> Добавить новый
            </a>
        </div>
    </div>

<?php Pjax::begin(['enablePushState' => false]); ?>
<div class="card hidden-xs">
    <div class="card_header">
        <p class="title">Диапозон</p>
    </div>
    <div class="card_body">
        <div class="filter_checks">
            <div class="row">
                <div class="col-sm-12">
                    <form action="/checks" method="post" data-pjax="1">
                        <div class="form-group">
                            <label for="date_start">Дата начало</label>
                            <input type="date" class="form-control" name="date_start" id="date_start" placeholder="Дата начало" value="<?php echo $date_start ?>">
                        </div>

                        <div class="form-group">
                            <label for="date_end">Дата конец</label>
                            <input type="date" class="form-control" name="date_end" id="date_end" placeholder="Дата конец" value="<?php echo $date_end ?>">
                        </div>

                        <button type="submit" class="btn btn_green">Применить</button>
                    </form>
                    <form action="/checks" method="post" data-pjax="1" class="form_show_all_check">
                        <input type="hidden" name="all_check" value="1">
                        <button type="submit" class="btn btn_green">Показать все</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php if ($checks) { ?>
    <div class="card overflow_auto">
        <div class="card_header">
            <p class="title">Чеки</p>
        </div>
        <div class="card_body">
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-responsive-sm table-bordered table-striped table-sm">
                        <caption>Период с <?php echo $date_start ?> по <?php echo $date_end ?></caption>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Имя</th>
                            <th class="hidden-xs">Категория</th>
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
                                <td>
                                    <a href="<?php echo $url_edit . '?id=' . $check->id; ?>" data-pjax="0">
                                        <?php echo $check->name ?>
                                    </a>
                                </td>
                                <td class="hidden-xs"><?php echo $check->id_category ?></td>
                                <td><?php echo $check->price ?></td>
                                <td><?php echo $check->data ?></td>
                                <td>
                                    <a class="btn btn_red" href="/checks/remove?id=<?php echo $check->id ?>" data-pjax="1">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>

                        <?php } ?>
                        <?php Pjax::end(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
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
