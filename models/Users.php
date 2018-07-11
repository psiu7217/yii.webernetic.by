<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;
use yii\web\Cookie;

class Users extends ActiveRecord
{


    static public $id;


    //Список всех пользователей
    static public function get_all_users()
    {
        return Users::find()->orderBy('name')->all();
    }


    //Вернуть информацию юзера по id
    static public function get_user($id = false) {
        if ($id){
            return Users::findOne(['id' => $id]);
        }
        return false;
    }

    //Проверка авторизации пользователя
    static public function has_login()
    {
        $value = \Yii::$app->getRequest()->getCookies()->getValue('user_id');

        if ($value) {
            Users::$id = $value;
            return $value;
        }else {
            Users::$id = false;
            return false;
        }
    }


    //Функция авторизации пользователя. Возвращает id если нашлелся пользователь и записывает в куки
    static public function login($login =false, $password = false)
    {
        if ($login && $password) {
            $user = Users::findOne(['login' => $login, 'password' => $password]);

            if ($user) {
                $cookies = Yii::$app->response->cookies;


                $cookie = new Cookie([
                    'name' => 'user_id',
                    'value' => $user->id,
                    'expire' => time() + (3600 * 24 * 30),
                ]);
                \Yii::$app->getResponse()->getCookies()->add($cookie);



                return $user->id;
            }
        }
        return false;
    }


    static public function registration($data = false)
    {
        $user = Users::findOne(['login' => $data['login']]);

        if ($data && !$user) {
            $user = new Users();

            $user->login = $data['login'];
            $user->name = $data['name'];
            $user->password = $data['password'];

            $user->save();

            return $user->id;
        }
        return false;
    }
}

//Вызываем функцию проверки
Users::has_login();