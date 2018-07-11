<?php

namespace app\controllers;

use app\models\Categorys;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Users;
use app\models\Checks;
use yii\helpers\Url;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        if (!Users::$id) return $this->redirect(['users/login']);


        $data = array();

        $data['url_add_check'] = Url::to(['checks/add']);
        $url_edit_category = Url::to(['categorys/edit']);

        //Массив главных категорий (id_parent = 0)
        $categorys = Categorys::get_category_parent_id();


        //Узнаем какой сейгодня день
        $data_day = date('j');

        //Если сегоднешний день меньше 14 значит мы перем период из прошлого месяца
        if ($data_day < 14) {
            //Сегоняшняя дата минс 1 месяц и 14 число
            $data['date_start'] = date("Y-m-14", strtotime("-1 month"));
            $data['date_end'] = date('Y-m-13');
        } else {
            $data['date_start'] = date('Y-m-14');
            $data['date_end'] = date("Y-m-13", strtotime("+1 month"));
        }

        //Если есть POST запрос, то дату получаем из его (это типо фильтр)
        if (\Yii::$app->request->post()) {
            if (\Yii::$app->request->post('date_start'))
                $data['date_start'] = \Yii::$app->request->post('date_start');
            if (\Yii::$app->request->post('date_end'))
                $data['date_end'] = \Yii::$app->request->post('date_end');
        }


        //Две переменные для подведения итога всей таблицы
        $result_plan = 0;
        $result_fact = 0;
        $result_plan_output = 0;
        $result_fact_output = 0;

        //Перебираем все главные категории поочереди
        foreach ($categorys as $category) {

            //Получаем дочерние категории
            $childs = Categorys::get_category_parent_id($category->id);

            // переменные нужны для подсчета Итоговых сумм для категории
            $plan = 0;
            $fact = 0;

            $child_categorys = array();

            //Если есть дочерние категории
            if ($childs) {
                foreach ($childs as $child) {
                    //Считаем план для главной категории
                    $plan += $child->plan;

                    //Получаем сумму чеков учитывая категорию и отрезок времени
                    $checks_sum = Checks::get_sum_price_checks_category_id_date_range($child->id, $data['date_start'], $data['date_end']);
                    if (!$checks_sum) {
                        $checks_sum = 0;
                    }

                    //Считаем факт для главной категории
                    $fact += $checks_sum;

                    //Если категория "Доход" то сумма минус факт иначе наоборот
                    if ($category->type == 0) {
                        $deviation = round($checks_sum - $child->plan, '2');
                    } else {
                        $deviation = round($child->plan - $checks_sum, '2');
                    }

                    //Если Отклонение дохода меньше 0 значит недодали...
                    $class = false;
                    if ($deviation < 0) {
                        $class = 'danger';
                    }

                    //Заполняем дочернию категорию
                    $child_categorys[] = array(
                        'id' => $child->id,
                        'name' => $child->name,
                        'plan' => $child->plan,
                        'fact' => $checks_sum,
                        'deviation' => $deviation,
                        'class' => $class,
                        'url'       => $url_edit_category. '?id=' .$child->id,
                    );
                }
            }

            //Если категория "Доход" то факт минут сумма иначе наоборот
            if ($category->type == 0) {
                $deviation = round($fact - $plan, '2');
                $result_plan += $plan;
                $result_fact += $fact;
            } else {
                $deviation = round($plan - $fact, '2');
                $result_plan -= $plan;
                $result_fact -= $fact;
                $result_plan_output += $plan;
                $result_fact_output += $fact;
            }

            //Если доход (делаеться только для удобства) делим на 2 массива
            if ($category->type == 0) {
                $data['categorys_input'][] = array(
                    'id' => $category->id,
                    'name' => $category->name,
                    'plan' => $plan,
                    'fact' => $fact,
                    'deviation' => $deviation,
                    'childs' => $child_categorys
                );
            } else {
                $data['categorys_output'][] = array(
                    'id' => $category->id,
                    'name' => $category->name,
                    'plan' => $plan,
                    'fact' => $fact,
                    'deviation' => $deviation,
                    'childs' => $child_categorys
                );
            }
        }


        $data['result_plan'] = $result_plan;
        $data['result_fact'] = $result_fact;

        $data['result_plan_output'] = $result_plan_output;
        $data['result_fact_output'] = $result_fact_output;
        $data['result_deviation_output'] = round($result_plan_output - $result_fact_output, '2');


        $data['result_deviation'] = round($result_plan - $result_fact, '2');




        return $this->render('index', $data);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
