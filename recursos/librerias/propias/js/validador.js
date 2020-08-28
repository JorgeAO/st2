/**
 * LIBRERÍA DE VALIDACIÓN DE CAMPOS DE LOS FORMULARIOS DESARROLLADOS BAJO EL FRAMEWORK BASE V6
 * AUTOR: JORGE ALEXIS AGUILAR OCAMPO
 * VERSIÓN: 1.0
 * FECHA: MIÉRCOLES 17 DE ENERO DE 2018
 * ---------------------------------------------------------------------------------------
 * ACTUALIZACIÓN: JUEVES 19 DE JULIO DE 2018
 * - Se incluye la validación para los tipos login y clave
 * - Se incluye la validación para evaluar el contenido de un campo si este existe y si no es obligatorio
 * ---------------------------------------------------------------------------------------
*/

function validarFormulario(formulario)
{
	// Obtener los campos del formulario
	var campos = $('#'+formulario).serializeArray();
	var frmValido = true; // Bandera para saber si el formulario es válido

	//console.info(campos);

	// Recorrer los campos del formulario
	//$.each(campos, function(i, val){
	$.each($('#'+formulario)[0], function(i, val){
		
		// Si el campo está marcado como requerido se inicia la validación
		if ($('#'+val.name)[0].dataset.req == 'true') 
		{
			var valido = true; // Bandera para saber si el campo es válido

			// Si no tiene un tipo definido y la longitud es menor que 1
			if ($('#'+val.name)[0].dataset.tipo == undefined && $('#'+val.name)[0].value.length < 1 || $('#'+val.name)[0].value == undefined)
			{
				$('#hlp_'+val.name).html('Éste campo es requerido');
				valido = false; // Se marca el campo como no válido
				frmValido = false; // Se marca el formulario como no váildo
				//continue;
			}
			// Si el campo es requerido y el tipo está definido
			else if ($('#'+val.name)[0].dataset.tipo != undefined)
			{
				// Se obtienen las características de la regla según el tipo de dato
				var regla = reglas[$('#'+val.name)[0].dataset.tipo];

				// Validar si el valor del campo NO cumple con la longitud mínima requerida
				if ($('#'+val.name)[0].value.length < regla.minlenght)
				{
					$('#hlp_'+val.name).html(regla.error_min); // Si no cumple, se pone el texto de error para lóngitud no válida
					valido = false; // Se marca el campo como no válido
					frmValido = false; // Se marca el formulario como no váildo
				}

				// Validar si el valor del campo NO cumple con la expresión regular requerida
				if (!regla.regex.test($('#'+val.name)[0].value))
				{
					$('#hlp_'+val.name).html(regla.error_rgx); // Si no cumple, se pone el mensaje de error
					valido = false; // Se marca el campo como no válido
					frmValido = false; // Se marca el formulario como no válido
				}
			}

			// Si el campo es váildo se quitan los mensajes de error
			if (valido) {
				$('#hlp_'+val.name).html(''); 
			}
		}
		// Si el campo no está marcado como requerido y no está vacío
		else if ($('#'+val.name)[0].dataset.req == undefined && $('#'+val.name)[0].value != null && $('#'+val.name)[0].value.length > 0)
		{
			if ($('#'+val.name)[0].dataset.tipo != undefined)
			{
				var valido = true; // Bandera para saber si el campo es válido
				
				// Se obtienen las características de la regla según el tipo de dato
				var regla = reglas[$('#'+val.name)[0].dataset.tipo];

				// Validar si el valor del campo NO cumple con la longitud mínima requerida
				if ($('#'+val.name)[0].value.length < regla.minlenght)
				{
					$('#hlp_'+val.name).html(regla.error_min); // Si no cumple, se pone el texto de error para lóngitud no válida
					valido = false; // Se marca el campo como no válido
					frmValido = false; // Se marca el formulario como no váildo
				}

				// Validar si el valor del campo NO cumple con la expresión regular requerida
				if (!regla.regex.test($('#'+val.name)[0].value))
				{
					$('#hlp_'+val.name).html(regla.error_rgx); // Si no cumple, se pone el mensaje de error
					valido = false; // Se marca el campo como no válido
					frmValido = false; // Se marca el formulario como no válido
				}

				// Si el campo es váildo se quitan los mensajes de error
				if (valido)
					$('#hlp_'+val.name).html(''); 
			}	
		}
	});

	return frmValido;
}

function validarCampo(campo)
{
	var campoValido = true; // Bandera para saber si el formulario es válido

		// Si el campo está marcado como requerido se inicia la validación
		if ($('#'+campo)[0].dataset.req == 'true') 
		{
			var valido = true; // Bandera para saber si el campo es válido

			// Si no tiene un tipo definido y la longitud es menor que 1
			if ($('#'+campo)[0].dataset.tipo == undefined && $('#'+campo)[0].value.length < 1 || $('#'+campo)[0].value == undefined)
			{
				$('#hlp_'+campo).html('Éste campo es requerido');
				valido = false; // Se marca el campo como no válido
				campoValido = false; // Se marca el formulario como no váildo
				//continue;
			}
			// Si el campo es requerido y el tipo está definido
			else if ($('#'+campo)[0].dataset.tipo != undefined)
			{
				// Se obtienen las características de la regla según el tipo de dato
				var regla = reglas[$('#'+campo)[0].dataset.tipo];

				// Validar si el valor del campo NO cumple con la longitud mínima requerida
				if ($('#'+campo)[0].value.length < regla.minlenght)
				{
					$('#hlp_'+campo).html(regla.error_min); // Si no cumple, se pone el texto de error para lóngitud no válida
					valido = false; // Se marca el campo como no válido
					campoValido = false; // Se marca el formulario como no váildo
				}

				// Validar si el valor del campo NO cumple con la expresión regular requerida
				if (!regla.regex.test($('#'+campo)[0].value))
				{
					$('#hlp_'+campo).html(regla.error_rgx); // Si no cumple, se pone el mensaje de error
					valido = false; // Se marca el campo como no válido
					campoValido = false; // Se marca el formulario como no válido
				}
			}

			// Si el campo es váildo se quitan los mensajes de error
			if (valido) {
				$('#hlp_'+campo).html(''); 
			}
		}
		// Si el campo no está marcado como requerido y no está vacío
		else if ($('#'+campo)[0].dataset.req == undefined && $('#'+campo)[0].value != null && $('#'+campo)[0].value.length > 0)
		{
			if ($('#'+campo)[0].dataset.tipo != undefined)
			{
				var valido = true; // Bandera para saber si el campo es válido
				
				// Se obtienen las características de la regla según el tipo de dato
				var regla = reglas[$('#'+campo)[0].dataset.tipo];

				// Validar si el valor del campo NO cumple con la longitud mínima requerida
				if ($('#'+campo)[0].value.length < regla.minlenght)
				{
					$('#hlp_'+campo).html(regla.error_min); // Si no cumple, se pone el texto de error para lóngitud no válida
					valido = false; // Se marca el campo como no válido
					campoValido = false; // Se marca el formulario como no váildo
				}

				// Validar si el valor del campo NO cumple con la expresión regular requerida
				if (!regla.regex.test($('#'+campo)[0].value))
				{
					$('#hlp_'+campo).html(regla.error_rgx); // Si no cumple, se pone el mensaje de error
					valido = false; // Se marca el campo como no válido
					campoValido = false; // Se marca el formulario como no válido
				}

				// Si el campo es váildo se quitan los mensajes de error
				if (valido)
					$('#hlp_'+campo).html(''); 
			}	
		}

	return campoValido;
}

var reglas = new Array;

reglas['texto'] = {
	regex:/^([A-Za-z\ \-\,\á\é\í\ó\ú\Á\É\Í\Ó\Ú\ñ\Ñ\.])*$/,
	minlenght: 3,
	error_min:'El campo debe contener mínimo 3 caracteres',
	error_rgx:'El campo solo puede contener letras'
};

reglas['alfanumerico'] = {
	regex:/^([A-Za-z0-9])/,
	minlenght: 3,
	error_min:'El campo debe contener mínimo 3 caracteres',
	error_rgx:'El campo solo puede contener letras y números'
};

reglas['direccion'] = {
	regex:/^([A-Za-z0-9 \s \#\-\,\á\é\í\ó\ú\Á\É\Í\Ó\Ú\ñ\Ñ\.])/,
	minlenght: 3,
	error_min:'El campo debe contener mínimo 3 caracteres',
	error_rgx:'El campo solo puede contener letras y números'
};

reglas['numeros'] = {
	regex:/^([0-9])*$/,
	minlenght: 1,
	error_min:'El campo debe contener mínimo 2 caracter',
	error_rgx:'El campo solo puede contener números'
};

reglas['celular'] = {
	regex: /^([0-9])*$/,
	minlenght: 10,
	error_min: 'Debe contener mínimo 10 caracteres',
	error_rgx: 'El campo solo puede contener números'
}

reglas['correo'] = {
	regex:/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i,
	minlenght:7,
	error_min:'Debe contener mínimo 7 caracteres',
	error_rgx:'El dato no corresponde a un correo electrónico'
}

reglas['login'] = {
	regex:/^([A-Za-z\-\.])*$/,
	minlenght: 3,
	error_min:'El campo debe contener mínimo 3 caracteres',
	error_rgx:'El campo solo puede contener letras, guion y punto'
};

reglas['clave'] = {
	regex:/^([A-Za-z0-9\-\.])/,
	minlenght: 3,
	error_min:'El campo debe contener mínimo 3 caracteres',
	error_rgx:'El campo solo puede contener letras, números, guion y punto'
};