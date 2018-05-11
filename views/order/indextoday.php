<?php
use yii\helpers\Html;
// use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

// use app\models\Status;
use app\models\Order;
use app\models\OrderSearch;
use app\models\Dealer;
use kartik\select2\Select2;
use kartik\editable\Editable;

?>
<?php $tituloexport = 'Ordenes del día '.$now?>
<?php $dealers = Dealer::find()->asArray()->all(); ?>
<?php $searchFilter= new OrderSearch();?>
<?php $this->title = $tituloexport?>
<div class="order-indextoday">
  <?php $rowvalue =   function ($model, $key, $index, $column) {
        return $column->grid->dataProvider->totalCount - $index + 0;}?>

<div class="col-sm-12 col-md-12 col-xs-12 col-sm-12">
  <div class="row">
      <h1 class="text-center"><i class="fa fa-list-alt" aria-hidden="true"></i> Administrador de las Ordenes del dia</h1>
  </div>
</div>


<?php $gridColumns =  [
   [
      'attribute'=>'count',
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
          return Yii::$app->controller->renderPartial('_detail_indextoday', [
            'model'=>$model,
            'rowvalue'=>$column->grid->dataProvider->totalCount - $index + 0
          ]);
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
        'filter'=>ArrayHelper::map(Order::find()->andFilterWhere(['like', 'date', $now])->andFilterWhere(['=', 'done', 0])->orderBy('phone')->asArray()->all(), 'phone', 'phone'),
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
      'attribute'=>'address',
      'vAlign'=>'middle',
      'hAlign'=>'right',
      'width'=>'9%',
      'format'=>'text'
    ],
    [
      'attribute'=>'time',
      'width'=>'9%',
      'format'=>'time'
    ],
    [
      'attribute'=>'total',
      'vAlign'=>'middle',
      'hAlign'=>'middle',
      'width'=>'7%',
      'format'=>['decimal', 2],
      'pageSummary'=>true
    ],
    [
      'attribute'=>'change',
      'vAlign'=>'middle',
      'hAlign'=>'middle',
      'width'=>'7%',
      'format'=>['decimal', 2]
    ],
    [
      'class' => 'kartik\grid\ActionColumn',
      'header'=> 'Repartidores',
      'vAlign'=>'middle',
      'hAlign'=>'middle',
      'width'=>'7%',
      'template' => '{arrivedealer}',
      'buttons' => [
        'arrivedealer' => function ($url, $model) {
          if($model->repartidor_id >= 1){
            return Html::a(
              '<button 
                type="button" 
                disabled
                class="btn btn-default">
                  '.$model->repartidor_name.'
                </button>');
          }
          if( $model->status == "1"){
            return Html::a(
              '<button 
                type="button" 
                disabled
                class="btn btn-default">
                  Esto es un egreso
                </button>');
          }
          return Html::a(
            '<button 
              onclick="setOrderId('.$model->id.')" 
              type="button" 
              class="btn btn-default glyphicon glyphicon-user" 
              data-toggle="modal" 
              data-target="#exampleModal">
                Asignar
            </button>');
          }
      ],
    ],
    [
      'attribute'=>'time_leave',
      'header'=> 'Hora de salida',
      'vAlign'=>'middle',
      'hAlign'=>'middle',
      'width'=>'7%',
      'format'=>'time'
    ],
    [
      'class' => 'kartik\grid\ActionColumn',
      'header' => 'Llegó repartidor',
      'template' => '{arrivedealer}',
      'buttons' => [
        'arrivedealer' => function ($url, $model) {
          if( $model->status == "0"){
            return Html::a('<button type="button" class="btn btn-default glyphicon glyphicon-check">
  
                    </button>', $url, [
                      'title' => 'Llegó repartidor',
                      'data-pjax' => true,
                      'data-method' => 'post'
                  ]);
          }
              }
          ],
    ],
    [
      'class' => 'kartik\grid\ActionColumn',
      'header'=> 'Visualizar',
      'pageSummary' => false,
      'options'=>['style'=>'width:150px;'],
      'template'=>'<button type="button" class="btn btn-default">

      {view}

      </button>',
      'buttons'=>[

      ]
    ],
    [
      'class' => 'kartik\grid\ActionColumn',
      'header' => 'Eliminar',
      'template' => '{delete}',
      'buttons' => [
          'delete' => function ($url, $model) {
              return Html::a('<button type="button" class="btn btn-default glyphicon glyphicon-trash">
  
</button>', $url, [
                  'title' => 'Eliminar',
                  'data-pjax' => true,
                  'data-method' => 'post'
              ]);
          }
      ],
    ],
]?>

<?= GridView::widget([
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
        'type'=>GridView::TYPE_INFO,
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


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Asignación de repartidores</h3>
      </div>
      <div class="modal-body">

        <div class="row">
          <section class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
            <labelfor="selecciona">Por favor selecciona un repartidor, el cual llevará la orden: </label><br>
            <select type="text" class="form-control" aria-describedby="dealerSelect" id="dealerSelect"> 
              <?php
                foreach($dealers as $dealer){ ?>
                  <option value="<?php echo $dealer['id'];?>"><?php echo $dealer['nombre'];?></option> 
              <?php } ?>
            </select>
          </section>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button onclick="setDealerId()" type="button" class="btn btn-primary">Asignar</button>
      </div>
    </div>
  </div>
</div>

<script>
var id = 0;
function setOrderId(id) {
  this.id = id;
}

function setDealerId(){
  var delaerId = $('#dealerSelect').val();
  var dealerName = $('#dealerSelect  option:selected').text();
  $(location).attr('href', 'index.php?r=order%2Fupdatedealer&id='+this.id+'&dealer='+delaerId+'&dealername='+dealerName);
}
</script>