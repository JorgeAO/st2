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

<div class="col-sm-12">
	<div class="card">
		<div class="card-header bg-dark text-white">Prestamos</div>
		<div class="card-body">
			<div class="form-group col-sm-3">
				<label>Estado</label>
				<select class="form-control form-control-sm texto-12" name="fk_par_estados" id="fk_par_estados"></select>
			</div>
			<div class="form-group">
				<a class="btn btn-success btn-sm texto-12" href="prestamosAdd">Agregar</a>
				<button class="btn btn-primary btn-sm texto-12" id="btn_consultar">Consultar</button>
			</div>
			<div class="table-responsive" id="div_resultados"></div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		enviarPeticion('estados/listar',
			{ 'esta_codigo':'1,6,7' }, 
			function(rta){
				var selected = '';
				$('#fk_par_estados').append('<option value="">-- Todos --</option>');
				$.each(rta.datos, function(i, val){					
					$('#fk_par_estados').append('<option value="'+val['esta_codigo']+'">'+val['esta_codigo']+' - '+val['esta_descripcion']+'</option>');
				});
			}
		);

		consultar();

		$('#btn_consultar').on('click', function(){
			consultar();
		});
	});

	function consultar()
	{
		enviarPeticion('prestamos/consultar',
			{
				'pres.fk_par_estados':$('#fk_par_estados').val()
			}, 
			function(rta){
				if (rta.tipo == 'error')
					alert(rta.mensaje)
				else if (rta.tipo == 'exito')
				{
					var tabla = '<table id="tbl_resultados" class="table table-hover table-bordered table-striped table-sm texto-12" width="100%" cellspacing="0">'+
						'<thead>'+
						'<tr>'+
						'<th>Código</th>'+
						'<th>Cliente</th>'+
						'<th>Fecha</th>'+
						'<th>Plazo (Meses)</th>'+
						'<th>Valor</th>'+
						'<th>Porc. Interés</th>'+
						'<th>Vlr. Interés</th>'+
						'<th>Estado</th>'+
						'<th>Opciones</th>'+
						'</tr>'+
						'</thead>'+
						'<tbody>';

					$.each(rta.datos, function(i, val){
						tabla += '<tr>'+
							'<td>'+val['pres_codigo']+'</td>'+
							'<td>'+val['clie_nombre']+' '+val['clie_apellido']+'</td>'+
							'<td>'+val['pres_fecha']+'</td>'+
							'<td>'+val['pres_plazo']+'</td>'+
							'<td>'+val['pres_vlr_monto']+'</td>'+
							'<td>'+val['pres_interes']+'</td>'+
							'<td>'+val['pres_int_total']+'</td>'+
							'<td>'+val['esta_descripcion']+'</td>'+
							'<td class="btn-group">'+
							'<a href="prestamosDet/'+val['pres_codigo']+'" class="btn btn-primary btn-sm" title="Detalles"><i class="fa fa-info"></i></a>'+
							'<button class="btn btn-danger btn-sm" type="button" title="Anular préstamo" onclick="anular('+val['pres_codigo']+')"><i class="fa fa-ban"></i></button>'+
							'</td>'+
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

	function anular(cod)
	{
		if (confirm('¿Está seguro que desea anular el préstamo?'))
		{
			enviarPeticion('prestamos/anular',
				{'pres_codigo':cod}, 
				function(rta){
					alert(rta.mensaje);
					if (rta.tipo == 'exito')
						consultar();
				}
			);
		}
	}
</script>