<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\jui\DatePicker;

$this->title = 'Caja';
?>

<div>
	<h1><?= Html::encode($this->title) ?></h1>
	<div class="form">
      <?php $form = ActiveForm::begin(); ?>
      <div class="row">
      	<div class="col-md-3" style="padding-right:35px;">
          <label class="control-label" > Cliente </label>
          <?php
            echo AutoComplete::widget([
              'id'=>'autoProvedor',
              'value' => $venta->isNewRecord?'':$venta->clienteIdcliente->nombre,
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
          <?= $form->field($venta, 'cliente_idcliente')->textInput()->label(false) ?>
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
                      $('#detalleventa-inventario_idinventario').val(ui.item.id);
                      variables['validoArticulo']=true;
                    }"),
              ],
              'clientEvents' => [
                'change' => "function () { 
                  if(!variables['validoArticulo']){
                    variables['validoArticulo']='';
                    $('#detalleventa-inventario_idinventario').val('');
                    $('#autoArticulo').val('');
                    popB('Advertencia', 'Articulo invalido', 'advertencia.jpg');
                  }
                  variables['validoArticulo']=false;
              }"
              ],
            ]);
          ?>
          <?= $form->field($detalleVenta, 'inventario_idinventario')->textInput()->label(false) ?>
        </div>
        <div class="col-md-2">
          <?= $form->field($detalleVenta, 'cantidad')->textInput() ?>
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
                      //echo "<td>".$detalle->loteIdlote->articulo_inventario_idinventario."</td>";
                      //echo "<td>".$detalle->loteIdlote->inventarioIdinventario->nombre."</td>";
                      //echo "<td>".$detalle->loteIdlote->cantidad."</td>";
                      //echo "<td>$".$detalle->loteIdlote->costo."</td>";
                      //echo "<td>$".($detalle->loteIdlote->costo*$detalle->loteIdlote->cantidad)."</td>";
                    echo "</tr>";
                  }
                ?>
              </table>
          </div>
          <div class="pull-right">
            <?php
              if(!$venta->isNewRecord){
                echo Html::a('Descartar', 
                  ['delete', 'id' => $venta->idventa], 
                  [
                      'class' => 'btn-lg btn-danger',
                      'data' => [
                          'confirm' => '¿Continuar? Perderas todos los articulos que añadiste.',
                          'method' => 'post',
                    ],
                  ]);
                echo "&nbsp;";
                echo Html::a('Guardar', 
                  ['create', 'id' => $venta->idventa], 
                  [
                    'class' => 'btn-lg btn-primary',
                    'data' => [
                        'confirm' => '¿Continuar? ya no podras editar esta venta',
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
