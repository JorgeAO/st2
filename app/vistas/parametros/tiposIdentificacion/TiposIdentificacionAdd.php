<script type="text/javascript" src="../recursos/librerias/jquery/jquery-3.2.0.min.js"></script>
<script type="text/javascript" src="../recursos/librerias/propias/js/scripts.js"></script>
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
			enviarPeticion('tiposIdentificacion/insertar',
				prepararFormulario('frm_add'), 
				function(rta){
					alert(rta.mensaje);
					if (rta.tipo == 'exito')
						window.location.href = 'tiposIdentificacion';
				}
			);
		});

		$('#btn_guardar').on('click', function(){
			enviarPeticion('tiposIdentificacion/insertar',
				prepararFormulario('frm_add'), 
				function(rta){
					alert(rta.mensaje);
					if (rta.tipo == 'exito')
						window.location.href = 'tiposIdentificacionAdd';
				}
			);
		});
	});
</script>

<? require '../../seguridad/seguridad/Menu.php'; ?>

<div class="col-sm-12">
	<div class="card">
		<div class="card-header bg-dark text-white">Agregar Tipo de Identificación</div>
		<div class="card-body">
			<form id="frm_add">
				<div class="row">
					<div class="form-group col-sm-12">
						<label>Descripción</label>
						<input type="text" class="form-control form-control-sm" name="tiid_descripcion" id="tiid_descripcion" placeholder="Descripción">
					</div>
				</div>
			</form>
		</div>
		<div class="card-footer">
			<button class="btn btn-success btn-sm texto-12" id="btn_guardar">Guardar y Crear Nuevo</button>
			<button class="btn btn-success btn-sm texto-12" id="btn_aceptar">Guardar</button>
			<a class="btn btn-danger btn-sm texto-12" href="tiposIdentificacion">Cancelar</a>
		</div>
	</div>
</div>