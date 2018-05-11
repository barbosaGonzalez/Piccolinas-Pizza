<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use app\models\Order;
use app\models\OrderSearch;
use app\models\Status;
use yii\web\NotFoundHttpException;
use yii\db\Expression;
use yii\data\ActiveDataProvider;
use yii\base\Model;
use yii\helpers\Json;
use kartik\mpdf\Pdf;
use kartik\editable\Editable;

class FinanzasController extends Controller
{

    public function behaviors()
    {
         return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionFinanzas()
    {
        $model = new Order();
        if ($model->load(Yii::$app->request->post())) {
            // $model->ingredients = implode (", ",$model->ingredients);
            // $model->size = implode (", ",$model->size);
            $model->address = strtoupper ($model->address);
            $model->neighborhood = strtoupper ($model->neighborhood);
            $model->description = strtoupper ($model->description);
            $model->ingredients = strtoupper ($model->ingredients);
            $model->size = strtoupper ($model->size);
            $model->total = ($model->total)*(-1);
            $model->save();
            return $this->render('finanzas', [
                'model' => $model,

            ]);
        } else {
            return $this->render('finanzas', [
                'model' => $model,

            ]);
        }
    }

    /**
     * @inheritdoc
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

    public function actionCreate()
    {

    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
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
