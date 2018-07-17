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
                <button class="btn btn_filter btn_dark hidden-xs">Фильтр</button>
            </div>
            <div class="col-sm-4">

            </div>
            <div class="col-sm-4 text-right">
                <a href="<?php echo $url_add_check ?>" class="btn btn_green add_check">Добавить чек</a>
            </div>
        </div>
    </div>

<?php Pjax::begin(['enablePushState' => false]); ?>
    <div class="filter_block">
        <div class="card">
            <div class="card_header">
                <p class="title">Интервал</p>
            </div>
            <div class="card_body">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="/site/index" method="post" data-pjax="1">
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
        </div>
    </div>


    <!--        Последние добавленные чеки          -->

    <div class="last_check">
        <div class="card">
            <div class="card_header">
                <p class="title">Последние добавленные чеки</p>
            </div>

            <div class="card_body">
                <div class="row items">
                    <?php foreach ($last_checks as $check) { ?>

                        <div class="item col-sm-4">
                            <div class="card">
                                <p class="name"><?php echo $check['name'] ?></p>
                                <p class="price"><?php echo $check['price'] ?></p>
                                <p class="data"><?php echo $check['data'] ?></p>
                            </div>
                        </div>

                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!--  ####  Последние добавленные чеки    ####  -->


    <!--        Таблица доходов          -->

    <div class="card margin_bottom overflow_auto">
        <div class="card_header">
            <p class="title">Таблица доходов</p>
        </div>
        <div class="card_body">

            <table class="table table-responsive-sm table-bordered table-striped table-sm">
                <thead>
                <tr>
                    <th>Название</th>
                    <th>План</th>
                    <th>Факт</th>
                    <th>Отклонение</th>
                </tr>
                </thead>
                <tbody>


                <?php foreach ($categorys_input as $category) { ?>

                    <?php if ($category['childs']) {
                        foreach ($category['childs'] as $child) { ?>
                            <tr>
                                <td><a href="<?php echo $child['url'] ?>" data-pjax="0"><?php echo $child['name'] ?></a></td>
                                <td><?php echo $child['plan'] ?></td>
                                <td><?php echo $child['fact'] ?></td>
                                <td><?php echo $child['deviation'] ?></td>
                            </tr>
                        <?php }
                    } ?>

                    <tr class="total">
                        <td><?php echo $category['name'] ?></td>
                        <td><?php echo $category['plan'] ?></td>
                        <td><?php echo $category['fact'] ?></td>
                        <td><?php echo $category['deviation'] ?></td>
                    </tr>

                <?php } ?>

                </tbody>
            </table>

        </div>
    </div>

    <!-- ####   Таблица доходов    ####  -->


    <!--        Таблица Расходов          -->

    <div class="card margin_bottom overflow_auto">
        <div class="card_header">
            <p class="title">Таблица расходов</p>
        </div>
        <div class="card_body">

            <table class="table table-responsive-sm table-bordered table-striped table-sm">
                <thead>
                <tr>
                    <th>Название</th>
                    <th>План</th>
                    <th>Факт</th>
                    <th>Отклонение</th>
                </tr>
                </thead>
                <tbody>


                <?php foreach ($categorys_output as $category) { ?>

                    <?php if ($category['childs']) {
                        foreach ($category['childs'] as $child) { ?>
                            <tr class="<?php echo $child['class'] ?>">
                                <td><a href="<?php echo $child['url'] ?>" data-pjax="0"><?php echo $child['name'] ?></a></td>
                                <td><?php echo $child['plan'] ?></td>
                                <td><?php echo $child['fact'] ?></td>
                                <td><?php echo $child['deviation'] ?></td>
                            </tr>
                        <?php }
                    } ?>

                    <tr class="total">
                        <td><?php echo $category['name'] ?></td>
                        <td><?php echo $category['plan'] ?></td>
                        <td><?php echo $category['fact'] ?></td>
                        <td><?php echo $category['deviation'] ?></td>
                    </tr>

                <?php } ?>

                </tbody>
            </table>

        </div>
    </div>

    <!-- ####   Таблица Расходов    ####  -->


    <!--        Таблица Экономия семейного бюджета          -->

    <div class="card margin_bottom overflow_auto">
        <div class="card_header">
            <p class="title">Экономия семейного бюджета</p>
        </div>
        <div class="card_body">

            <table class="table table-responsive-sm table-bordered table-striped table-sm">
                <thead>
                <tr>
                    <th>Название</th>
                    <th>План</th>
                    <th>Факт</th>
                    <th>Отклонение</th>
                </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>Итого расходов</td>
                        <td><?php echo $result_plan_output ?></td>
                        <td><?php echo $result_fact_output ?></td>
                        <td><?php echo $result_deviation_output ?></td>
                    </tr>
                    <tr>
                        <td colspan="3">Экономия семейного бюджета</td>
                        <td><strong><?php echo $result_fact ?></strong></td>
                    </tr>

                </tbody>
            </table>

        </div>
    </div>

    <!-- ####   Таблица Экономия семейного бюджета    ####  -->


    <div class="categorys_table input hidden">
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

<?php if ($categorys_output) { ?>
    <div class="categorys_table output hidden">
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

    <div class="categorys_table results hidden">
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
                <strong><?php echo $result_fact ?></strong>
            </div>
        </div>
    </div>


<?php Pjax::end(); ?>