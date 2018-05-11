<?php

use yii\helpers\Html;
// use yii\widgets\DetailView;
use kartik\detail\DetailView;
use \kartik\date\DatePicker;
use yii2assets\printthis\PrintThis;


// $this->title = 'Orden ' . $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h3 class="pull-right">
      <!-- <?= Html::encode($this->title) ?> -->
    </h3>
<!-- <br>

</br>
</br> -->

<div class="pull-right">
<?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
  'class' => 'btn btn-danger pull-left',
  'data' => [
    'confirm' => 'Seguro de borrar este pedido?',
    'method' => 'post',
  ],
  ]) ?>
</div>


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
      &nbsp;

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
    'formValues' => true,
  ]
]);
?>

<?php $attributes = [ [
        'group'=>true,
        // 'label'=>'Descripción del pedido',
        'rowOptions'=>['class'=>'info']
    ],
    [
        'columns' => [
            [
                'attribute'=>'id',
                'label'=>'Orden #',
            ],
            [
                'attribute'=>'size',

            ],
            [
                'attribute'=>'cheese_border',
                'value' => $model->cheese_border == '0' ? '' : 'Con Queso',
                'label' => $model->cheese_border == '0' ? '' : 'Orilla',

            ],
            [
                'attribute'=>'quantity',

            ],
            [
                'attribute'=>'ingredients',
                'valueColOptions'=>['style'=>'width:500px'],
            ],
        ],
    ],


    [
        'group'=>true,
        // 'label'=>'Costos  ',
        'rowOptions'=>['class'=>'info'],
        //'groupOptions'=>['class'=>'text-center']
    ],
    [
        'attribute'=>'subtotal',
        'label'=>'Precio ($)',
        'format'=>['decimal', 2],
        'inputContainer' => ['class'=>'col-sm-6'],
    ],
    [
        'attribute'=>'delivery',
        'label'=>'Envio ($)',
        'format'=>['decimal', 2],
        'inputContainer' => ['class'=>'col-sm-6'],
    ],
    [
        'attribute'=>'total',
        'label'=>'Total ($)',
        'format'=>['decimal', 2],
        'inputContainer' => ['class'=>'col-sm-6'],
        'rowOptions'=>['class'=>'warning kv-edit-hidden', 'style'=>'border-top: 5px double #dedede'],
    ],
    [
        'label'=>'Pago ($)',
        'attribute'=>'money',
        'format'=>['decimal', 2],
        'inputContainer' => ['class'=>'col-sm-6'],
        // hide this in edit mode by adding `kv-edit-hidden` CSS class
    ],
    [
        'label'=>'Cambio ($)',
        'attribute'=>'change',
        'format'=>['decimal', 2],
        'inputContainer' => ['class'=>'col-sm-6'],
        // hide this in edit mode by adding `kv-edit-hidden` CSS class
        // 'rowOptions'=>['class'=>'warning kv-edit-hidden', 'style'=>'border-top: 5px double #dedede'],
    ],


    [
        'group'=>true,
        // 'label'=>'Detalles',
        'rowOptions'=>['class'=>'info'],
        //'groupOptions'=>['class'=>'text-center']
    ],
    [
      'columns' => [
        [
          'attribute'=>'address',

        ],
        [
          'attribute'=>'phone',

        ],
      ]
    ],
    [
        'columns' => [
            [
                'attribute'=>'date',
                'format'=>'date',
                'type'=>DetailView::INPUT_DATE,
                'widgetOptions' => [
                    'pluginOptions'=>['format'=>'yyyy-mm-dd']
                ],
                'valueColOptions'=>['style'=>'width:30%']
            ],
            [
                'attribute'=>'time',
                'format'=>'time',
                'type'=>DetailView::INPUT_TIME,
                'widgetOptions' => [
                    'pluginOptions'=>['format'=>'H:m']
                ],
                'valueColOptions'=>['style'=>'width:30%']
            ],
             [
                  'attribute'=>'wait',
                  'format'=>'text',
                  'type'=>DetailView::INPUT_TIME,
                  'widgetOptions' => [
                      'pluginOptions'=>['format'=>'H:m']
                  ],
                  'valueColOptions'=>['style'=>'width:30%']
              ],
        ]
    ],

];?>

<div id="PrintThis">
    <?= DetailView::widget([
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


    </br>
  </br>

</div>
