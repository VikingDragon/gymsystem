<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\jui\DatePicker;

$this->title = 'Compras';
?>

<div>
	<h1><?= Html::encode($this->title) ?></h1>
	<div class="form">
      <?php $form = ActiveForm::begin(); ?>
      <div class="row">
      	<div class="col-md-3" style="padding-right:35px;">
          <label class="control-label" > Provedor </label>
          <?php
            echo AutoComplete::widget([
              'id'=>'autoProvedor',
              'value' => $compra->isNewRecord?'':$compra->provedorIdprovedor->nombre,
              'options'=>['class'=>'form-control'],
              'clientOptions' => [
                  'source' => new JsExpression("
                    function( request, response ) {
                        $.ajax({
                          url: '".Url::to(['provedor/get-provedor'])."',
                          dataType: 'json',
                          data: {
                            q: request.term
                          },
                          success: function( data ) {
                            response( jQuery.parseJSON(data) );
                          }
                        });
                      }"
                    ),
                    'autoFill'=>true,
                    'minLength'=>'3',
                    'select' => new JsExpression("function( event, ui ) {
                      $('#compra-provedor_idprovedor').val(ui.item.id);
                      variables['validoProvedor']=true;
                    }"),
              ],
              'clientEvents' => [
                'change' => "function () { 
                  if(!variables['validoProvedor']){
                    variables['validoProvedor']='';
                    $('#compra-provedor_idprovedor').val('');
                    $('#autoProvedor').val('');
                    popB('Advertencia', 'Provedor invalido', 'advertencia.jpg');
                  }
                  variables['validoProvedor']=false;
              }"
              ],
            ]);
          ?>
          <?= $form->field($compra, 'provedor_idprovedor')->hiddenInput()->label(false) ?>
        </div>
        <div class="col-md-2">
          <label class="control-label" > Producto </label>
          <?php
            echo AutoComplete::widget([
              'id'=>'autoArticulo',
              'options'=>['class'=>'form-control'],
              'clientOptions' => [
                  'source' => new JsExpression("
                    function( request, response ) {
                        $.ajax({
                          url: '".Url::to(['articulo/get-articulo'])."',
                          dataType: 'json',
                          data: {
                            q: request.term
                          },
                          success: function( data ) {
                            response( jQuery.parseJSON(data) );
                          }
                        });
                      }"
                    ),
                    'autoFill'=>true,
                    'minLength'=>'3',
                    'select' => new JsExpression("function( event, ui ) {
                      $('#lote-articulo_inventario_idinventario').val(ui.item.id);
                      variables['validoArticulo']=true;
                    }"),
              ],
              'clientEvents' => [
                'change' => "function () { 
                  if(!variables['validoArticulo']){
                    variables['validoArticulo']='';
                    $('#lote-articulo_inventario_idinventario').val('');
                    $('#autoArticulo').val('');
                    popB('Advertencia', 'Articulo invalido', 'advertencia.jpg');
                  }
                  variables['validoArticulo']=false;
              }"
              ],
            ]);
          ?>
          <?= $form->field($lote, 'articulo_inventario_idinventario')->hiddenInput()->label(false) ?>
        </div>
        <div class="col-md-1">
          <?= $form->field($lote, 'costo')->textInput() ?>
        </div>
        <div class="col-md-2">
          <?= $form->field($lote, 'cantidad')->textInput() ?>
        </div>

        <div class="col-md-2">
          <?= $form->field($lote, 'lote')->textInput() ?>
        </div>
        
        <div class="col-md-2">
          <?= $form->field($lote, 'caducidad')->widget(DatePicker::classname(), [
                'options'=>['style'=>'width:100%;', 'class'=>'form-control'],
                //'language' => 'ru',
                'clientOptions'=>['changeYear'=>true,'changeMonth'=>true,'maxDate'=>"+12y",'minDate'=>"-0y"],
                'dateFormat' => 'yyyy-MM-dd',
            ]) ?>
        </div>
        
      </div>

      <div class="row">
        <div class="col-md-6">
          <?= $form->field($detalleCompra, 'detalles')->textArea(['placeholder'=>'Comentarios']) ?>
        </div>
        
      </div>
      <div class="form-group">
          <?= Html::submitButton('Añadir', ['class' => 'btn btn-primary']) ?>
      </div>
      <?php ActiveForm::end(); ?>
      <div class="form-group">
          <div class="panel panel-primary" style="height:350px;">
            <div class="panel-heading"  >Productos añadidos</div>
              <table id="carrito" class="table table-bordered table-hover text-center" style="width:100%" >
                <tr class="active">
                  <th class="text-center" style="width:10%" >Codigo</th>
                  <th class="text-center" style="width:60%" >Producto</th>
                  <th class="text-center" style="width:10%" >Cantidad</th>
                  <th class="text-center" style="width:10%" >Precio</th>
                  <th class="text-center" style="width:10%">Total</th>
                </tr>
                <?php
                  foreach ($carrito as $index => $detalle) {
                    echo "<tr>";
                      echo "<td>".$detalle->loteIdlote->articulo_inventario_idinventario."</td>";
                      echo "<td>".$detalle->loteIdlote->inventarioIdinventario->nombre."</td>";
                      echo "<td>".$detalle->loteIdlote->cantidad."</td>";
                      echo "<td>$".$detalle->loteIdlote->costo."</td>";
                      echo "<td>$".($detalle->loteIdlote->costo*$detalle->loteIdlote->cantidad)."</td>";

                    echo "</tr>";
                  }
                ?>
              </table>
          </div>
          <div class="pull-right">
            <?php
              if(!$compra->isNewRecord){
                echo Html::a('Descartar', 
                  ['delete', 'id' => $compra->idcompra], 
                  [
                      'class' => 'btn-lg btn-danger',
                      'data' => [
                          'confirm' => '¿Continuar? Perderas todos los articulos que añadiste.',
                          'method' => 'post',
                    ],
                  ]);
                echo "&nbsp;";
                echo Html::a('Guardar', 
                  ['create', 'id' => $compra->idcompra], 
                  [
                    'class' => 'btn-lg btn-primary',
                    'data' => [
                        'confirm' => '¿Continuar? ya no podras editar esta compra',
                        'method' => 'post',
                    ],
                  ]);
              }else{
                echo Html::button('Descartar', ['class' => 'btn btn-danger', 'disabled'=>'disabled']);
                echo "&nbsp;";
                echo Html::button('Guardar', ['class' => 'btn btn-primary', 'disabled'=>'disabled']);
              }
            ?>
          </div>
        </div>
  </div>
</div>

<script type="text/javascript">
  variables=[];
</script>

<?php
  $this->registerJsFile(
      '@web/js/scripts.js',
      ['depends' => [\yii\web\JqueryAsset::className()]]
  );
?>

