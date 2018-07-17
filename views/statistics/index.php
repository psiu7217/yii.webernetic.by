<?php

/* @var $this yii\web\View */

$this->title = 'Бюджет | Статистика';
?>
<?php
use yii\widgets\Pjax;
use yii\helpers\Html;


/*
$this->params['breadcrumbs'][] = [
    'template' => "<li><b>{link}</b></li>\n", //  шаблон для этой ссылки
    'label' => 'Статистика', // название ссылки
    'url' => ['/statistics'] // сама ссылка
];
*/
//$this->params['breadcrumbs'][] = ['label' => 'Подкатегория', 'url' => ['/category/subcategory']];

?>

<div class="card">
    <div class="card_header">
        Статистика
    </div>
    <div class="card_body">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div id="graf_main" style="width: 100%; height: 400px;"></div>
                    </div>

                </div>

                <div class="row">
                    <?php if ($grafics) {
                        foreach ($grafics as $grafic) { ?>
                            <div class="col-sm-6">
                                <div id="graf_<?php echo $grafic['id']?>" style="width: 100%; height: 300px;"></div>
                            </div>
                        <?php }
                    } ?>
                </div>

            </div>
        </div>
    </div>
</div>




<script>
    $(document).ready(function () {

        //графики
        //Загрузка API
        google.charts.load('current', {'packages':['corechart']});
        //Указываем функцию для обработки
        google.charts.setOnLoadCallback(drawChart_main_plan);


        //Для главных категорий
        function drawChart_main_plan() {

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');
            data.addColumn('number', 'Slices');
            data.addRows([
                <?php foreach ($plans as $plan) { ?>
                ['<?php echo $plan["name"]?>', <?php echo $plan["sum"]?>],
                <?php } ?>
            ]);

            var options = {
                'title':'План распределение бюджета по главным категориям',
            };

            var chart = new google.visualization.PieChart(document.getElementById('graf_main'));
            chart.draw(data, options);
        }

        //Для подкатегорий
        <?php if ($grafics) {
            foreach ($grafics as $grafic) { ?>

                google.charts.setOnLoadCallback(drawChart_<?php echo $grafic['id']?>);

        function drawChart_<?php echo $grafic['id']?>() {

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');
            data.addColumn('number', 'Slices');
            data.addRows([
                <?php foreach ($grafic['field'] as $plan) { ?>
                ['<?php echo $plan["name"]?>', <?php echo $plan["sum"]?>],
                <?php } ?>
            ]);

            var options = {'title':'<?php echo $grafic['name']?> ( <?php echo $grafic['sum']?> BYN )'};

            var chart = new google.visualization.PieChart(document.getElementById('graf_<?php echo $grafic['id']?>'));
            chart.draw(data, options);
        }


        <?php }
        } ?>

    });
</script>