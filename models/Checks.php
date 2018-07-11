<?php

namespace app\models;

use yii\db\ActiveRecord;

class Checks extends ActiveRecord
{

    //Получить все чеки
    static public function get_all_checks()
    {
        return Checks::find()->orderBy('data')->all();
    }

    //Получить один чек по id
    static public function get_check_id($id = false)
    {
        if ($id) {
            return Checks::findOne(['id' => $id, 'id_user' => Users::$id]);
        } else {
            return false;
        }
    }


    //Получить все чеки для категории
    static public function get_checks_category_id($id_category = 0)
    {
        return Checks::find()->where(['id_category' => $id_category, 'id_user' => Users::$id])->orderBy('data')->all();
    }


    //Получить все чеки подходящие под отрезок времени (даты)
    static public function get_checks_date_range($date_start = false, $date_end = false)
    {
        if ($date_start && $date_end) {
            return Checks::find()->where(['between', 'data', $date_start, $date_end])->andWhere(['id_user' => Users::$id])->orderBy('data desc')->all();
        }

        return false;
    }


    //Получить все чеки подходящие под отрезок времени (даты) для категории
    static public function get_checks_category_id_date_range($id_category = false, $date_start = false, $date_end = false)
    {
        if ($id_category && $date_start && $date_end) {
            return Checks::find()->where(['id_category' => $id_category, 'id_user' => Users::$id])->andWhere(['between', 'data', $date_start, $date_end])->orderBy('data')->all();
        }

        return false;
    }


    //Получить сумму чеков подходящие под отрезок времени (даты) для категории
    static public function get_sum_price_checks_category_id_date_range($id_category = false, $date_start = false, $date_end = false)
    {
        if ($id_category && $date_start && $date_end) {
            return Checks::find()->where(['id_category' => $id_category, 'id_user' => Users::$id])->andWhere(['between', 'data', $date_start, $date_end])->sum('price');
        }

        return false;
    }

    //Добавить новый чек
    static public function add_check($data = array())
    {
        if ($data['id_category'] && $data['data'] && $data['price'] && Users::$id) {
            $check = new Checks();

            $check->id_category = $data['id_category'];
            $check->data = $data['data'];
            $check->price = $data['price'];
            $check->id_user = Users::$id;
            if ($data['name']) {
                $check->name = $data['name'];
            }

            $check->save();

        }
    }


    static public function update_check($data)
    {
        if ($data['id'] && $data['id_category'] && $data['data'] && $data['price']) {
            $check = Checks::findOne($data['id']);

            $check->id_category = $data['id_category'];
            $check->data = $data['data'];
            $check->price = $data['price'];
            if ($data['name']) {
                $check->name = $data['name'];
            }

            $check->update();

            return $check;

        }

        return false;
    }


    static public function remove_check($id = false)
    {
        if ($id) {
            $check = Checks::findOne($id);
            if ($check) {
                $check->delete();
                return true;
            }
        }

        return false;

    }


}