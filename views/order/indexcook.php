<?php
use yii\helpers\Html;
// use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Order;
use app\models\OrderSearch;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\editable\Editable;
// use dosamigos\editable\Editable;

?>
<?php $tituloexport = 'Ordenes del día '.$now?>
<?php $searchFilter= new OrderSearch();?>
<?php $this->title = $tituloexport?>
<div class="order-indexcook">
<?php $gridColumns =  [

  // [
  //   'class'=>'kartik\grid\ExpandRowColumn',
  //   'width'=>'50px',
  //   'value'=>function ($model, $key, $index, $column) {
  //       return GridView::ROW_COLLAPSED;
  //   },
  //   'detail'=>function ($model, $key, $index, $column) {
  //       return Yii::$app->controller->renderPartial('_detail_editable', ['model'=>$model]);
  //   },
  //   'headerOptions'=>['class'=>'kartik-sheet-style'],
  //   'expandOneOnly'=>true
  // ],
    // [
    //   'class' => 'kartik\grid\SerialColumn',
    //   'contentOptions'=>['class'=>'kartik-sheet-style'],
    //   'width'=>'36px',
    //   'header'=>'',
    //   'headerOptions'=>['class'=>'kartik-sheet-style']
    // ],

    // [
    //   'attribute'=>'id',
    //   'vAlign'=>'middle',
    //   'hAlign'=>'right',
    //   'width'=>'9%',
    //   // 'format'=>'time',
    //   'pageSummary'=>false
    // ],
    [
      'attribute'=>'quantity',
      // 'vAlign'=>'middle',
      // 'hAlign'=>'right',
      // 'width'=>'9%',
      // // 'format'=>'time',
      // 'pageSummary'=>false
    ],
//     [
//   'class'=>'kartik\grid\BooleanColumn',
//   'attribute'=>'cheese_border',
//   'vAlign'=>'middle',
//   'label'=>'Orilla',
//   'trueLabel'=>'Orila Con Queso',
//   'falseLabel'=>'Orilla Sin Queso',
//    'falseIcon'=>'<span class="glyphicon glyphicon-remove text-danger"> Sin Queso</span>',
//    'trueIcon'=>'<span class="glyphicon glyphicon-ok text-success"> Con Queso</span>',
// ],
    [
      'attribute'=>'size',
      // 'vAlign'=>'middle',
      // 'hAlign'=>'right',
      // 'width'=>'9%',
      // // 'format'=>'time',
      // 'pageSummary'=>false
    ],
    [
      'attribute'=>'ingredients',
      // 'vAlign'=>'middle',
      // 'hAlign'=>'right',
      // 'width'=>'9%',
      // // 'format'=>'time',
      // 'pageSummary'=>false
    ],

    [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'status',
        'format' => 'raw',

        'editableOptions'=>[
            'header'=>'Status',
            'inputType'=>\kartik\editable\Editable::INPUT_DROPDOWN_LIST,
            'data' =>[0=>'Esperando',1=>'Cocinando'],
            // 'data'=>['Esperando','Cocinando'],
            'options'=>[
                'pluginOptions'=>['data'=>['Esperando','Cocinando'],],
            ],
            // 'source' => json_encode($section),
        ],
        'hAlign'=>'right',
        'vAlign'=>'middle',
    ],
  //   [
  //       'class' => \dosamigos\grid\EditableColumn::className(),
  //       'attribute' => 'status',
  //       'url' => ['order/update'],
  //       'type' => 'select',
  //       'format' => 'raw',
  //       'value' =>  function($data) { return $data->status; },
  //       'editableOptions' => [
  //           // 'mode' => 'inline',
  //           'source' => [
  //           [
  //               'value' => 0,
  //               'text' => 'Esperando',
  //           ],
  //           [
  //             'value' => 1,
  //             'text' => 'Cocinando',
  //           ],
  //           [
  //             'value' => 2,
  //             'text' => 'Listo',
  //           ],
  //           [
  //             'value' => 3,
  //             'text' => 'Repartiendo',
  //           ],
  //           [
  //             'value' => 4,
  //             'text' => 'Entregado',
  //           ],
  //       ],
  //       ],
  // ],



    [
      'attribute'=>'time',
      'label' => 'Hora del Pedido',
      // 'vAlign'=>'middle',
      // 'hAlign'=>'right',
      // 'width'=>'9%',
      // 'format'=>'time',
      // 'pageSummary'=>false
    ],
]?>

<?= GridView::widget([
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'columns'=>$gridColumns,
    // 'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
    // 'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    // 'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'pjax'=>true, // pjax is set to always true for this demo
    // 'pjaxSettings'=>[
    //     'neverTimeout'=>true,
    //     'options'=>[
    //       'id'=>'cooking_grid'
    //     ],
    //   ],

    // set your toolbar
    // 'toolbar'=> [
    //     // '{export}',
    //     '{toggleData}',
    // ],
    // // set export properties
    // 'export'=>[
    //     'fontAwesome'=>true
    // ],
    // // parameters from the demo form
    // 'bordered'=>true,
    // 'striped'=>true,
    // 'condensed'=>true,
    // 'responsive'=>true,
    // 'hover'=>true,
    // 'showPageSummary'=>false,
    // 'panel'=>[
    //     'type'=>GridView::TYPE_PRIMARY,
    //     'heading'=>'Cocina',
    // ],
    // 'persistResize'=>true,
    // 'toggleDataOptions'=>['minCount'=>10],
]);?>


 <!-- <meta http-equiv="refresh" content="25; URL=/index.php?r=order/indexcook"> -->
</div>
