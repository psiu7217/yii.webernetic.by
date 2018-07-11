<?php

/* @var $this yii\web\View */

$this->title = 'Бюджет | Пользователи';
?>
<?php
use yii\widgets\Pjax;
use yii\helpers\Html;

?>

    <div class="row top_items">
        <div class="col-sm-9">
            <h1>Категории</h1>
        </div>
        <div class="col-sm-3 text-right">
            <a href="<?php echo $url_add ?>" class="btn btn_green">
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>

<?php if ($categorys) { ?>

    <div class="row">
        <div class="col-sm-12">
            <table class="table">
                <caption>Ла ла, тапаля</caption>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Название</th>
                    <th>План</th>
                    <th>Тип</th>
                    <th>Родитель</th>
                    <th>Сортировка</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 0; ?>
                <?php Pjax::begin(); ?>
                <?php foreach ($categorys as $category) {
                    $i++ ?>

                    <tr>
                        <th scope="row"><?php echo $category->id ?></th>
                        <td><?php echo $category->name ?></td>
                        <td><?php echo $category->plan ?></td>
                        <td><?php echo $category->type ?></td>
                        <td><?php echo $category->id_parent ?></td>
                        <td><?php echo $category->sort ?></td>
                        <td>
                            <a class="btn btn_red" href="/categorys/remove?id=<?php echo $category->id ?>" data-pjax="1"><i class="fas fa-trash-alt"></i></a>
                            <a class="btn btn_blue" href="<?php echo $url_edit . '?id=' . $category->id; ?>"><i class="fas fa-edit"></i></a>
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
            <p>Упс... Пока категорий нету. Пожалуйста добавьте</p>
        </div>
    </div>
<?php } ?>