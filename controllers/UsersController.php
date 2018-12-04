<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11.12.2017
 * Time: 16:18
 */

namespace app\controllers;

use yii\web\Controller;
use app\models\Users;
use yii\web\Cookie;
use Yii;
use yii\helpers\Url;

class UsersController extends MainController
{
    public function actionIndex()
    {
        $data = array();

        $data['url_logout'] = Url::to(['users/logout']);

        $user_id = Users::has_login();

        if ($user_id) {
            $data['user_info'] = Users::get_user($user_id);
        } else {
            return $this->redirect(['users/login']);
        }

        $CLIENT_SECRET = 'jlOaJKZLETDa3STZC5xE';
        $CLIENT_ID = '6624064';
        $ACCESS_TOKEN = false;
        $user_id = 76422705;        //my vk id
        $result = false;

        $request_params = array(
            'client_id' => $CLIENT_ID,
            'redirect_uri' => 'http://psiu.by/users',
            'display'       => 'popup',
            'scope'         => '6',
            'v'             => '5.80',
        );

        $get_params = http_build_query($request_params);
        $result = $get_params;
        //header('Location: https://oauth.vk.com/authorize?'. $get_params);

        //$result = json_decode(file_get_contents('https://oauth.vk.com/authorize?'. $get_params));



        /*
        $request_params = array(
            'user_id' => $user_id,
            //'fields' => 'bdate',
            'v' => '5.80',
            'access_token' => $ACCESS_TOKEN,
        );
        $get_params = http_build_query($request_params);
        $result = json_decode(file_get_contents('https://api.vk.com/method/users.get?'. $get_params));
*/



        $data['user_info'] = $result;

        return $this->render('index', $data);
    }


    public function actionLogin()
    {
        $data = array();
        $data['success'] = false;
        $data['error'] = false;

        $data['url_registration'] = Url::to(['users/registration']);

        //Если есть POST запрос
        if (\Yii::$app->request->post()) {
            $data['login'] = \Yii::$app->request->post('login');
            $data['password'] = \Yii::$app->request->post('password');

            $user_id = Users::login($data['login'], $data['password']);

            if ($user_id) {
                return $this->redirect(['/users']);
            } else {
                $data['error'] = 'Логин или пароль не верный';
            }
        }

        return $this->render('login', $data);
    }


    public function actionLogout()
    {
        $cookies = Yii::$app->response->cookies;
        $cookies->remove('user_id');

        return $this->redirect(['/users']);
    }


    public function actionRegistration()
    {
        $data = array();
        $data['success'] = false;
        $data['error'] = false;

        $data['url_login'] = Url::to(['users/login']);

        //Если есть POST запрос
        if (\Yii::$app->request->post()) {
            $data['login'] = \Yii::$app->request->post('login');
            $data['name'] = \Yii::$app->request->post('name');
            $data['password'] = \Yii::$app->request->post('password');
            $data['password_2'] = \Yii::$app->request->post('password_2');

            if ($data['password'] == $data['password_2'] && $data['password'] != '') {
                if ($data['login'] != '') {


                    $user_id = Users::registration($data);

                    if ($user_id) {
                        $data['success'] = $user_id;
                    }else {
                        $data['error'] = 'Такой логин уже занят';
                    }




                } else {
                    $data['error'] = 'Логин не может быть пустой';
                }
            } else {
                $data['error'] = 'Пароли не совпадают';
            }
        }

        return $this->render('registration', $data);
    }

    public function actionVklogin($id) {



    }

}