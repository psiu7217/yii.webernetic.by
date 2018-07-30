<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Users;
use app\controllers\MainController;



class Categorys extends ActiveRecord
{

    static public function get_categorys()
    {
        return Categorys::find()->where(['active' => 1, 'id_user' => Users::$id])->orderBy('sort')->all();
    }


    static public function get_all_categorys()
    {
        return Categorys::find()->orderBy('sort')->all();
    }


    static public function get_category_id($id = false)
    {
        if ($id) {
            return Categorys::findOne(['id' => $id]);
        }else {
            return false;
        }
    }

    static public function get_category_input_main() {
        return Categorys::find()->where(['type' => 0, 'active' => 1, 'id_parent' => 0, 'id_user' => Users::$id])->orderBy('sort')->all();
    }

    static public function get_category_parent_id($id_parent = 0) {
        return Categorys::find()->where(['id_parent' => $id_parent, 'active' => 1, 'id_user' => Users::$id])->orderBy('sort')->all();
    }


    static public function get_category_not_parent_id($id_parent = 0) {
        return Categorys::find()->where(['not', ['id_parent' => $id_parent]])->andWhere(['active' => 1, 'id_user' => Users::$id])->orderBy('sort')->all();
    }


    //Добавить новую категорию
    static public function add($data = false)
    {
        if ($data && Users::$id) {
            $category = new Categorys();

            $category->name = $data['name'];
            $category->plan = $data['plan'];
            $category->type = $data['type'];
            $category->id_parent = $data['id_parent'];
            $category->id_user = Users::$id;
            $category->sort = $data['sort'];
            $category->active = 1;

            $category->save();

            return $category;
        }
        return false;
    }


    static public function edit($data = false)
    {
        if ($data) {
            $category = Categorys::findOne($data['id']);

            $category->name = $data['name'];
            $category->plan = $data['plan'];
            $category->type = $data['type'];
            $category->id_parent = $data['id_parent'];
            $category->sort = $data['sort'];

            $category->update();

            return $category;
        }
        return false;
    }


    //Удаление категории (убираем активность)
    static public function remove($id = false)
    {
        if ($id){
            $category = Categorys::findOne($id);
            if ($category) {
                $category->active = 0;
                $category->update();
                return $id;
            }
        }
        return false;
    }


    //Удаление категории нафиг!!! Хрен вернешь!!
    static public function trash($id = false)
    {
        if ($id) {
            $category = Categorys::findOne($id);
            if ($category) {
                $category->delete();
                return true;
            }
        }
        return false;
    }


}