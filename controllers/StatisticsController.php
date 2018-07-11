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


class StatisticsController extends MainController
{
    public function actionIndex()
    {

        if (!Users::$id) return $this->redirect(['users/login']);
        $data = array();


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
                        'name'  => $child->name,
                        'sum'   => $child->plan,
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


}