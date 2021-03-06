<script type="text/javascript" src="/apps/st2/recursos/librerias/jquery/jquery-3.2.0.min.js"></script>
<script type="text/javascript" src="/apps/st2/recursos/librerias/propias/js/scripts.js"></script>
<script type="text/javascript" src="/apps/st2/recursos/librerias/bootstrap/bootstrap-4.1.2/js/bootstrap.min.js"></script>
<script src="/apps/st2/recursos/librerias/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script src="/apps/st2/recursos/librerias/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

<link rel="stylesheet" type="text/css" href="/apps/st2/recursos/librerias/bootstrap/bootstrap-4.1.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/apps/st2/recursos/librerias/fontawesome/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/apps/st2/recursos/librerias/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.css">
<link rel="stylesheet" type="text/css" href="/apps/st2/recursos/librerias/propias/css/estilos.css">

<? require '../../seguridad/seguridad/Menu.php'; ?>

<script type="text/javascript">
	$(document).ready(function(){
		consultar();

		$('#btn_consultar').on('click', function(){
			consultar();
		});
	});

	function consultar()
	{
		enviarPeticion('movimientos/consultar',
			{'':''}, 
			function(rta){
				if (rta.tipo == 'error')
					alert(rta.mensaje)
				else if (rta.tipo == 'exito')
				{
					var tabla = '<table id="tbl_resultados" class="table table-hover table-bordered table-striped table-sm texto-12" width="100%" cellspacing="0">'+
						'<thead>'+
						'<tr>'+
						'<th>Código</th>'+
						'<th>Inversionista</th>'+
						'<th>Tipo de Movimiento</th>'+
						'<th>Descripción</th>'+
						'<th>Fecha</th>'+
						'<th>Monto</th>'+
						'</tr>'+
						'</thead>'+
						'<tbody>';

					$.each(rta.datos, function(i, val){
						tabla += '<tr>'+
							'<td>'+val['movi_codigo']+'</td>'+
							'<td>'+val['inve_nombre']+' '+val['inve_apellido']+'</td>'+
							'<td>'+val['movi_tipo_2']+'</td>'+
							'<td>'+val['movi_descripcion']+'</td>'+
							'<td>'+val['movi_fecha']+'</td>'+
							'<td>'+val['movi_monto']+'</td>'+
							'</tr>';
					});

					tabla += '</tbody></table>';

					$('#div_resultados').html(tabla);
					$('#tbl_resultados').DataTable({
						"language": { "url": ruta_tabla_esp }
					});
				}
			}
		);
	}
</script>

<div class="col-sm-12">
	<div class="card">
		<div class="card-header bg-dark text-white">Movimientos</div>
		<div class="card-body">
			<div class="form-group">
				<a class="btn btn-success btn-sm texto-12" href="movimientosAdd">Agregar</a>
				<button class="btn btn-primary btn-sm texto-12" id="btn_consultar">Consultar</button>
			</div>
			<div class="table-responsive" id="div_resultados"></div>
		</div>
	</div>
</div>