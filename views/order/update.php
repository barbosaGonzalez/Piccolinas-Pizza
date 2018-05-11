<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = 'Modificar Orden: ' . $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-update">
<p>
    <h3 class="pull-right"><?= Html::encode($this->title) ?></h3>
</p>
<br>
</br>
<br/>
&nbsp;
<p>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</p>
</div>
