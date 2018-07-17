<?php use yii\widgets\Pjax;?>
<?php

/* @var $this yii\web\View */

$this->title = 'Бюджет | Категория | Редактирование';
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
    echo '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Категория '.$success.' успешно обновлена</div>';
} ?>

<div class="card">
    <div class="card_header">
        <p class="title">Редактировать категорию #<?php echo $id?></p>
    </div>
    <div class="card_body">
        <form action="/categorys/edit?id=<?php echo $category_info->id?>" method="post" data-pjax="1">
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Название" value="<?php echo $category_info->name ?>">
            </div>

            <div class="form-group">
                <label for="plan">План</label>
                <input type="number" class="form-control" name="plan" id="plan" placeholder="План" value="<?php echo $category_info->plan ?>">
            </div>

            <div class="form-group">
                <label for="type">Тип</label>
                <select name="type" id="type" class="form-control">
                    <option value="0" <?php if ($category_info->type == 0) echo 'selected';?>>Доход</option>
                    <option value="1" <?php if ($category_info->type == 1) echo 'selected';?>>Расход</option>
                </select>
            </div>

            <div class="form-group">
                <label for="id_parent">Родительская категори</label>
                <select name="id_parent" id="id_parent" class="form-control">
                    <option value="0" <?php if ($category_info->id == 0) echo 'selected';?>>Нет</option>
                    <?php if ($categorys) { ?>
                        <?php foreach ($categorys as $category) { ?>
                            <?php if ($category_info->id != $category->id) {?>
                                <option value="<?php echo $category->id ?>" <?php if ($category_info->id_parent == $category->id) echo 'selected';?>><?php echo $category->name ?></option>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="sort">Сортировка</label>
                <input type="number" class="form-control" name="sort" id="sort" placeholder="Сортировка" value="<?php echo $category_info->sort ?>">
            </div>

            <button type="submit" class="btn btn_green xs_block">Обновить</button>
        </form>
    </div>
</div>




<?php Pjax::end(); ?>