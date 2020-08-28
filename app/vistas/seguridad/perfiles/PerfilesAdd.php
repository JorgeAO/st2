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
			if(validarFormulario('frm_add'))
			{
				enviarPeticion('perfiles/insertar',
					prepararFormulario('frm_add'), 
					function(rta){
						alert(rta.mensaje);
						if (rta.tipo == 'exito')
							window.location.href = 'perfiles';
					}
				);
			}
		});
	});
</script>

<? require '../seguridad/Menu.php'; ?>

<div class="col-sm-12">
	<div class="card">
		<div class="card-header bg-dark text-white">Agregar Perfil</div>
		<div class="card-body">
			<form id="frm_add">
				<div class="row">
					<div class="form-group col-sm-12">
						<label>Descripción</label>
						<input type="text" class="form-control form-control-sm" name="perf_descripcion" id="perf_descripcion" placeholder="Descripción" data-tipo="texto" data-req="true">
						<label id="hlp_perf_descripcion" class="texto-error"></label>
					</div>
				</div>
			</form>
		</div>
		<div class="card-footer">
			<button class="btn btn-success btn-sm" id="btn_aceptar">Aceptar</button>
			<a class="btn btn-danger btn-sm" href="perfiles">Cancelar</a>
		</div>
	</div>
</div>