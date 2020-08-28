<script type="text/javascript" src="/SmartTrader/recursos/librerias/jquery/jquery-3.2.0.min.js"></script>
<script type="text/javascript" src="/SmartTrader/recursos/librerias/propias/js/scripts.js"></script>
<script type="text/javascript" src="/SmartTrader/recursos/librerias/bootstrap/bootstrap-4.1.2/js/bootstrap.min.js"></script>
<script src="/SmartTrader/recursos/librerias/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script src="/SmartTrader/recursos/librerias/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

<link rel="stylesheet" type="text/css" href="/SmartTrader/recursos/librerias/bootstrap/bootstrap-4.1.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/SmartTrader/recursos/librerias/fontawesome/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/SmartTrader/recursos/librerias/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.css">
<link rel="stylesheet" type="text/css" href="/SmartTrader/recursos/librerias/propias/css/estilos.css">

<script type="text/javascript">
	$(document).ready(function(){
		enviarPeticion('estados/listar',
			{ '':'' }, 
			function(rta){
				$.each(rta.datos, function(i, val){
					$('#fk_par_estados').append('<option value="'+val['esta_codigo']+'">'+val['esta_codigo']+' - '+val['esta_descripcion']+'</option>');
				});
			}
		);

		enviarPeticion('tiposIdentificacion/consultar',
			{'tiid_codigo':<?=$_REQUEST['cod']?>}, 
			function(rta){
				$.each(rta.datos[0], function(i, val){
					$('#'+i).val(val);
				});
			}
		);

		$('#btn_aceptar').on('click', function(){
			enviarPeticion('tipos/editar',
				prepararFormulario('frm_upd'), 
				function(rta){
					alert(rta.mensaje);
					if (rta.tipo == 'exito')
						window.location.href = '../tiposIdentificacion';
				}
			);
		});
	});
</script>

<? require '../../seguridad/seguridad/Menu.php'; ?>

<div class="col-sm-12">
	<div class="card">
		<div class="card-header bg-dark text-white">Editar Tipo de Identificación</div>
		<div class="card-body">
			<form id="frm_upd">
				<div class="row">
					<div class="form-group col-sm-3">
						<label>Código</label>
						<input type="text" class="form-control form-control-sm texto-12" name="tiid_codigo" id="tiid_codigo" placeholder="Código" readonly="true">
					</div>
					<div class="form-group col-sm-6">
						<label>Descripción</label>
						<input type="text" class="form-control form-control-sm texto-12" name="tiid_descripcion" id="tiid_descripcion" placeholder="Descripción">
					</div>
					<div class="form-group col-sm-3">
						<label>Estado</label>
						<select class="form-control form-control-sm texto-12" name="fk_par_estados" id="fk_par_estados"></select>
					</div>
				</div>
			</form>
		</div>
		<div class="card-footer">
			<button class="btn btn-success btn-sm texto-12" id="btn_aceptar">Aceptar</button>
			<a class="btn btn-danger btn-sm texto-12" href="../tiposIdentificacion">Cancelar</a>
		</div>
	</div>
</div>