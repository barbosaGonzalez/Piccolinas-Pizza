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
  	use app\models\Order;
	use app\models\OrderSearch;

 $tituloexport = 'Registrar egreso';
  $this->title = $tituloexport;
	$request = Yii::$app->request;
  $model->phone = $request->get('phone');
  $model->address = $request->get('address');
  $model->neighborhood = $request->get('neighborhood');
  $model->delivery = $request->get('delivery');
  $model->size = $request->get('size');
  $model->ingredients = $request->get('ingredients');
  $model->description = $request->get('description');
  $model->soda_quantity = $request->get('soda_quantity');
  $model->soda_type = $request->get('soda_type');
  $model->soda_size = $request->get('soda_size');
  $model->quantity = $request->get('quantity');
  $model->cheese_border = $request->get('cheese_border');
  $model->money = $request->get('money');
  $model->change = $request->get('change');
  $model->subtotal = $request->get('subtotal');
  $model->total = $request->get('total');
  $model->wait = $request->get('wait');
  $model->count = $request->get('count');
  $expression = new Expression('NOW()');
		    $now = (new \yii\db\Query)->select($expression)->scalar();
		    $now = substr($now, 0, 10);
	$itemsnow =  OrderSearch::find()->andFilterWhere(['like', 'date', $now])->count();

	$count = $itemsnow + 1;
	$form = ActiveForm::begin(['id' => 'order-form']); ?>

<div class="col-sm-12 col-md-12 col-xs-12 col-sm-12 text-center">
	<div class="row">
		<h1><i class="fa fa-balance-scale" aria-hidden="true"></i> Administración de la Caja</h1>
	</div><hr>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 col-sm-12 text-center">
		<div class="row">
			<section class="col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3">
				<?= $form->field($model, 'count')->textinput()->hiddenInput(['value' =>$count])->label(false)?>
				<?= $form->field($model, 'time')->widget(TimePicker::classname(), [
                    'readonly' => false,
                    'disabled' => false,
                    'pluginOptions' => [
                      'defaultTime' => 'current',
                      // 'format' => 'H:mm',
                      'minuteStep' => 1,
                      'showMeridian' => false,
                    ],
                  ])->hiddenInput()->label(false);?>
                  <?= $form->field($model, 'time_arrive')->widget(TimePicker::classname(), [
                    'readonly' => false,
                    'disabled' => false,
                    'pluginOptions' => [
                      'defaultTime' => 'current',
                      // 'format' => 'H:mm',
                      'minuteStep' => 1,
                      'showMeridian' => false,
                    ],
                  ])->hiddenInput()->label(false);?>
                  <?= $form->field($model, 'time_leave')->widget(TimePicker::classname(), [
                    'readonly' => false,
                    'disabled' => false,
                    'pluginOptions' => [
                      'defaultTime' => 'current',
                      // 'format' => 'H:mm',
                      'minuteStep' => 1,
                      'showMeridian' => false,
                    ],
                  ])->hiddenInput()->label(false);?>
	    		<?= $form->field($model, 'only_date')->textInput()->hiddenInput(['value' => $now])->label(false); ?>
	    		<?= $form->field($model, 'status')->textInput()->hiddenInput(['value'=> '1'])->label(false); ?>
	    		<?= $form->field($model, 'phone')->textInput()->hiddenInput(['value'=> '(312)3081818'])->label(false); ?>
			    <?= $form->field($model, 'wait')->textInput()->hiddenInput(['value'=> '00-00'])->label(false); ?>
			    <?= $form->field($model, 'address')->textInput()->hiddenInput(['value'=> 'AV. NIÑOS HEROES'])->label(false); ?>
			    <?= $form->field($model, 'neighborhood')->textInput()->hiddenInput(['value'=> 'LOMAS DEL CENTENARIO'])->label(false); ?>
			    <?= $form->field($model, 'cheese_border')->textInput()->hiddenInput(['value'=> '0'])->label(false); ?>
			    <?= $form->field($model, 'ingredients')->textInput()->hiddenInput(['value'=> 'S/N'])->label(false); ?>
			    <?= $form->field($model, 'delivery')->textInput()->hiddenInput(['value'=> '0'])->label(false); ?>
			    <?= $form->field($model, 'subtotal')->textInput()->hiddenInput(['value'=> '0'])->label(false); ?>
			    <?= $form->field($model, 'change')->textInput()->hiddenInput(['value'=> '0'])->label(false); ?>
			    <?= $form->field($model, 'money')->textInput()->hiddenInput(['value'=> '0'])->label(false); ?>
			    <?= $form->field($model, 'quantity')->textInput()->hiddenInput(['value'=> '0'])->label(false); ?>
			    <?= $form->field($model, 'soda_quantity')->textInput()->hiddenInput(['value'=> '0'])->label(false); ?>
			    <?= $form->field($model, 'done')->textInput()->hiddenInput(['value'=> '0'])->label(false); ?>
			</section>
		<div class="row">
			<section class="col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3">
				<?= $form->field($model, 'size')
	            ->textArea([
	              'placeholder'=>'Escribe un motivo para retirar',
	              'class' => 'form-control',
	              'style' => 'text-transform: uppercase'],
	              array('maxlength' => 255, 'rows' => 3))
	            ->label('Motivo para retirar');?>
			</section>
		</div>
		<div class="row">
				<section class="col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3">
					<?= $form->field($model, 'total')->textInput([
              			'placeholder'=>'INGRESA EL MONTO QUE DESEES RETIRAR', 'min'=>'1', 'type'=>'number', 'id' => "total", 'class' => 'form-control'])->label('Monto para retirar'); ?>
				</section>
		</div><hr>
</div>
</div>

  <div class="form-group text-center"> 
    <div class="col-sm-12">
	  <button type="reset" class="btn btn-warning btn-lg"><i class="fa fa-refresh" aria-hidden="true"></i> Restablecer</button>
      <?= Html::submitButton('Agregar', ['class' => 'btn btn-success btn-lg fa fa-check-square-o']) ?>
    </div>
  </div>
<?php ActiveForm::end(); ?>