<?php

use yii\helpers\Html;
$this->title = 'Crear orden';
// $this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>