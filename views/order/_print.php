<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\editable\Editable;
use yii\helpers\Url;
use kartik\mpdf\Pdf;

// $this->title= "Piccolinas Pizza"
?>
<?php
$response = Yii::$app->response;
$response->format = \yii\web\Response::FORMAT_RAW;?>
<div class="order-print">


    <h3 class="pull-right"><?= Html::encode($this->title) ?></h3>
<br>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
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
            // 'subtotal',
            // 'delivery',
            'total',
            'money',
            'change',
            // 'note',
            // 'status',
        ],
        'class' => ''
    ]) ?>

</div>
