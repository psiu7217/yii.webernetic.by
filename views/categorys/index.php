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
        </div>
        <div class="col-sm-3 text-right">
            <a href="<?php echo $url_add ?>" class="btn btn_green">
                <i class="fas fa-plus"></i> Добавить новую
            </a>
        </div>
    </div>

<?php if ($categorys) { ?>
<div class="card overflow_auto">
    <div class="card_header">
        <p class="title">Категории</p>
    </div>
    <div class="card_body">
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-responsive-sm table-bordered table-striped table-sm">
                    <caption>Ла ла, тапаля</caption>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Название</th>
                        <th>План</th>
                        <th class="hidden-xs">Тип</th>
                        <th class="hidden-xs">Родитель</th>
                        <th class="hidden-xs">Сортировка</th>
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
                            <td>
                                <a href="<?php echo $url_edit . '?id=' . $category->id; ?>"><?php echo $category->name ?></a>
                            </td>
                            <td><?php echo $category->plan ?></td>
                            <td class="hidden-xs"><?php echo $category->type ?></td>
                            <td class="hidden-xs"><?php echo $category->id_parent ?></td>
                            <td class="hidden-xs"><?php echo $category->sort ?></td>
                            <td>
                                <a class="btn btn_red" href="/categorys/remove?id=<?php echo $category->id ?>" data-pjax="1"><i class="fas fa-trash-alt"></i></a>
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
            <p>Упс... Пока категорий нету. Пожалуйста добавьте</p>
        </div>
    </div>
<?php } ?>