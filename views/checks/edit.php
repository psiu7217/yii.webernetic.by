<?php use yii\widgets\Pjax;?>
<?php

/* @var $this yii\web\View */

$this->title = 'Бюджет | Пользователи';
?>



    <div class="row top_items">
        <div class="col-sm-9">
            <h1>Редактировать Чек <?php echo $id?></h1>
        </div>
        <div class="col-sm-3 text-right">
            <a href="<?php echo $url_cancel ?>" class="btn btn_grey">
                <i class="fas fa-undo-alt"></i>
            </a>
        </div>
    </div>


<?php Pjax::begin(['enablePushState' => false]); ?>

<?php
if ($error) {
    echo '<div class="alert alert-warning"><a class="close" data-dismiss="alert">×</a>'.$error.'</div>';
}
if ($success) {
    echo '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Чек '.$success.' успешно обновлена</div>';
} ?>

    <form action="/checks/edit?id=<?php echo $chek_info->id?>" method="post" data-pjax="1">

        <div class="form-group">
            <label for="id_category">Категория</label>
            <select name="id_category" id="id_category" class="form-control">
                <?php if ($categorys) { ?>
                    <?php foreach ($categorys as $category) { ?>
                        <option value="<?php echo $category->id ?>" <?php if ($category->id == $chek_info->id_category) echo ' selected'?>><?php echo $category->name ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label for="price">Сумма</label>
            <input type="number" step="0.01" class="form-control" name="price" id="price" placeholder="Сумма" value="<?php echo $chek_info->price?>">
        </div>

        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Название" value="<?php echo $chek_info->name?>">
        </div>

        <div class="form-group">
            <label for="data">Дата</label>
            <input type="date" class="form-control" name="data" id="data" placeholder="Дата" value="<?php echo $chek_info->data?>">
        </div>


        <input type="hidden" name="id_user" value="1">
        <button type="submit" class="btn btn-default">Обновить</button>
    </form>


<?php Pjax::end(); ?>