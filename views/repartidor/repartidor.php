<?php
	use yii\helpers\Url;
	use yii\helpers\Html;
	// use yii\grid\GridView;
	use yii\widgets\Pjax;
	use kartik\grid\GridView;
	use yii\helpers\ArrayHelper;
	use yii\widgets\ActiveForm;
	// use app\models\Status;
	use app\models\Dealer;
	use kartik\select2\Select2;
	use kartik\editable\Editable;
	$tituloexport = 'Administrador de repartidores';
  $this->title = $tituloexport
?>

<div class="col-sm-12 col-md-12 col-xs-12 col-sm-12">
	<div class="row">
		<section class="col-sm-7 col-sm-offset-3  col-lg-7 col-lg-offset-3  col-md-7 col-md-offset-3  col-xs-7 col-xs-offset-3">
			<h1><i class="fa fa-bicycle" aria-hidden="true"></i> Administrador de Repartidores</h1>
		</section><br>

		<section class="col-lg-1 col-sm-1 col-xs-1 col-md-1 text-left">          
            <a class="btn btn-lg btn-primary" href="index.php?r=repartidor/formulario">
                <span class="glyphicon glyphicon-plus-sign fa-lg"></span>
            </a>
        </section>
	</div><br><br>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 col-sm-12">
  <?php $rowvalue =   function ($model, $key, $index, $column) {
        return $column->grid->dataProvider->totalCount - $index + 0;}?>



<?php $gridColumns =  [
    [
      'attribute' => 'id',
      'contentOptions'=>['class'=>'kartik-sheet-style'],
      'width'=>'36px',
      'header'=>'',
      'headerOptions'=>['class'=>'kartik-sheet-style']
    ],
	[
      'attribute'=>'nombre',
      'header'=> 'Nombre',
      'vAlign'=>'middle',
      'hAlign'=>'middle',
      'width'=>'310px',
      'pageSummary'=>false
    ],
    [
      'attribute'=>'telefono',
      'header'=> 'Teléfono',
      'width'=>'310px',
      'pageSummary'=>false,

      'value'=>function ($model, $key, $index, $widget) {
          return $model->telefono;
      },
      'filterType'=>GridView::FILTER_SELECT2,
      'filter'=>ArrayHelper::map(Dealer::find()->orderBy('telefono')->asArray()->all(), 'id', 'telefono'),
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
      'attribute'=>'pedidos',
      'header'=> 'Numero de pedidos',
      'vAlign'=>'middle',
      'hAlign'=>'middle',
      'width'=>'7%',
    ],
    [
      'attribute'=>'salario',
      'header'=> 'Salario',
      'vAlign'=>'middle',
      'hAlign'=>'middle',
      'width'=>'7%',
      'format'=>['decimal', 2],
      'pageSummary'=>true
    ],
    [
      'attribute'=>'ganancias',
      'header'=> 'Ganancias',
      'vAlign'=>'middle',
      'hAlign'=>'middle',
      'format'=>['decimal', 2],
      'width'=>'310px',
      'pageSummary'=>true
    ],
    [
      'attribute'=>'total',
      'header'=> 'Total del día',
      'vAlign'=>'middle',
      'hAlign'=>'middle',
      'width'=>'7%',
    ],
    [
      'class' => 'kartik\grid\ActionColumn',
      'header' => 'Eliminar',
      'template' => '{delete}',
      'buttons' => [
          'delete' => function ($url, $model) {
              return Html::a(
              	'<span class="glyphicon glyphicon-trash"></span>',
              	[
              		'repartidor/delete',
              		'id' => $model->id
              	],
              	[
                  'title' => 'Eliminar',
                  'data-pjax' => true,
                  'data-method' => 'post'
              ]);
          }
      ],
    ],
]?>

<?= GridView::widget([
	'id'=>'index',
    'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'columns'=>$gridColumns,
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
        'type'=>GridView::TYPE_PRIMARY,
        'heading'=>'Repartidores',
    ],
    'persistResize'=>true,
    'toggleDataOptions'=>['minCount'=>10],
    'export'=>[
          // 'fontAwesome' => true,
          'fontAwesome'=>true,
          'PDF' => [
                  'options' => [
                      // 'title' => $tituloexport,
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
            // 'filename' => $tituloexport,


          ],
          GridView::PDF => [
            'label' => 'Guardar en PDF',
            'showHeader' => true,
            'showCaption' => true,
            'showPageSummary' => true,
            'showFooter' => true,
            'title' => $tituloexport,
            'options' => ['title' => $tituloexport, 'author' => 'Piccolinas Pizza'],
            'config' => ['options' => ['title' => $tituloexport],],
            'filename' => $tituloexport,
          ],
    ]
]);?>


</div>