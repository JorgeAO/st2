<script src="/SmartTrader/recursos/librerias/jquery/jquery-3.2.0.min.js"></script>
<script src="/SmartTrader/recursos/librerias/propias/js/scripts.js"></script>
<script src="/SmartTrader/recursos/librerias/propias/js/validador.js"></script>
<script src="/SmartTrader/recursos/librerias/bootstrap/bootstrap-4.1.2/js/bootstrap.min.js"></script>
<script src="/SmartTrader/recursos/librerias/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script src="/SmartTrader/recursos/librerias/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="/SmartTrader/recursos/librerias/select2/js/select2.min.js"></script>
<script src="/SmartTrader/recursos/librerias/datepicker/bootstrap-datepicker-1.9.0/js/bootstrap-datepicker.min.js"></script>

<link rel="stylesheet" href="/SmartTrader/recursos/librerias/bootstrap/bootstrap-4.1.2/css/bootstrap.min.css">
<link rel="stylesheet" href="/SmartTrader/recursos/librerias/fontawesome/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/SmartTrader/recursos/librerias/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="/SmartTrader/recursos/librerias/propias/css/estilos.css">
<link rel="stylesheet" href="/SmartTrader/recursos/librerias/select2/css/select2.min.css">
<link rel="stylesheet" href="/SmartTrader/recursos/librerias/datepicker/bootstrap-datepicker-1.9.0/css/bootstrap-datepicker.min.css">

<script type="text/javascript">
	$(document).ready(function(){
		enviarPeticion(
			'prestamos/detalles',
			{
				'pres_codigo':<?=$_REQUEST['cod']?>
			}, 
			function(rta){
				if (rta.tipo == 'exito')
				{
					console.info(rta.datos.cuotas);
					// Cargar información del préstamo y del cliente
					$.each(rta.datos.prestamo[0], function(i, val){
						$('#lbl_'+i).html(val);
					});

					// Cargar información de las cuotas
					var tbl_cuotas = '<table id="tbl_resultados" class="table table-hover table-bordered table-striped table-sm texto-12" width="100%" cellspacing="0">'+
						'<thead>'+
						'<tr>'+
						'<th>Préstamo</th>'+
						'<th>Cuota</th>'+
						'<th>Fecha</th>'+
						'<th>Valor</th>'+
						'<th>Estado</th>'+
						'<th>Fecha Pago</th>'+
						'<th>Valor Pago</th>'+
						'</tr>'+
						'</thead>'+
						'<tbody>';

					$.each(rta.datos.cuotas, function(i, val){
						tbl_cuotas += '<tr>'+
							'<td>'+val['fk_pre_prestamos']+'</td>'+
							'<td>'+val['prcu_codigo']+'</td>'+
							'<td>'+val['prcu_fecha']+'</td>'+
							'<td>'+val['prcu_valor']+'</td>'+
							'<td>'+val['esta_descripcion']+'</td>'+
							'<td>'+val['prcu_valor_pago']+'</td>'+
							'<td>'+val['prcu_fecha_pago']+'</td>'+
							'</tr>';
					});

					tbl_cuotas += '</tbody></table>';
					$('#div_cuotas').html(tbl_cuotas);
					

					// Cargar información de la participación
					var tabla = '<table id="tbl_resultados" class="table table-hover table-bordered table-striped table-sm texto-12" width="100%" cellspacing="0">'+
						'<thead>'+
						'<tr>'+
						'<th>Nombre</th>'+
						'<th>Apellido</th>'+
						'<th>Porcentaje</th>'+
						'</tr>'+
						'</thead>'+
						'<tbody>';

					$.each(rta.datos.participacion, function(i, val){
						tabla += '<tr>'+
							'<td>'+val['inve_nombre']+'</td>'+
							'<td>'+val['inve_apellido']+'</td>'+
							'<td>'+val['prpa_porcentaje']+'</td>'+
							'</tr>';
					});

					tabla += '</tbody></table>';
					$('#div_participacion').html(tabla);
				}
			}
		);
	});
</script>

<? require '../../seguridad/seguridad/Menu.php'; ?>

<div class="row col-sm-12">
	<div class="col-sm-4">
		<div class="card">
			<div class="card-header bg-dark text-white">Información del Préstamo</div>
			<div class="card-body">
				<table class="table table-sm texto-12">
					<tr>
						<th>Código</th>
						<td class="text-right" id="lbl_pres_codigo"></td>
					</tr>
					<tr>
						<th>Fecha</th>
						<td class="text-right" id="lbl_pres_fecha"></td>
					</tr>
					<tr>
						<th>Monto</th>
						<td class="text-right" id="lbl_pres_vlr_monto"></td>
					</tr>
					<tr>
						<th>Plazo (en meses)</th>
						<td class="text-right" id="lbl_pres_plazo"></td>
					</tr>
					<tr>
						<th>Porc. Interes</th>
						<td class="text-right" id="lbl_pres_interes"></td>
					</tr>
					<tr>
						<th>Total Intereses</th>
						<td class="text-right" id="lbl_pres_int_total"></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="card">
			<div class="card-header bg-dark text-white">Información del Cliente</div>
			<div class="card-body">
				<table class="table table-sm texto-12">
					<tr>
						<th>Nombre</th>
						<td class="text-right" id="lbl_clie_nombre"></td>
					</tr>
					<tr>
						<th>Apellido</th>
						<td class="text-right" id="lbl_clie_apellido"></td>
					</tr>
					<tr>
						<th>Correo</th>
						<td class="text-right" id="lbl_clie_correo"></td>
					</tr>
					<tr>
						<th>Celular</th>
						<td class="text-right" id="lbl_clie_celular"></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="card">
			<div class="card-header bg-dark text-white">Participación</div>
			<div class="card-body" id="div_participacion"></div>
		</div>
	</div>
</div>
<br>
<div class="row col-sm-12">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header bg-dark text-white">Cuotas</div>
			<div class="card-body" id="div_cuotas"></div>
		</div>
	</div>
</div>
<br>
<div class="row col-sm-12">
	<div class="col-sm-12">
	<a class="btn btn-danger btn-sm texto-12" href="../prestamos">Volver</a>
	</div>
</div>