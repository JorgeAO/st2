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
		enviarPeticion('perfiles/listar',
			{ '':'' }, 
			function(rta){
				$.each(rta.datos, function(i, val){
					$('#fk_seg_perfiles').append('<option value="'+val['perf_codigo']+'">'+val['perf_codigo']+' - '+val['perf_descripcion']+'</option>');
				});
				consultar();
			}
		);

		$('#fk_seg_perfiles').on('change', function(){
			consultar();
		});

		$('#btn_aceptar').click(function(){
			$('#lbl_mensaje').html('<i class="fa fa-pulse fa-fw fa-spinner"></i> Procesando...');
			var parametros = { 
				'fk_seg_perfiles':$('#fk_seg_perfiles').val(),
				'permisos': $('#frm_permisos').serializeArray()
			};
			var respuesta = { destino:'objeto' };
			enviarPeticion('permisos/insertar', parametros, function(rta){
				$('#lbl_mensaje').html('');
				alert(rta.mensaje);
				if (rta.tipo == 'exito')
					location.reload(); 
			});
		});

	});

	function consultar()
	{
		enviarPeticion('permisos/ver',
			{ 'fk_seg_perfiles':$('#fk_seg_perfiles').val() }, 
			function(rta){
				var tabla = '<table id="tbl_resultados" class="table table-sm table-bordered table-striped texto-12" width="100%" cellspacing="0">'+
					'<thead>'+
					'<tr>'+
					'<th>Código</th>'+
					'<th>Modulo</th>'+
					'<th>Opción</th>'+
					'<th>Insertar</th>'+
					'<th>Consultar</th>'+
					'<th>Editar</th>'+
					'<th>Eliminar</th>'+
					'<th>Listar</th>'+
					'</tr>'+
					'</thead>'+
					'<tbody>';

				$.each(rta.datos, function(i, val){
					tabla += '<tr id="fila_'+val['perf_codigo']+'">'+
						'<td>'+val['opci_codigo']+'</td>'+
						'<td>'+val['modu_descripcion']+'</td>'+
						'<td>'+val['opci_nombre']+'</td>'+
						'<td><input name="'+val['opci_codigo']+'_c" type="checkbox" '+val['perm_c']+'></td>'+
						'<td><input name="'+val['opci_codigo']+'_r" type="checkbox" '+val['perm_r']+'></td>'+
						'<td><input name="'+val['opci_codigo']+'_u" type="checkbox" '+val['perm_u']+'></td>'+
						'<td><input name="'+val['opci_codigo']+'_d" type="checkbox" '+val['perm_d']+'></td>'+
						'<td><input name="'+val['opci_codigo']+'_l" type="checkbox" '+val['perm_l']+'></td>'+
						'</tr>';
				});

				tabla += '</tbody></table>';

				$('#div_resultados').html(tabla);
			}
		);
	}
</script>

<? require '../seguridad/Menu.php'; ?>

<!--div class="col-sm-12"-->
<div class="col-sm-12">
	<div class="card">
		<div class="card-header bg-base7 text-white">Permisos</div>
		<div class="card-body">
			<div class="form-group row-sm-3">
				<label>Perfil</label>
				<select class="form-control form-control-sm" id="fk_seg_perfiles"></select>
			</div>
			<div class="form-group row-sm-9">
				<button class="btn btn-success btn-sm" id="btn_aceptar">Aceptar</button>
				<label id="lbl_mensaje"></label>
			</div>
			<form id="frm_permisos">
				<div class="table-responsive" id="div_resultados"></div>
			</form>
		</div>
	</div>
</div>