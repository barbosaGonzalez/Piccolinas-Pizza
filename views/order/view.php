<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\editable\Editable;
use yii\helpers\Url;
use kartik\mpdf\Pdf;
use yii\widgets\ActiveForm;
use yii2assets\printthis\PrintThis;
use yii\db\Expression;
use app\models\Order;

use app\models\OrderSearch;


$this->title = 'Orden #' . $model->count;

?>
<div class="order-view">

    <h3 class="pull-left"><?= Html::encode($this->title) ?></h3>
<br>

</br>
</br>
    <p>
      <?= Html::a('&nbsp;<b>Modificar</b>', ['update',
      'id' => $model->id,
      'phone' => $model->phone,
      'address' => $model->address,
      'neighborhood' => $model->neighborhood,
      'delivery' => $model->delivery,
      'size' => $model->size,
      'soda_type' => $model->size,
      'soda_size' => $model->size,
      'soda_quantity' => $model->quantity,
      'ingredients' => $model->ingredients,
      'description' => $model->description,
      'quantity' => $model->quantity,
      'cheese_border' => $model->cheese_border,
      'money' => $model->money,
      'change' => $model->change,
      'subtotal' => $model->subtotal,
      'total' => $model->total,
      'wait' => $model->wait,], ['class' => ' pull-left btn btn-primary fa fa-pencil-square-o ']) ?>
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;

        <?= Html::a('&nbsp;<b>Eliminar</b>', ['delete', 'id' => $model->id], [
          'class' => 'btn btn-danger pull-right fa fa-trash',
          'data' => [
            'confirm' => 'Seguro de eliminar este pedido?',
            'method' => 'post',
          ],
          ]) ?>



          <?= Html::a('&nbsp;<b>Copiar datos</b>',[ 'order/create',
        'phone' => $model->phone,
        'address' => $model->address,
        'neighborhood' => $model->neighborhood,
        'delivery' => 0,],
        ['class' => 'btn btn-info fa fa-files-o'])?>
        &nbsp;        &nbsp;        &nbsp;        &nbsp;

        <?php $previousUrl = null;?>
        <?php $previousUrl = Url::previous();?>

        <!-- <?= Html::a('<i class="fa fa-file"></i> <b>PDF</b>', ['report', 'id'=>$model->id], [
          'class'=>'btn btn-warning',
          'target'=>'_blank',
          'data-toggle'=>'tooltip',
          'title'=>'El ticket aparecerá en una ventana nueva.'
        ]);
        ?> -->
        &nbsp;        &nbsp;        &nbsp;        &nbsp;
        <?= PrintThis::widget([
          'htmlOptions' => [
            'id' => 'PrintThis',
            'btnClass' => 'btn btn-success',
            'btnId' => 'btnPrintThis',
            'btnText' => '<b>Imprimir</b>',
            'btnIcon' => 'fa fa-print'
          ],
          'options' => [
            'debug'=> false,               // show the iframe for debugging
            'importCSS'=> false,            // import page CSS
            'importStyle'=> false,         // import style tags
            'printContainer'=> true,       // grab outer container as well as the contents of the selector
            'loadCSS' => "piccolinas/web/css/site.css",  // path to additional css file - use an array [] for multiple
            'pageTitle'=> "Piccolinas Pizza",              // add title to print page
            'removeInline'=> false,        // remove all inline styles from print elements
            'printDelay'=> 333,            // variable print delay; depending on complexity a higher value may be necessary
            'header'=> false,               // prefix to html
            'footer'=> false,               // postfix to html
            'base'=> false ,               // preserve the BASE tag, or accept a string for the URL
            'formValues'=> true,           // preserve input/form values
            'canvas'=> false,              // copy canvas elements (experimental)
            'doctypeString'=> "Piccolinas pizzas",       // enter a different doctype for older markup
            'removeScripts'=> false,       // remove script tags from print content
            'copyTagClasses'=> false       // copy classes from the html & body tag
          ]
        ]);
        ?>


    </p>
  </br>
  </br>


  <div id="PrintThis">

    <?= DetailView::widget([
        'model' => $model,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],

        'attributes' => [
            [
              'attribute' => 'count',
              // 'value' => $count,
            ],
            // 'id',
            'phone',
            [
              'attribute' => 'wait',
                'format'=>['text', 2],

              ],
            'time',
            'only_date',
            'address',
            'neighborhood',
            [
              'attribute' => 'cheese_border',
              'value' => $model->cheese_border == '0' ? 'SIN QUESO' : 'CON QUESO',
            ],
            'size',
            'quantity',
            'ingredients',
            'description',
            'soda_quantity',
            [
              'attribute' => 'soda_type',

              'value' => $model->soda_type == '' ? 'NO SE ESCOGIÓ REFRESCO' :
                $model->soda_type == '1' ? 'COCA COLA' :
                $model->soda_type == '2' ? 'MANZANITA' :
                $model->soda_type == '3' ? 'JARRITO' :
                $model->soda_type == '4' ? 'SPRITE' :
                '',
            ],
            'subtotal',
            'delivery',
            'total',
            'money',
            'change',
            // 'note',
            // 'status',
        ],
    ]) ?>

</div>

</div>