<script type="text/javascript" src="../recursos/librerias/jquery/jquery-3.2.0.min.js"></script>
<script type="text/javascript" src="../recursos/librerias/propias/js/scripts.js"></script>
<script type="text/javascript" src="../recursos/librerias/propias/js/validador.js"></script>
<script type="text/javascript" src="../recursos/librerias/bootstrap/bootstrap-4.1.2/js/bootstrap.min.js"></script>
<script src="../recursos/librerias/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script src="../recursos/librerias/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

<link rel="stylesheet" type="text/css" href="../recursos/librerias/bootstrap/bootstrap-4.1.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../recursos/librerias/fontawesome/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../recursos/librerias/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.css">
<link rel="stylesheet" type="text/css" href="../recursos/librerias/propias/css/estilos.css">

<script type="text/javascript">
	$(document).ready(function(){
		$('#btn_aceptar').on('click', function(){
			if (validarFormulario('frm_upd'))
			{
				if ($('#usua_clave').val() != $('#repetir_clave').val())
					alert('Las contraseñas no coinciden')
				else
					enviarPeticion('usuarios/clave',
						prepararFormulario('frm_upd'), 
						function(rta){
							alert(rta.mensaje);
							if (rta.tipo == 'exito')
								window.location.href = 'cambiarClave';
						}
					);
			}
		});
	});
</script>

<? require '../seguridad/Menu.php'; ?>

<div class="col-sm-12">
	<div class="card">
		<div class="card-header bg-dark text-white">Cambiar Clave</div>
		<div class="card-body">
			<form id="frm_upd">
				<div class="row">
					<div class="form-group col-sm-4">
						<label>Clave Actual</label>
						<input type="password" class="form-control form-control-sm" name="clave_actual" id="clave_actual" placeholder="Clave Actual" data-tipo="clave" data-req="true">
						<label id="hlp_clave_actual" class="texto-error"></label>
					</div>
					<div class="form-group col-sm-4">
						<label>Clave Nueva</label>
						<input type="password" class="form-control form-control-sm" name="usua_clave" id="usua_clave" placeholder="Clave Nueva" data-tipo="clave" data-req="true">
						<label id="hlp_usua_clave" class="texto-error"></label>
					</div>
					<div class="form-group col-sm-4">
						<label>Repetir Clave Nueva</label>
						<input type="password" class="form-control form-control-sm" name="repetir_clave" id="repetir_clave" placeholder="Repetir Clave Nueva" data-tipo="clave" data-req="true">
						<label id="hlp_repetir_clave" class="texto-error"></label>
					</div>
				</div>
			</form>
		</div>
		<div class="card-footer">
			<button class="btn btn-success btn-sm" id="btn_aceptar">Aceptar</button>
		</div>
	</div>
</div>