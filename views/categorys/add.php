<?php use yii\widgets\Pjax;?>
<?php

/* @var $this yii\web\View */

$this->title = 'Бюджет | Пользователи';
?>



    <div class="row top_items">
        <div class="col-sm-9">
        </div>
        <div class="col-sm-3 text-right">
            <a href="<?php echo $url_cancel ?>" class="btn btn_dark">
                Все категории
            </a>
        </div>
    </div>



<?php Pjax::begin(['enablePushState' => false]); ?>

<?php
if ($error) {
    echo '<div class="alert alert-warning"><a class="close" data-dismiss="alert">×</a>'.$error.'</div>';
}
if ($success) {
    echo '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Категория '.$success.' успешно добавлена</div>';
} ?>
<div class="card">
    <div class="card_header">
        <p class="title">Добавить новую категорию</p>
    </div>
    <div class="card_body">
        <form action="/categorys/add" method="post" data-pjax="1">
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Название">
            </div>

            <div class="form-group">
                <label for="plan">План</label>
                <input type="number" class="form-control" name="plan" id="plan" placeholder="План">
            </div>

            <div class="form-group">
                <label for="type">Тип</label>
                <select name="type" id="type" class="form-control">
                    <option value="0">Доход</option>
                    <option value="1" selected>Расход</option>
                </select>
            </div>

            <div class="form-group">
                <label for="id_parent">Родительская категори</label>
                <select name="id_parent" id="id_parent" class="form-control">
                    <option value="0" selected>Нет</option>
                    <?php if ($categorys) { ?>
                        <?php foreach ($categorys as $category) { ?>
                            <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="sort">Сортировка</label>
                <input type="number" class="form-control" name="sort" id="sort" placeholder="Сортировка" value="99">
            </div>

            <button type="submit" class="btn btn_green xs_block">Добавить</button>
        </form>
    </div>
</div>



<?php Pjax::end(); ?>