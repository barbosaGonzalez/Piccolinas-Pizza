<?php

use yii\helpers\Html;
// use yii\widgets\DetailView;
use kartik\detail\DetailView;
use \kartik\date\DatePicker;
use yii2assets\printthis\PrintThis;

// $this->title = 'Orden ' . $model->id;

?>
<div class="order-view">

    <h3 class="pull-right">
      <!-- <?= Html::encode($this->title) ?> -->
    </h3>
<!--
    <?= Html::a('<b>Copiar datos</b>',[ 'order/create',
  'phone' => $model->phone,
  'address' => $model->address,
  'neighborhood' => $model->neighborhood,
  'delivery' => 0,],
  ['class' => 'btn btn-info'])?>

<div class="col-md-2">
  <?= Html::a('<b>Modificar</b>', ['update',
      'id' => $model->id,
      'phone' => $model->phone,
      'address' => $model->address,
      'neighborhood' => $model->neighborhood,
      'delivery' => $model->delivery,
      'size' => $model->size,
      'ingredients' => $model->ingredients,
      'quantity' => $model->quantity,
      'cheese_border' => $model->cheese_border,
      'money' => $model->money,
      'change' => $model->change,
      'subtotal' => $model->subtotal,
      'total' => $model->total,
      'wait' => $model->wait,], ['class' => ' pull-left btn btn-primary']) ?>
    </div>

    <div class="col-md-2">

<?= PrintThis::widget([
  'htmlOptions' => [
    'id' => 'PrintThis',
    'btnClass' => 'btn btn-success',
    'btnId' => 'btnPrintThis',
    'btnText' => '<b>Imprimir</b>',
    'btnIcon' => 'fa fa-print'
  ],
  'options' => [
    'debug' => false,
    'importCSS' => false,
    'importStyle' => false,
    // 'loadCSS' => "path/to/my.css",
    'pageTitle' => "<b>Piccolinas Pizza</b>",
    'removeInline' => false,
    'printDelay' => 333,
    'header' => null,
    'formValues' => false,
  ]
]);
?>
</div>

<div class="col-md-2">

<?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
  'class' => 'btn btn-danger pull-left',
  'data' => [
    'confirm' => 'Seguro de borrar este pedido?',
    'method' => 'post',
  ],
  ]) ?>
</div> -->
<!-- <br>
<br>
<br> -->

<div class="hidden">

<div id="PrintThis">

      <?= DetailView::widget([
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],

          'model' => $model,
          'attributes' => [
            [  'attribute' => 'id',
              'value' => $rowvalue,],
              'phone',
              'wait',
              'time',
              'only_date',
              'address',
              'neighborhood',
              ['attribute' => 'cheese_border',
              'value' => $model->cheese_border == '0' ? '' : 'Con Queso',
              'label' => $model->cheese_border == '0' ? '' : 'Orilla',
            ],
              'size',
              'quantity',
              'ingredients',
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

    <?= DetailView::widget([
        'model' => $model,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],

        'attributes' => [
          // // [  'attribute' => 'id',
          // //   'value' => $rowvalue,],
          // //   'phone',
            ['attribute' => 'wait',
          ],

          // //   'time',
          //   'only_date',
            'address',
            'neighborhood',
            ['attribute' => 'cheese_border',
            'value' => $model->cheese_border == '0' ? '' : 'Con Queso',
            'label' => $model->cheese_border == '0' ? '' : 'Orilla',
          ],
            'size',
            'quantity',
            'ingredients',
            'subtotal',
            'delivery',
            'total',
            'money',
            'change',
            // 'note',
            // 'status',
        ],
    ]) ?>


    </br>
  </br>

</div>
