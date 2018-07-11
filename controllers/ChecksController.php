<?php
namespace app\controllers;

use yii\web\Controller;
use yii\helpers\Url;
use app\models\Categorys;
use app\models\Checks;
use app\models\Users;


class ChecksController extends MainController
{
    public function actionIndex()
    {
        if (!Users::$id) return $this->redirect(['users/login']);

        $data = array();

        $data_day = date('j');

        if ($data_day < 14) {
            $data['date_start'] = date("Y-m-14", strtotime("-1 month"));
            $data['date_end'] = date('Y-m-13');
        }else {
            $data['date_start'] = date('Y-m-14');
            $data['date_end'] = date("Y-m-13", strtotime("+1 month"));
        }

        if (\Yii::$app->request->post()) {
            if (\Yii::$app->request->post('date_start'))
                $data['date_start'] = \Yii::$app->request->post('date_start');
            if (\Yii::$app->request->post('date_end'))
                $data['date_end'] = \Yii::$app->request->post('date_end');
            $all_check = \Yii::$app->request->post('all_check');
        }


        if (!$all_check) {
            $data['checks'] = Checks::get_checks_date_range($data['date_start'],$data['date_end']);
        }else {
            $data['checks'] = Checks::get_all_checks();
        }

        $data['url_edit'] = Url::to(['checks/edit']);
        $data['url_add'] = Url::to(['checks/add']);

        return $this->render('index', $data);
    }

    public function actionAdd()
    {
        $data = array();

        $data['error'] = false;
        $data['success'] = false;
        $data['url_cancel'] = Url::to(['/checks']);


        $data['categorys'] = Categorys::get_category_not_parent_id();


        //Если есть POST запрос
        if (\Yii::$app->request->post()) {

            //Получаем данные из формы
            $data['id_category'] = \Yii::$app->request->post('id_category');
            $data['price'] = \Yii::$app->request->post('price');
            $data['name'] = \Yii::$app->request->post('name');
            $data['data'] = \Yii::$app->request->post('data');


            if ($data['id_category'] != '' && $data['price']) {

                Checks::add_check($data);

            } else {
                $data['error'] = 'Цена и категория не может быть пустой';
            }
        }


        return $this->render('add', $data);
    }

    public function actionEdit($id)
    {
        $data = array();

        $data['url_cancel'] = Url::to(['/checks']);
        $data['id'] = $id;

        $data['categorys'] = Categorys::get_category_not_parent_id();

        $check_info = Checks::get_check_id($id);

        if ($check_info) {


            $data['chek_info'] = $check_info;

            //Если есть POST запрос
            if (\Yii::$app->request->post()) {


                //Получаем данные из формы
                $data['id_category'] = \Yii::$app->request->post('id_category');
                $data['price'] = \Yii::$app->request->post('price');
                $data['name'] = \Yii::$app->request->post('name');
                $data['data'] = \Yii::$app->request->post('data');

                $data['chek_info'] = Checks::update_check($data);

                $data['success'] = $id;

            }



        }else {
            $data['error'] = 'Чек не найден';
        }

        return $this->render('edit', $data);
    }

    public function actionRemove($id = false)
    {
        if ($id) {
            Checks::remove_check($id);
        }
        return $this->actionIndex();
    }


}