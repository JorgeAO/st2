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
		enviarPeticion('perfiles/listar',
			{ '':'' }, 
			function(rta){
				$.each(rta.datos, function(i, val){
					$('#fk_seg_perfiles').append('<option value="'+val['perf_codigo']+'">'+val['perf_codigo']+' - '+val['perf_descripcion']+'</option>');
				});
			}
		);

		$('#btn_aceptar').on('click', function(){
			if (validarFormulario('frm_add'))
			{
				if ($('#usua_clave').val() != $('#repetir_clave').val())
					alert('Las contraseñas no coinciden')
				else
					enviarPeticion('usuarios/insertar',
						prepararFormulario('frm_add'), 
						function(rta){
							alert(rta.mensaje);
							if (rta.tipo == 'exito')
								window.location.href = 'usuarios';
						}
					);
			}
		});
	});
</script>

<? require '../seguridad/Menu.php'; ?>

<div class="col-sm-12">
	<div class="card">
		<div class="card-header bg-dark text-white">Agregar Usuario</div>
		<div class="card-body">
			<form id="frm_add">
				<div class="row">
					<div class="form-group col-sm-3">
						<label>Nombre</label>
						<input type="text" class="form-control form-control-sm" name="usua_nombre" id="usua_nombre" placeholder="Nombre" data-tipo="texto" data-req="true">
						<label id="hlp_usua_nombre" class="texto-error"></label>
					</div>
					<div class="form-group col-sm-3">
						<label>Correo Electrónico</label>
						<input type="text" class="form-control form-control-sm" name="usua_mail" id="usua_mail" placeholder="Correo Electrónico" data-tipo="correo" data-req="true">
						<label id="hlp_usua_mail" class="texto-error"></label>
					</div>
					<div class="form-group col-sm-3">
						<label>Perfil</label>
						<select class="form-control form-control-sm" name="fk_seg_perfiles" id="fk_seg_perfiles" data-req="true"></select>
						<label id="hlp_fk_seg_perfiles" class="texto-error"></label>
					</div>
					<div class="form-group col-sm-3">
						<label>Nombre de Usuario</label>
						<input type="text" class="form-control form-control-sm" name="usua_login" id="usua_login" placeholder="Nombre de Usuario" data-tipo="login" data-req="true">
						<label id="hlp_usua_login" class="texto-error"></label>
					</div>
					<div class="form-group col-sm-3">
						<label>Clave</label>
						<input type="password" class="form-control form-control-sm" name="usua_clave" id="usua_clave" placeholder="Clave" data-tipo="clave" data-req="true">
						<label id="hlp_usua_clave" class="texto-error"></label>
					</div>
					<div class="form-group col-sm-3">
						<label>Repetir Clave</label>
						<input type="password" class="form-control form-control-sm" name="repetir_clave" id="repetir_clave" placeholder="Repetir Clave" data-tipo="clave" data-req="true">
						<label id="hlp_repetir_clave" class="texto-error"></label>
					</div>
				</div>
			</form>
		</div>
		<div class="card-footer">
			<button class="btn btn-success btn-sm" id="btn_aceptar">Aceptar</button>
			<a class="btn btn-danger btn-sm" href="usuarios">Cancelar</a>
		</div>
	</div>
</div>