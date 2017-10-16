$("#autoCaja").on("keypress",function(e){
	if(e.which == 13) {
		if($(this).val()==""){
			$("#modalHeaderTitle").html('<h3>Advertencia</h3>');
			$("#modalContent").html('<h2><img width="100" src="../images/advertencia.jpg" /> ¡Selecciona un producto! </h2>');
			$('#modal').modal('show');
			}else{
				addProducto();
			}
	}
});

var caja=[];

function addProducto(){
	$.ajax({
		url: '../inventario/get-detalle',
			dataType: 'json',
			data: {
				id: variables['idProdcto'],
				cant: $("#cantP").val()
			},
			success: function( data ) {
				json = JSON.parse(data);
				var nuevoProducto=true;
				for (var i = 0; i < caja.length; i++) {
					if(caja[i]["id"]==json.id){
						caja[i]["cantidad"]=parseInt(json.cantidad)+parseInt(caja[i]["cantidad"]);
						caja[i]["total"]+=json.cantidad*json.precio;
						$("#total").html((parseFloat($("#total").html()))+parseFloat(json.total));
						$("#totalito").html((parseFloat($("#totalito").html()))+parseFloat(json.total));
						$("#"+json.id).html(caja[i]["cantidad"]);
						$("#"+json.id+"-").html(caja[i]["total"]);
						nuevoProducto=false;
						break;
					}
				}
				if(nuevoProducto){
					var tabla = $('#tablaCaja > tbody:last-child');
					var tr = "";
					tr+=("<tr>");
					tr+=("<td>"+json.id+"</td>");
					tr+=("<td>"+json.nombre+"</td>");
					tr+=("<td>$"+json.precio+"</td>");
					tr+=("<td id='"+json.id+"'>"+json.cantidad+"</td>");
					tr+=("<td id='"+json.id+"-'>"+json.total+"</td>");
					tr+=("</tr>");
					$("#total").html((parseFloat($("#total").html()))+parseFloat(json.total));
					$("#totalito").html((parseFloat($("#totalito").html()))+parseFloat(json.total));
					tabla.append(tr);
					caja.push(json);
				}
			}
	});
}

function calcularc(){
	$("#cambio").html(parseFloat($("#dinero").val())-parseFloat($("#totalito").html()));
}

function enviar(){
	if(caja.length<1){
		popB('Error','Debes añadir almenos 1 producto','error.jpg')
		return false;
	}

	$('#modal3').modal('show');
}

function comprar(){
	$('#modal3').modal('hide');
	$.ajax({
		url: '../venta/compra',
		data: {
			id: variables['idCliente'],
			productos: caja,
		},
		success: function( data ) {
			if(data!="ok"){
				popA('Advertencia',data,'advertencia.jpg')
			}else{
				$("#modal-footer").html('<button onclick="location.reload()" type="button" class="btn btn-lg btn-primary">Aceptar</button>');
				$("#modal-footer").addClass("modal-footer");
				popA('Correcto','Compra Exitosa','correcto.png')
				$('.close').hide();
			}
		}
	});
}
function popA(titulo,cuerpo,imagen){
	$('#modalHeaderTitle').html('<h3>'+titulo+'</h3>');
	$('#modalContent').html('<h2>'+(imagen!='0'?'<img src="../images/'+imagen+'" />'+cuerpo:cuerpo)+'</h2>');
	$('#modal').modal('show');
}

function popB(titulo,cuerpo,imagen){
	$('#modalHeaderTitle2').html('<h3>'+titulo+'</h3>');
	$('#modalContent2').html('<h2>'+(imagen!='0'?'<img src="../images/'+imagen+'" />'+cuerpo:cuerpo)+'</h2>');
	$('#modal2').modal('show');
}

$("#formCal").on("submit",function(){
	var imc =  $("#peso").val()/($("#altura").val()/100*$("#altura").val()/100);
	imc = imc.toFixed(2);
	var nota = "";
	$("#imc").html(imc);
	//imc = parseInt(imc);

	if(imc<18.5){
		nota = "Peso inferior al normal";
	}else if(imc>=18.5&&imc<=24.9){
		nota = "Normal";
	}else if(imc>=25&&imc<=29.9){
		nota = "Peso superior al normal";
	}else{
		nota = "Obesidad";
	}

	$("#nota").html(nota);

	$.ajax({
		url: '../avance/create',
		data: {
			peso: $("#peso").val(),
		},
		success: function( data ) {
		}
	});
	return false;
});