<?php
namespace app\controllers;

use Yii;
use app\models\Order;
use app\models\OrderSearch;
use app\models\Status;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Expression;
use yii\data\ActiveDataProvider;
use yii\base\Model;
use yii\helpers\Json;
use kartik\mpdf\Pdf;
use kartik\editable\Editable;
// use dosamigos\editable\Editable;
class OrderController extends Controller
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

    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 0);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionIndextoday()
    {
      $model = new Order;

      $expression = new Expression('NOW()');
      $now = (new \yii\db\Query)->select($expression)->scalar();
      $now = substr($now, 0, 10);

      $searchModel = new OrderSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 1);

      if(Yii::$app->request->post('hasEditable'))
      {
        // $model = $this->findModel($model['id']);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        // $out = Json::encode(['output'=>'','message'=>'']);
        // $post = [];
        // $values = current($_POST['Order']);
        // $post['Order'] = $posted;
        //
        // $orderId = Yii::$app->request->post('editableKey');
        // $order = Order::findOne($orderId);
        // $keys = unserialize(Yii::$app->request->post('editableKey'));
        // $model = $this->findModel($keys['key1'],$keys['key2']);
        //

        if ($model->load($post))
        {
          $value = $model->status;
          return ['output'=> $value, 'message' => ''];

        }
        else {
          return ['otuput' => '', 'message' => ''];
        }

      }

      return $this->render('indextoday', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
          'now' =>  $now,
          'model' => $model,
      ]);
    }


    public function actionIndexcook()
    {

      $expression = new Expression('NOW()');
      $now = (new \yii\db\Query)->select($expression)->scalar();
      $now = substr($now, 0, 10);
      $searchModel = OrderSearch::find()->andFilterWhere(['like', 'date', $now])->indexBy('id');

      $dataProvider = new ActiveDataProvider(['query' =>$searchModel,
              'sort' => [
                 'defaultOrder' => [
                      'id' => SORT_DESC,
           ]
        ],
      ]);


      if (Yii::$app->request->post('hasEditable'))
      {
        $out = Yii::$app->response;
        //
        $out->format = \yii\web\Response::FORMAT_JSON;

        $keys = (Yii::$app->request->post('editableKey'));
        // $model = $this->findModel($keys);
        $model = Order::findOne($keys);
        $out=Json::encode(['output'=>'','message'=>'']);
        $values=current($_POST['Order']);
        if($model->key1){
          $model->status=$values['status'];
          $model->save();
        }
        // $_id=$_POST['editableKey'];
        // $orderId = Yii::$app->request->post('editableKey');
        // $model = $this->findModel($_id);
        // $post=[];
        // $response = Yii::$app->response;
        // $response->format = \yii\web\Response::FORMAT_JSON;
        // $posted = current($_POST['Order']);
        // $post['Order']=$posted;
        // if($model->load($post)){
        //   $model->save();
        //   if(isset($posted['status']))
        //   {
        //     $output=$model->status;
        //   }
        //   $out = Json::encode(['output'=>$output, 'message'=>'']);
        // }
        echo $out;
        return;
      }

      return $this->renderAjax('indexcook', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
          'now' =>  $now,

          // 'update' => [
          //     'class' => \dosamigos\editable\EditableAction::className(),
          //     'modelClass' => Order::className(),
          //     'forceCreate' => false
          // ],

      ]);
    }

    public function actionView($id)
    {


        return $this->render('view', [
            'model' => $this->findModel($id),
    
        ]);
    }

    public function actionCreate()
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
            $model->wait = $this->toHours($model->wait);

            $model->done = 0;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,

            ]);
        }
    }

public function toHours($min)
{
  //obtener segundos
  $sec = $min * 60;
  //mod_hora es el sobrante, en horas, de la division de días; 
  $mod_hora=$sec%86400;
  //hora es la division entre el sobrante de horas y 3600 segundos que representa una hora;
  $horas=floor($mod_hora/3600); 
  //mod_minuto es el sobrante, en minutos, de la division de horas; 
  $mod_minuto=$mod_hora%3600;
  //minuto es la division entre el sobrante y 60 segundos que representa un minuto;
  $minutos=floor($mod_minuto/60);
  if($horas<=0)
  {
    $text = '00:'.$minutos.':00';
  }
  else {
    $text = $horas.':'.$minutos.':00';
  }
  return $text; 
}

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            // $model->ingredients = implode (", ",$model->ingredients);
            // $model->size = implode (", ",$model->size);
            $model->save();
            return $this->redirect(['order/indextoday', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdatedealer($id, $dealer, $dealername){
      $expression = new Expression('NOW()');
      $now = (new \yii\db\Query)->select($expression)->scalar();

      $model = $this->findModel($id);
      $model->repartidor_id = $dealer;
      $model->repartidor_name = $dealername;
      $model->time_leave = $now;
      $model->save();
      return $this->redirect(['order/indextoday', 'id' => $model->id]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['indextoday']);
    }

    public function actionArrivedealer($id){

      $expression = new Expression('NOW()');
      $now = (new \yii\db\Query)->select($expression)->scalar();

      $model = $this->findModel($id);
      $model->done = 1;
      $model->time_arrive = $now;
      $model->save();
      return $this->redirect(['indextoday']);
    }

    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La página especificada no existe.');
        }
    }

    public function actionReport($id) {
      $model = $this->findModel($id);
        $content = $this->renderPartial('_print', [
            'model' => $model,
        ]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_LETTER,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            'marginLeft' => 150,
            'marginRight' => 10,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
             // set mPDF properties on the fly
            'options' => ['title' => 'Piccolinas Pizza'],
             // call mPDF methods on the fly
            'methods' => [
                'SetHeader'=>['Piccolinas Pizza'],
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }

}