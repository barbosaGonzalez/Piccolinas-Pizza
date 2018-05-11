<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'phone') ?>

    <?= $form->field($model, 'wait') ?>

    <?= $form->field($model, 'time') ?>

    <?= $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'neighborhood') ?>

    <?php // echo $form->field($model, 'cheese_border') ?>

    <?php // echo $form->field($model, 'ingredients') ?>

    <?php // echo $form->field($model, 'subtotal') ?>

    <?php // echo $form->field($model, 'delivery') ?>

    <?php // echo $form->field($model, 'money') ?>

    <?php // echo $form->field($model, 'change') ?>

    <?php // echo $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
