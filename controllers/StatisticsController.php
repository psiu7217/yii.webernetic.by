<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11.12.2017
 * Time: 16:18
 */

namespace app\controllers;

use yii\web\Controller;
use yii\helpers\Url;
use app\models\Categorys;
use app\models\Users;
use app\models\Checks;


class StatisticsController extends MainController
{
    public function actionIndex()
    {


        if (!Users::$id) return $this->redirect(['users/login']);
        $data = array();

        $data['url_input'] = Url::to(['statistics/input']);
        $data['url_output'] = Url::to(['statistics/output']);

        //План распределение бюджета
        $categorys = Categorys::get_category_parent_id();

        $sum_input = 0;
        $sum_output = 0;
        $plans = array();

        $grafics = array();

        foreach ($categorys as $category) {

            $childs = Categorys::get_category_parent_id($category->id);

            $sum = 0;

            if ($category->type == 1) {
                $grafics[$category->id]['id'] = $category->id;
                $grafics[$category->id]['name'] = $category->name;
            }


            foreach ($childs as $child) {
                if ($child->type == 0) {
                    $sum_input += $child->plan;
                } else {
                    $sum_output += $child->plan;

                    $grafics[$category->id]['field'][] = array(
                        'name' => $child->name,
                        'sum' => $child->plan,
                    );

                }

                $sum += $child->plan;


            }

            if ($category->type == 1) {
                $plans[] = array(
                    'name' => $category->name,
                    'sum' => $sum,
                );
                $grafics[$category->id]['sum'] = $sum;
            }
        }
        if (($sum_input - $sum_output) > 0) {
            $plans[] = array(
                'name' => 'Остаток от дохода',
                'sum' => $sum_input - $sum_output,
            );
        } else {
            $plans[] = array(
                'name' => 'Не хватка от дохода',
                'sum' => $sum_output - $sum_input,
            );
        }


        $data['plans'] = $plans;
        $data['grafics'] = $grafics;
        return $this->render('index', $data);
    }

    //Страница доходов
    public function actionInput()
    {
        $data = array();

        //Получаем основные категории доходов
        $data['main_categorys'] = Categorys::get_category_input_main();

        //Дата начала ставим первыми чеков (в этом случае это апрель 2018)
        $date_start = date('2018-04-14');
        $date_end = date('Y-m-14');


        //Перебираем дату от последнего до текущего чека
        while ($date_start <= $date_end) {

            //Перебираем галавные категории (в нашем случае это одна только)
            foreach ($data['main_categorys'] as $category_main) {

                // Получаем дочернии категории ( получим (доход мужа + доход жены + итд))
                $category_childs = Categorys::get_category_parent_id($category_main['id']);


                //Перебираем все дочерние категории
                foreach ($category_childs as $category) {

                    //Получем сумму для каждой категории используя срез даты
                    $sum = Checks::get_sum_price_checks_category_id_date_range($category['id'], $date_start, date('Y-m-14', strtotime($date_start . "+1 month")));

                    //Если в том месяце чеков небыло то 0
                    if (!$sum) {
                        $sum = 0;
                    }

                    //Собственно заполняем массив
                    $data['categorys'][$date_start][] = array(
                        'id' => $category->id,
                        'name' => $category['name'],
                        'sum' => $sum,
                        'date' => $date_start,
                    );

                }

            }

            //Увеличиваем дату на + 1 месяц
            $date_start = date('Y-m-14', strtotime($date_start . "+1 month"));

        }


        return $this->render('input', $data);
    }


    //Страница доходов
    public function actionOutput()
    {
        $data = array();

        //Получаем основные категории доходов
        $data['main_categorys'] = Categorys::get_category_input_main();

        //Дата начала ставим первыми чеков (в этом случае это апрель 2018)
        $date_start = date('2018-04-14');
        $date_end = date('Y-m-14');


        //Перебираем дату от последнего до текущего чека
        while ($date_start <= $date_end) {

            //Перебираем галавные категории (в нашем случае это одна только)
            foreach ($data['main_categorys'] as $category_main) {

                // Получаем дочернии категории ( получим (доход мужа + доход жены + итд))
                $category_childs = Categorys::get_category_parent_id($category_main['id']);


                //Перебираем все дочерние категории
                foreach ($category_childs as $category) {

                    //Получем сумму для каждой категории используя срез даты
                    $sum = Checks::get_sum_price_checks_category_id_date_range($category['id'], $date_start, date('Y-m-14', strtotime($date_start . "+1 month")));

                    //Если в том месяце чеков небыло то 0
                    if (!$sum) {
                        $sum = 0;
                    }

                    //Собственно заполняем массив
                    $data['categorys'][$date_start][] = array(
                        'id' => $category->id,
                        'name' => $category['name'],
                        'sum' => $sum,
                        'date' => $date_start,
                    );

                }

            }

            //Увеличиваем дату на + 1 месяц
            $date_start = date('Y-m-14', strtotime($date_start . "+1 month"));

        }


        return $this->render('output', $data);
    }


}