<?php
use yii\helpers\Html;
// use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Status;
use kartik\select2\Select2;
use yii\helpers\Json;
use yii\db\Expression;
use app\models\Order;
use app\models\OrderSearch;
?>
<div class="order-index">

  <div class="col-sm-12 col-md-12 col-xs-12 col-sm-12">
  <div class="row">
      <h1 class="text-center"><i class="fa fa-table" aria-hidden="true"></i> Administrador de Todas las Ordenes Finalizadas</h1>
  </div>
</div>

<?php $gridColumns =  [
[
      'attribute'=>'id',
      'vAlign'=>'middle',
      'hAlign'=>'right',
      'width'=>'9%',
      'format'=>'text'
    ],
    [
      'class'=>'kartik\grid\ExpandRowColumn',
      'width'=>'50px',
      'value'=>function ($model, $key, $index, $column) {
          return GridView::ROW_COLLAPSED;
      },
      'detail'=>function ($model, $key, $index, $column) {
          return Yii::$app->controller->renderPartial('_detail_indextoday', ['model'=>$model,
        'rowvalue'=>$column->grid->dataProvider->totalCount - $index + 0]);
      },
      'headerOptions'=>['class'=>'kartik-sheet-style'],
      'expandOneOnly'=>true
    ],
    [
        'attribute'=>'phone',
        'width'=>'150px',
        'pageSummary'=>false,

        'value'=>function ($model, $key, $index, $widget) {
            return $model->phone;
        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map(Order::find()->orderBy('phone')->asArray()->all(), 'phone', 'phone'),
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>''],
        'group'=>false,  // enable grouping
        'groupedRow'=>false,
        'groupOddCssClass'=>'kv-grouped-row',
        'groupEvenCssClass'=>'kv-grouped-row',
    ],
    [
      'attribute'=>'only_date',
      // 'format' => 'YYYY-MM-DD',
      'options' => [
        'format' => 'YYYY-MM-DD',
      ],
      'vAlign'=>'middle',

      'hAlign'=>'right',
        'width'=>'180px',

      'pageSummary'=>false,
      'filterType' => GridView::FILTER_DATE_RANGE,
      'filterWidgetOptions' => ([
        // 'model' => $model,
        'attribute' => 'only_date',
        'presetDropdown' => true,

        'convertFormat' => false,
        'pluginOptions' => [
          'format' => 'YYYY-MM-DD',
          'opens' => 'left',
          'locale' => [
                'format' => 'YYYY-MM-DD'
            ],

          'separator' => ' - '
        ],
        'pluginEvents' => [
          "apply.daterangepicker" => "function() { apply_filter('only_date') }",
        ],
      ])
    ],
    [
      'attribute'=>'size',
      'vAlign'=>'middle',
      'hAlign'=>'right',
      'width'=>'310px',
      'value'=>function ($model, $key, $index, $widget) {
            return $model->size;
        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map(Order::find()->orderBy('size')->asArray()->all(), 'size', 'size'),
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>''],
        'group'=>false,  // enable grouping
        'groupedRow'=>false,
        'groupOddCssClass'=>'kv-grouped-row',
        'groupEvenCssClass'=>'kv-grouped-row',
    ],
    // [
    //   'attribute'=>'wait',
    //   'vAlign'=>'middle',
    //   'hAlign'=>'right',
    //   'width'=>'180px',
    //   // 'format'=>'time',
    //   'pageSummary'=>false
    // ],
    [
      'header'=> 'Repartidor',
      'vAlign'=>'middle',
      'hAlign'=>'middle',
      'width'=>'7%',
    ],
    [
      'header'=> 'Hora de llegada',
      'vAlign'=>'middle',
      'hAlign'=>'middle',
      'width'=>'7%',
    ],
    [
      'attribute'=>'total',
      'vAlign'=>'middle',
      'hAlign'=>'right',
      'width'=>'180px',
      'format'=>['decimal', 2],
      'pageSummary'=>true
    ],
    // [
    //   'class'=>'kartik\grid\ActionColumn',
    //   'header'=>false,
    //
    // ],
    [
              'class' => 'kartik\grid\ActionColumn',
              'header'=>false,
              // 'pageSummary' => false,
              'options'=>['style'=>'width:150px;'],
              'buttonOptions'=>['class'=>'btn btn-default'],
              'template'=>'<div class="btn-group btn-group-sm text-center" role="group">

              {view}

              </div>',
              'buttons'=>[

               
              ]
            ],

]?>

<?= GridView::widget([
    'id'=>'index',
    'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],

    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'columns'=>$gridColumns,
        'resizableColumns'=>true,
    // 'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'pjax'=>true, // pjax is set to always true for this demo
    // set your toolbar
    'toolbar'=> [
        '{export}',
        '{toggleData}',
    ],

    
    // parameters from the demo form
    'bordered'=>true,
    'striped'=>true,
    'condensed'=>true,
    'responsive'=>true,
    'hover'=>true,
    'showPageSummary'=>true,

    'panel'=>[
        'type'=>GridView::TYPE_SUCCESS,
    ],
    'persistResize'=>true,
    'toggleDataOptions'=>['minCount'=>10],
    'export'=>[
          // 'fontAwesome' => true,
          'fontAwesome'=>true,
          'PDF' => [
                  'options' => [
                      'title' => 'Piccolinas PDF',
                      //  'subject' => $tituloexport,
                      // 'author' => 'NYCSPrep CIMS',
                      // 'keywords' => 'NYCSPrep, preceptors, pdf'
                  ]
              ],
          ],
    'exportConfig' => [
          GridView::EXCEL => [
            'label' => 'Guardar en XLS',
            'showHeader' => true,
            'filename' => 'Piccolinas EXCEL',


          ],
          GridView::PDF => [
            'label' => 'Guardar en PDF',
            'showHeader' => true,
            'showCaption' => true,
            'showPageSummary' => true,
            'showFooter' => true,
             'title' => 'Reporte Piccolinas Pizza',
            'options' => ['title' =>'Reporte Piccolinas Pizza'],
            'config' => ['options' => ['title' =>'Reporte Piccolinas Pizza'],],
            'filename' =>'Reporte Piccolinas Pizza',
          ],
    ]
]);?>

</div>
