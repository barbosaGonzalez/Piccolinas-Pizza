<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use kartik\select2\Select2;
use kartik\time\TimePicker;
use modernkernel\jnumber\JNumberInput;
use yii\helpers\Json;
use yii\db\Expression;
use kartik\date\DatePicker;
use app\models\Order;
use app\models\OrderSearch;

?>
<div class="order-form">
  <?php $request = Yii::$app->request;
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
  ?>
  <?php $this->registerJs('$("form input:checkbox, form checkbox").first().focus();');?>
  <?php
          $expression = new Expression('NOW()');
            $now = (new \yii\db\Query)->select($expression)->scalar();
            $now = substr($now, 0, 10);
            $itemsnow =  OrderSearch::find()->andFilterWhere(['like', 'date', $now])->count();

            $count = $itemsnow + 1;?>
    <?php $form = ActiveForm::begin(['id' => 'order-form']); ?>

    <h3 class="pull-left">Nueva orden # <?php echo $count?></h3>
      <br><br><hr class="style5">
        <div class="form-group">
            <div >
                <?= $form->field($model, 'count')
                ->textinput()
                ->hiddenInput(['value' =>$count])
                ->label(false)?>
            </div>
              <table>
                  <tr>
                      <td class="col-md-1">
                      <?= $form->field($model, 'cheese_border')
                      ->textInput()->textArea()
                      ->label(false)
                      ->widget(SwitchInput::classname(), [
                         'value' => -1,
                         'options' => [ 'id' => 'cheese_border'],
                         'pluginOptions' => [
                            'handleWidth'=>120,
                            // 'animate' => true,
                            'onText'=>'Orilla con queso',
                            'offText'=>'Orilla sin queso',
                            'size' => 'medium',
                          ],
                        ]); ?>
          </td>
          <td class="col-md-3">
            <?= $form->field($model, 'size')
            ->textInput([
              'placeholder'=>'Escribe un producto',
              'style' => 'text-transform: uppercase'])
            ->label('Producto');?>

          </td>
          <td class="col-md-1">
            <?= $form->field($model, 'quantity' )
            ->textInput(['type' => 'number',
              'value'=>'1',
              'min' => 1,
              'id' => "quantity"])
            ->label('Cantidad') ?>
          </td>
          <td class="col-md-1">
            <?= $form->field($model, 'subtotal')
            ->textInput([
              'placeholder'=>'COSTO',
              'id' => "cost"])
            ->label('Costo') ?>
          </td>
      </tr>
      
    </table>
<table>
      <tr>
        <td class="col-md-1">
          <?= $form->field($model, 'ingredients')
          ->textInput([
            'placeholder'=>'Escribe ingredientes',
            'style' => 'text-transform: uppercase'])
          ->label('Ingredientes');?>
        </td>
      </tr>
    </table>
    <table>
      <tr>
        <td class="col-md-1">
          <?= $form->field($model, 'description')
          ->textInput([
            'placeholder'=>'Escribe observaciones',
            'style' => 'text-transform: uppercase'])
          ->label('Observaciones');?>
        </td>
      </tr>
    </table>
    <table>
      <tr>
          <td class="col-md-2">
            <?= $form->field($model, 'soda_quantity')
            ->textInput([
              'value'=>'0',
              'id' => "soda_quantity"]) ?>
          </td>
          <td class="col-md-6">
            <?= $form->field($model, 'soda_type')
            ->dropdownList([
              0 => 'SELECCIONA UNA OPCIÓN',
              1 => 'COCA COLA 400mls', 
              2 => 'MANZANITA 1.5lts',
              3 => 'JARRITO',
              4 => 'SPRITE',
            ],
            [
            'disabled' => true,
            'id' => "soda_type"]) ?>
          </td>          
      </tr>
    </table>
    <table>
      <tr>
          <td class="col-md-2">
            <?= $form->field($model, 'phone')->textInput([
              'id' => "phone",
              'maxlength' => 13,
              'placeholder'=>'TELÉFONO CELULAR']) ?>
          </td>
          <td class="col-md-3">
            <?= $form->field($model, 'address')->textInput([
              'maxlength' => true,
              'placeholder'=>'ESCRIBE UNA DESCRIPCIÓN',
              'style' => 'text-transform: uppercase']) ?>
          </td>
          <td class="col-md-3">
            <?= $form->field($model, 'neighborhood')->textInput([
            'maxlength' => true, 
            'placeholder'=>'ESCRIBE UNA COLONIA', 
            'style' => 'text-transform: uppercase']) ?>
          </td>
          
      </tr>
    </table>

    <table>
      <tr class="col-md-13">

        <td class="col-md-1">
          <?= $form->field($model, 'delivery')->textInput([
            'placeholder'=>'ENVIO',
            'id' => "delivery", 'type' => 'number']) ?>
        </td>

        <td class="col-md-1">
            <?= $form->field($model, 'total')->textInput([
              'placeholder'=>'AUTO', 'id' => "total", 'disabled' => false, 'readOnly' => true]) ?>
        </td>

        <td class="col-md-1">
          <?= $form->field($model, 'money')->textInput(['placeholder'=>'PAGO', 'id' => "pay", 'type' => 'number']) ?>
        </td>
        <td class="col-md-1">
        <?= $form->field($model, 'change')->textInput(['placeholder'=>'CAMBIO', 'id' => "change", 'disabled' => false, 'readOnly' => true]) ?>
        <!-- <?= $form->field($model, 'change')->widget(JNumberInput::className(), ['scale'=>2]) ?> -->
        </td>
        <td class="col-md-1">

              <?= $form->field($model, 'note')->widget(TimePicker::classname(), [
                // 'value' => time(),

                // 'type' => 4,
                'readonly' => true,
                'disabled' => true,
                'size' => 'md',
                'pluginOptions' => [
                  'defaultTime' => 'current',
                  // 'format' => 'H:mm',
                  'minuteStep' => 1,
                  'showMeridian' => false,
                ],

              ]);?>
                <div style="display:none">
                  <?= $form->field($model, 'time')->widget(TimePicker::classname(), [

                    'readonly' => false,
                    'disabled' => false,
                    'pluginOptions' => [
                      'defaultTime' => 'current',
                      // 'format' => 'H:mm',
                      'minuteStep' => 1,
                      'showMeridian' => false,
                    ],

                  ]);?>
                </div>
        </td>
        <td class="col-md-1">
            <?= $form->field($model, 'wait')->textInput(['placeholder'=>'MINUTOS', 'id' => "wait", 'type' => 'number']) ?>
        </td>
      </tr>
    </table>
    <?php
    $expression = new Expression('NOW()');
    $now = (new \yii\db\Query)->select($expression)->scalar();
    $now = substr($now, 0, 10);
    ?>
    <?= $form->field($model, 'only_date')->textInput()->hiddenInput(['value' => $now])->label(false); ?>

    <!-- <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'status')->textInput()->hiddenInput(['value'=> '0'])->label(false); ?>
<div class="col-md-12">
  <div class="row">
  <div class="col-md-5 col-md-offset-2">
      <button type="reset" class="btn btn-danger" style="width: 320px; border-radius: 10px;"><i class="glyphicon glyphicon-repeat"></i> Restablecer información</button>
    </div>
    <div class="col-md-5">

      <?= Html::submitButton($model->isNewRecord ? '&nbsp;Ordenar' : 'Guardar Modificación', ['class' => $model->isNewRecord ? 'btn btn-success glyphicon glyphicon-saved' : 'btn btn-primary', 'style' => 'width: 320px; border-radius: 10px;']) ?>
    </div>
    &nbsp;
    <!-- <td class="col-md-1"> -->
    <!-- <?= Html::submitButton('Borrar', ['class' => 'btn btn-danger']) ?> -->
    <!-- </td>  -->

  </div>
</div>
</div>
    <?php ActiveForm::end(); ?>
</div>

<?php
$script = <<<EOD
$(function() {
     $('#quantity').keyup(function() {
        updateTotal();
        updateChange();
      });
    $('#cost').keyup(function() {
       updateTotal();
       updateChange();
     });

      $('#soda_quantity').keyup(function() {
        enableDisableSelects();
        updateTotal();
        updateChange();
      });
    $('#soda_size').keyup(function() {
       updateTotal();
       updateChange();
     });

    $('#delivery').keyup(function() {
        updateTotal();
        updateChange();
      });
    $('#pay').keyup(function() {
        updateChange();
      });
    $('#total').keyup(function() {
        updateChange();
      });
    $('#phone').keypress(function(){
      return (isNaN(event.key)) ? false : event.key;
    });

    var updateTotal = function() {
      var costo_pizza = parseInt($('#cost').val());
      var precio_envio = parseInt($('#delivery').val());
      var cantidad_pizzas = parseInt($('#quantity').val());

      var cantidad_refresco = parseInt($('#soda_quantity').val());
      var tamano_refresco = parseInt($('#soda_size').val());
      var precio_refresco = 0;

      var total = parseInt($('#total').val());

      if(tamano_refresco == 1){
        precio_refresco = 15;
      } else if(tamano_refresco == 2){
        precio_refresco = 25;
      }

      if(isNaN(costo_pizza)){
        costo_pizza = 0;
      }

      if(isNaN(cantidad_refresco)){
        cantidad_refresco = 0;
      }

      if(isNaN(precio_envio)){
        precio_envio = 0;
      }

      if(isNaN(total)){
        $('#total').val((precio_refresco * cantidad_refresco) + (costo_pizza * cantidad_pizzas) + precio_envio);
      } else {
        $('#total').val((precio_refresco * cantidad_refresco) + (costo_pizza * cantidad_pizzas) + precio_envio);
      }
      
    };

    var updateChange = function() {
      var total = parseInt($('#total').val());
      var pay = parseInt($('#pay').val());
      var change = pay - total;
      var nothing = 0;

      if ((change < 0) || (isNaN(change))){
        $('#change').val('?')
      }
      else{
        $('#change').val(change);

      }
    }

    var enableDisableSelects = function() {
      debugger
      var cantidad_refresco = parseInt($('#soda_quantity').val());
      if(cantidad_refresco >= 1 && !isNaN(cantidad_refresco)){
        $('#soda_size').removeAttr('disabled');
        $('#soda_type').removeAttr('disabled');
      } else {
        $('#soda_type').attr({
          'disabled': 'true'
        });
        $('#soda_size').attr({
          'disabled': 'true'
        });
      }
    }
 });
EOD;
$this->registerJs($script);
?>