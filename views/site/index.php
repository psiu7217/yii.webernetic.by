<?php
use yii\widgets\Pjax;

?>
<?php

/* @var $this yii\web\View */

$this->title = 'Бюджет';
?>


    <div class="top_block">
        <div class="row">
            <div class="col-sm-4">
                <button class="btn btn_filter">Фильтр</button>
            </div>
            <div class="col-sm-4">

            </div>
            <div class="col-sm-4 text-right">
                <a href="<?php echo $url_add_check ?>" class="btn btn_green">Добавить чек</a>
            </div>
        </div>
    </div>

<?php Pjax::begin(['enablePushState' => false]); ?>
    <div class="filter_block">
        <div class="row">
            <div class="col-sm-12">
                <form action="/site/index" method="post" data-pjax="1">
                    <p class="title">Интервал</p>
                    <div class="form-group">
                        <label for="date_start">Дата начало</label>
                        <input type="date" class="form-control" name="date_start" id="date_start" placeholder="Дата начало"
                               value="<?php echo $date_start ?>">
                    </div>

                    <div class="form-group">
                        <label for="date_end">Дата конец</label>
                        <input type="date" class="form-control" name="date_end" id="date_end" placeholder="Дата конец"
                               value="<?php echo $date_end ?>">
                    </div>

                    <button type="submit" class="btn">Применить</button>
                </form>
            </div>
        </div>
    </div>

    <div class="categorys_table input">
        <div class="row item_title">
            <div class="col-sm-4 col-xs-3">
                Название
            </div>
            <div class="col-xs-3">
                План
            </div>
            <div class="col-xs-3">
                Факт
            </div>
            <div class="col-sm-2 col-xs-3">
                Отклонение
            </div>
        </div>

        <?php foreach ($categorys_input as $category) { ?>
            <div class="row item">
                <div class="col-sm-4 col-xs-3">
                    <?php echo $category['name'] ?>
                </div>
                <div class="col-xs-3">
                    <?php echo $category['plan'] ?>
                </div>
                <div class="col-xs-3">
                    <?php echo $category['fact'] ?>
                </div>
                <div class="col-sm-2 col-xs-3">
                    <?php echo $category['deviation'] ?>
                </div>
            </div>
            <?php if ($category['childs']) {
                foreach ($category['childs'] as $child) { ?>
                    <div class="row item child">
                        <div class="col-sm-1"></div>
                        <div class="col-xs-3">
                            <a href="<?php echo $child['url'] ?>" data-pjax="0"><?php echo $child['name'] ?></a>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $child['plan'] ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $child['fact'] ?>
                        </div>
                        <div class="col-sm-2 col-xs-3 <?php echo $child['class'] ?>">
                            <?php echo $child['deviation'] ?>
                        </div>
                    </div>
                <?php }
            } ?>
        <?php } ?>
    </div>

    <hr>

<?php if ($categorys_output) { ?>
    <div class="categorys_table output">
        <div class="row item_title">
            <div class="col-sm-4 col-xs-3">
                Название
            </div>
            <div class="col-sm-3 col-xs-3">
                План
            </div>
            <div class="col-sm-3 col-xs-3">
                Факт
            </div>
            <div class="col-sm-2 col-xs-3">
                Отклонение
            </div>
        </div>

        <?php foreach ($categorys_output as $category) { ?>
            <div class="row item">
                <div class="col-sm-4 col-xs-3">
                    <?php echo $category['name'] ?>
                </div>
                <div class="col-sm-3 col-xs-3">
                    <?php echo $category['plan'] ?>
                </div>
                <div class="col-sm-3 col-xs-3">
                    <?php echo $category['fact'] ?>
                </div>
                <div class="col-sm-2 col-xs-3">
                    <?php echo $category['deviation'] ?>
                </div>
            </div>
            <?php if ($category['childs']) {
                foreach ($category['childs'] as $child) { ?>
                    <div class="row item child">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3 col-xs-3">
                            <a href="<?php echo $child['url'] ?>" data-pjax="0"><?php echo $child['name'] ?></a>
                        </div>
                        <div class="col-sm-3 col-xs-3">
                            <?php echo $child['plan'] ?>
                        </div>
                        <div class="col-sm-3 col-xs-3">
                            <?php echo $child['fact'] ?>
                        </div>
                        <div class="col-sm-2 col-xs-3 <?php echo $child['class'] ?>">
                            <?php echo $child['deviation'] ?>
                        </div>
                    </div>
                <?php }
            } ?>
        <?php } ?>
    </div>
<?php } ?>

    <div class="categorys_table results">
        <div class="row item">
            <div class="col-sm-4 col-xs-3">
                Итого расходов
            </div>
            <div class="col-sm-3 col-xs-3">
                <?php echo $result_plan_output ?>
            </div>
            <div class="col-sm-3 col-xs-3">
                <?php echo $result_fact_output ?>
            </div>
            <div class="col-sm-2 col-xs-3">
                <?php echo $result_deviation_output ?>
            </div>
        </div>
        <div class="row item result">
            <div class="col-sm-10 col-xs-9">
                Экономия семейного бюджета
            </div>
            <div class="col-sm-2 col-xs-3">
                <?php echo $result_fact ?>
            </div>
        </div>
    </div>


<?php Pjax::end(); ?>