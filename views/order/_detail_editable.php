<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use app\models\Order;


$this->title = 'Orden ' . $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h3 class="pull-right"><?= Html::encode($this->title) ?></h3>
<br>

</br>
</br>
    <p>
      <?php $form = ActiveForm::begin(); ?>

      <div class="form-group">

        <?= $form->field($model, 'status', ['options' => ['value'=> 'Cocinando'] ])->hiddenInput()->label(false); ?>

        <?= Html::submitButton('<b>Cocinar</b>', ['class' => 'btn btn-success', 'style' => 'width: 320px; border-radius: 10px;']) ?>
      </div>
      <?php ActiveForm::end(); ?>

    </p>


</div>
