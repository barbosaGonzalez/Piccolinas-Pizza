<?php

namespace app\controllers;

use Yii;
use app\models\Dealer;
use app\models\DealerSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use yii\web\NotFoundHttpException;
use yii\db\Expression;
use yii\data\ActiveDataProvider;
use yii\base\Model;
use yii\helpers\Json;
use kartik\mpdf\Pdf;
use kartik\editable\Editable;

class RepartidorController extends Controller
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

    public function actionRepartidor()
    {
        $model = new DealerSearch();
        $searchModel = DealerSearch::find()->andFilterWhere(['>', 'id', 0]);
        $dataProvider = new ActiveDataProvider(['query' =>$searchModel,]);
        return $this->render("repartidor",[
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
          'model' => $model,
      ]);
    }

    public function actionFormulario()
    {
        $model = new Dealer();
        $modelSearch = new DealerSearch();
        $searchModel = DealerSearch::find()->andFilterWhere(['>', 'id', 0]);
        $dataProvider = new ActiveDataProvider(['query' =>$searchModel,]);

        if ($model->load(Yii::$app->request->post())) {
            $model->nombre = strtoupper ($model->nombre);
            $model->save();
            return $this->redirect(['repartidor']);
        } else {
            return $this->render('formulario', [
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        $model = new Dealer();

        $modelSearch = new DealerSearch();
        $searchModel = DealerSearch::find()->andFilterWhere(['>', 'id', 0]);
        $dataProvider = new ActiveDataProvider(['query' =>$searchModel,]);

        if ($model->load(Yii::$app->request->post())) {
            $model->nombre = strtoupper ($model->nombre);
            $model->save();
            return $this->render("repartidor",[
                  'searchModel' => $searchModel,
                  'dataProvider' => $dataProvider,
                  'model' => $modelSearch,
              ]);
        } else {
            return $this->render('formulario', [
                'model' => $model,

            ]);
        }
    }

    public function actionDelete($id)
    {
        $model=Dealer::deleteAll(array("id"=>$id));
        return $this->redirect(['repartidor']);
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