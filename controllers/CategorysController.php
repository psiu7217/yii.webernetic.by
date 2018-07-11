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


class CategorysController extends MainController
{
    public function actionIndex()
    {
        if (!Users::$id) return $this->redirect(['users/login']);


        $data = array();

        $categorys = Categorys::get_categorys();

        $data['categorys'] = $categorys;

        $data['url_edit'] = Url::to(['categorys/edit']);
        $data['url_add'] = Url::to(['categorys/add']);

        return $this->render('index', $data);
    }

    public function actionAdd()
    {
        $data = array();

        $data['error'] = false;
        $data['success'] = false;
        $data['url_cancel'] = Url::to(['categorys/index']);

        $data['categorys'] = Categorys::get_category_parent_id();


        //Если есть POST запрос
        if (\Yii::$app->request->post()) {

            //Получаем данные из формы
            $data['name'] = \Yii::$app->request->post('name');
            $data['plan'] = \Yii::$app->request->post('plan');
            $data['type'] = \Yii::$app->request->post('type');
            $data['id_parent'] = \Yii::$app->request->post('id_parent');
            $data['sort'] = \Yii::$app->request->post('sort');


            if ($data['name'] != '') {

                if (Categorys::add($data)){
                    $data['success'] = $data['name'];
                }else {
                    $data['error'] = 'Ошибка, возможно вы не авторизированы';
                }

            } else {
                $data['error'] = 'Название Категории не может быть пустой';
            }
        }


        return $this->render('add', $data);
    }

    public function actionEdit($id)
    {

        $data = array();

        $data['url_cancel'] = Url::to(['categorys/index']);
        $data['id'] = $id;

        $category_info = Categorys::get_category_id($id);

        if ($category_info) {
            $data['category_info'] = $category_info;


            $data['categorys'] = Categorys::get_category_parent_id();


            //Если есть POST запрос
            if (\Yii::$app->request->post()) {

                //Получаем данные из формы
                $data['name'] = \Yii::$app->request->post('name');
                $data['plan'] = \Yii::$app->request->post('plan');
                $data['type'] = \Yii::$app->request->post('type');
                $data['id_parent'] = \Yii::$app->request->post('id_parent');
                $data['sort'] = \Yii::$app->request->post('sort');

                $data['category_info'] = Categorys::edit($data);

                $data['success'] = $id;

            }

        } else {
            $data['error'] = 'Категория не найдена';
        }

        return $this->render('edit', $data);
    }

    public function actionRemove($id = false)
    {
        $data = array();

        if ($id) {
            Categorys::remove($id);
        }

        $data['url_edit'] = Url::to(['categorys/edit']);
        $data['url_add'] = Url::to(['categorys/add']);
        $data['categorys'] = Categorys::get_categorys();
        return $this->render('index', $data);
    }


}