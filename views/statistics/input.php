<?php

/* @var $this yii\web\View */

$this->title = 'Бюджет | Статистика доходов';

use yii\widgets\Pjax;
use yii\helpers\Html;

?>

<!--
<div class="card">
    <div class="card_header">
        Общая Статистика доходов
    </div>
    <div class="card_body">
        <div class="row">
            <pre>
                <?php print_r($categorys) ?>
            </pre>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div id="graf_main" style="width: 100%; height: 400px;"></div>
            </div>
        </div>
    </div>
</div>
-->

<div class="card">
    <div class="card_header">
        Статистика доходов
    </div>
    <div class="card_body">
        <div class="row">
            <div class="col-sm-12">
                <div id="graf_main" style="width: 100%; height: 400px;"></div>
            </div>
        </div>
    </div>
</div>




<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ["Дата", <?php foreach ($categorys as $category) {
                    foreach ($category as $item) echo '"' . $item['name'] . '", ';
                    break;
                }?>],

            <?php
            foreach ($categorys as $key => $value) {
                echo '["' . $key . '", ';
                foreach ($value as $item) {
                    echo $item['sum'] . ', ';
                }
                echo '],
                ';
            }
            ?>
        ]);

        var options = {
            title: "<?php print_r($main_categorys[0]['name']) ?>",
            curveType: 'function',
            legend: {position: 'bottom'}
        };

        var chart = new google.visualization.LineChart(document.getElementById('graf_main'));

        chart.draw(data, options);
    }
</script>



