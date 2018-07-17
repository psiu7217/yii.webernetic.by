<?php use yii\widgets\Pjax; ?>
<?php

/* @var $this yii\web\View */

$this->title = 'Бюджет | Чеки';
?>


    <div class="row">
        <div class="top_items">
            <div class="col-sm-9">
            </div>
            <div class="col-sm-3 text-right">
                <a href="<?php echo $url_cancel ?>" class="btn btn_dark">
                    Все чеки
                </a>
            </div>
        </div>
    </div>


<?php Pjax::begin(['enablePushState' => false]); ?>

<?php
if ($error) {
    echo '<div class="alert alert-warning"><a class="close" data-dismiss="alert">×</a>' . $error . '</div>';
}
if ($success) {
    echo '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Чек ' . $success . ' успешно добавлена</div>';
} ?>

    <div class="card">
        <div class="card_header">
            <p class="title">Добавить новый чек</p>
        </div>
        <div class="card_body">
            <form action="/checks/add" method="post" data-pjax="1" class="form_add_check">

                <div class="form-group">
                    <label for="id_category">Категория</label>
                    <select name="id_category" id="id_category" class="form-control">
                        <?php if ($categorys) { ?>
                            <?php foreach ($categorys as $category) { ?>
                                <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Сумма</label>
                    <input type="number" step="0.01" class="form-control" name="price" id="price" placeholder="Сумма">
                </div>

                <div class="form-group">
                    <label for="name">Название</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Название">
                </div>

                <div class="form-group">
                    <label for="data">Дата</label>
                    <input type="date" class="form-control" name="data" id="data" placeholder="Дата" value="<?php echo date("Y-m-j") ?>">
                </div>


                <input type="hidden" name="id_user" value="<?php echo $user_id?>">
                <button type="submit" class="btn btn_green">Добавить</button>
            </form>
        </div>
    </div>


<?php Pjax::end(); ?>