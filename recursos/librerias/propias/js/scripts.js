function enviarPeticion(peticion, parametros, funcion)
{
	$.ajax({
		url:'/SmartTrader/nucleo/Enrutador.php?peticion='+peticion,
		method:'POST',
		dataType:'JSON',
		data:{
			parametros:parametros
		},
		success:function(respuesta){
			if (respuesta.tipo == 'redirect')
				window.location.href = respuesta.ruta;
			else
				funcion(respuesta);
		}
	});
}

function prepararFormulario(formulario)
{
	var datos = {};

	$.each($('#'+formulario).serializeArray(), function(i, val){
		datos[val['name']] = val['value'];
	});

	return datos;
}

function salir() {
	enviarPeticion('usuarios/salir', {'':''}, function(rta){
		if(rta.tipo == 'exito')
			window.location.href = rta.ruta;
	});
}

var ruta_tabla_esp = "/SmartTrader/recursos/librerias/datatables/DataTables-1.10.13/extensions/Language/Spanish.json";
var ruta_root = '/SmartTrader/';