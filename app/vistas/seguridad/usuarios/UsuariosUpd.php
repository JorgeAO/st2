<script type="text/javascript" src="/base-v7/recursos/librerias/jquery/jquery-3.2.0.min.js"></script>
<script type="text/javascript" src="/base-v7/recursos/librerias/propias/js/scripts.js"></script>
<script type="text/javascript" src="/base-v7/recursos/librerias/propias/js/validador.js"></script>
<script type="text/javascript" src="/base-v7/recursos/librerias/bootstrap/bootstrap-4.1.2/js/bootstrap.min.js"></script>
<script src="/base-v7/recursos/librerias/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script src="/base-v7/recursos/librerias/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

<link rel="stylesheet" type="text/css" href="/base-v7/recursos/librerias/bootstrap/bootstrap-4.1.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/base-v7/recursos/librerias/fontawesome/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/base-v7/recursos/librerias/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.css">
<link rel="stylesheet" type="text/css" href="/base-v7/recursos/librerias/propias/css/estilos.css">

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

		enviarPeticion('estados/listar',
			{ '':'' }, 
			function(rta){
				$.each(rta.datos, function(i, val){
					$('#fk_par_estados').append('<option value="'+val['esta_codigo']+'">'+val['esta_codigo']+' - '+val['esta_descripcion']+'</option>');
				});
			}
		);

		enviarPeticion('usuarios/consultar',
			{ 'usua_codigo':<?=$_REQUEST['cod']?> }, 
			function(rta){
				$.each(rta.datos[0], function(i, val){
					$('#'+i).val(val);
				});
			}
		);

		$('#btn_aceptar').on('click', function(){
			if (validarFormulario('frm_upd'))
			{
				enviarPeticion('usuarios/editar',
					prepararFormulario('frm_upd'), 
					function(rta){
						alert(rta.mensaje);
						if (rta.tipo == 'exito')
							window.location.href = '../usuarios';
					}
				);
			}
		});
	});
</script>

<? require '../seguridad/Menu.php'; ?>

<div class="col-sm-12">
	<div class="card">
		<div class="card-header bg-dark text-white">Editar Usuario</div>
		<div class="card-body">
			<form id="frm_upd">
				<div class="row">
					<div class="form-group col-sm-3">
						<label>Código</label>
						<input type="text" class="form-control form-control-sm" name="usua_codigo" id="usua_codigo" placeholder="Código" readonly="true">
					</div>
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
						<input type="text" class="form-control form-control-sm" id="usua_login" placeholder="Nombre de Usuario" readonly="true">
					</div>
					<div class="form-group col-sm-3">
						<label>Estado</label>
						<select class="form-control form-control-sm" name="fk_par_estados" id="fk_par_estados" data-req="true"></select>
						<label id="hlp_fk_par_estados" class="texto-error"></label>
					</div>
				</div>
			</form>
		</div>
		<div class="card-footer">
			<button class="btn btn-success btn-sm" id="btn_aceptar">Aceptar</button>
			<a class="btn btn-danger btn-sm" href="../usuarios">Cancelar</a>
		</div>
	</div>
</div>