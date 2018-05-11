<?php

  use yii\helpers\Url;
  use yii\helpers\Html;
  use yii\widgets\ActiveForm;
  use kartik\switchinput\SwitchInput;
  use kartik\select2\Select2;
  use kartik\time\TimePicker;
  use modernkernel\jnumber\JNumberInput;
  use yii\helpers\Json;
  use yii\db\Expression;
  use app\models\Dealer;

  $tituloexport = 'Agregar repartidor';
  $this->title = $tituloexport ?>
<?php  $request = Yii::$app->request;
  $model->telefono = $request->get('telefono');
  $model->nombre = $request->get('nombre');
  $model->salario = $request->get('salario');
  ?>
<div class="col-sm-12 col-md-12 col-xs-12 col-sm-12">
  <div class="row">
      <h1 class="text-center"><i class="fa fa-address-book-o" aria-hidden="true"></i>  <?php echo $tituloexport?></h1>
    </section>
  </div><hr>
</div>
<?php $form = ActiveForm::begin(['id' => 'order-form', 'class'=> "form-horizontal"]); ?>
  <div class="form-group">
    <div class="col-sm-6 col-md-offset-3"> 
    <?= $form->field($model, 'nombre')->textInput([
              'id' => "nombre",
              'maxlength' => 40,
              'minlength' => 5,
              'class'=>"form-control",
              'style' => 'text-transform: uppercase',
              'placeholder'=>'Ingrese el nombre completo']) ?>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-6 col-md-offset-3"> 
    <?= $form->field($model, 'telefono')->textInput([
              'id' => "telefono",
              'maxlength' => 13,
              'minlength' => 10,
              'class'=>"form-control",
              'style' => 'text-transform: uppercase',
              'placeholder'=>'Digite el numero de telefono']) ?>
    </div>
  </div>  
    <div class="form-group">
    <div class="col-sm-6 col-md-offset-3"> 
    <?= $form->field($model, 'salario')->textInput([
              'id' => "salario",
              'maxlength' => 3,
              'minlength' => 3,
              'class'=>"form-control",
              'style' => 'text-transform: uppercase',
              'placeholder'=>'Ingrese el sueldo del repartidor']) ?>
    </div>
  </div>
  <hr>

  <div class="form-group text-center"> 
    <div class="col-sm-12">
    <button type="reset" class="btn btn-warning btn-lg"><i class="fa fa-refresh" aria-hidden="true"></i> Restablecer</button>
    <?= Html::submitButton('Agregar', ['class' => 'btn btn-success btn-lg fa fa-check-square-o']) ?>

    </div>
  </div>
<?php ActiveForm::end(); ?>