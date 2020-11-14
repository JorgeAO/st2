<script src="/apps/SmartTrader/recursos/librerias/jquery/jquery-3.2.0.min.js"></script>
<script src="/apps/SmartTrader/recursos/librerias/propias/js/scripts.js"></script>
<script src="/apps/SmartTrader/recursos/librerias/propias/js/validador.js"></script>
<script src="/apps/SmartTrader/recursos/librerias/bootstrap/bootstrap-4.1.2/js/bootstrap.min.js"></script>
<script src="/apps/SmartTrader/recursos/librerias/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script src="/apps/SmartTrader/recursos/librerias/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="/apps/SmartTrader/recursos/librerias/select2/js/select2.min.js"></script>
<script src="/apps/SmartTrader/recursos/librerias/datepicker/bootstrap-datepicker-1.9.0/js/bootstrap-datepicker.min.js"></script>

<link rel="stylesheet" href="/apps/SmartTrader/recursos/librerias/bootstrap/bootstrap-4.1.2/css/bootstrap.min.css">
<link rel="stylesheet" href="/apps/SmartTrader/recursos/librerias/fontawesome/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/apps/SmartTrader/recursos/librerias/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="/apps/SmartTrader/recursos/librerias/propias/css/estilos.css">
<link rel="stylesheet" href="/apps/SmartTrader/recursos/librerias/select2/css/select2.min.css">
<link rel="stylesheet" href="/apps/SmartTrader/recursos/librerias/datepicker/bootstrap-datepicker-1.9.0/css/bootstrap-datepicker.min.css">

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

<div class="modal" id="mdl_pago" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Pagar cuota</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="form-group col-sm-3">
						<label>Cuota</label>
						<input type="text" class="form-control form-control-sm validar" name="pago_cuota" id="pago_cuota" data-tipo="numeros" data-req="true" placeholder="Cuota" readonly="true">
					</div>
					<div class="form-group col-sm-3">
						<p>Valor a pagar</p>
						<div class="form-check">
							<input class="form-check-input pago_tipo" type="radio" name="pago_tipo" id="pago_cuota" value="T" checked>
							<label class="form-check-label">
								Todo
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input pago_tipo" type="radio" name="pago_tipo" id="pago_cuota" value="C">
							<label class="form-check-label">
								Valor de la cuota
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input pago_tipo" type="radio" name="pago_tipo" id="pago_cuota" value="D">
							<label class="form-check-label">
								Valor diferente
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input pago_tipo" type="radio" name="pago_tipo" id="pago_cuota" value="N">
							<label class="form-check-label">
								No paga
							</label>
						</div>
					</div>
					<div class="form-group col-sm-3">
						<label>Valor a pagar</label>
						<input type="text" class="form-control form-control-sm validar" name="pago_vlr" id="pago_vlr" data-tipo="numeros" data-req="true" placeholder="Valor a pagar" readonly="true">
					</div>
					<div class="form-group col-sm-3">
						<label>Fecha</label>
						<input type="text" class="form-control form-control-sm validar" name="pago_fecha" id="pago_fecha" data-tipo="direccion" data-req="true" placeholder="Fecha" readonly="true">
						<label id="hlp_pago_fecha" class="texto-error"></label>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success btn-sm texto-12" id="btn_aceptar">Aceptar</button>
        		<button type="button" class="btn btn-danger btn-sm texto-12" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		$('#pago_fecha').datepicker({
			format: "yyyy-mm-dd",
			todayBtn: "linked",
			language: "es"
		});

		enviarPeticion(
			'prestamos/detalles',
			{
				'pres_codigo':<?=$_REQUEST['cod']?>
			}, 
			function(rta){
				if (rta.tipo == 'exito')
				{
					// Cargar información del préstamo y del cliente
					$.each(rta.datos.prestamo[0], function(i, val){
						$('#lbl_'+i).html(val);
					});

					// Cargar información de la participación
					var tbl_participacion = '<table id="tbl_resultados" class="table table-hover table-bordered table-striped table-sm texto-12" width="100%" cellspacing="0">'+
						'<thead>'+
						'<tr>'+
						'<th>Nombre</th>'+
						'<th>Apellido</th>'+
						'<th>Porcentaje</th>'+
						'</tr>'+
						'</thead>'+
						'<tbody>';

					$.each(rta.datos.participacion, function(i, val){
						tbl_participacion += '<tr>'+
							'<td>'+val['inve_nombre']+'</td>'+
							'<td>'+val['inve_apellido']+'</td>'+
							'<td>'+val['prpa_porcentaje']+'</td>'+
							'</tr>';
					});
					tbl_participacion += '</tbody></table>';
					$('#div_participacion').html(tbl_participacion);

					// Cargar información de las cuotas
					var tbl_cuotas = '<table id="tbl_resultados" class="table table-hover table-bordered table-striped table-sm texto-12" width="100%" cellspacing="0">'+
						'<thead>'+
						'<tr>'+
						'<th>Cuota</th>'+
						'<th>Fecha</th>'+
						'<th>Valor</th>'+
						'<th>Estado</th>'+
						'<th>Fecha Pago</th>'+
						'<th>Valor Pago</th>'+
						'<th>Opciones</th>'+
						'</tr>'+
						'</thead>'+
						'<tbody>';

					$.each(rta.datos.cuotas, function(i, val){
						tbl_cuotas += '<tr>'+
							'<td>'+val['prcu_numero']+'</td>'+
							'<td>'+val['prcu_fecha']+'</td>'+
							'<td>'+val['prcu_valor']+'</td>'+
							'<td>'+val['esta_descripcion']+'</td>'+
							'<td>'+val['prcu_valor_pago']+'</td>'+
							'<td>'+val['prcu_fecha_pago']+'</td>'+
							'<td>'+
							'<button class="btn btn-success btn-sm" type="button" title="Registrar pago" onclick="registrarPago('+val['prcu_codigo']+')"><i class="fa fa-usd"></i></button>'+
							'</td>'+
							'</tr>';
					});

					tbl_cuotas += '</tbody></table>';
					$('#div_cuotas').html(tbl_cuotas);
				}
			}
		);

		$('.pago_tipo').on('click', function(){
			$('#pago_vlr').val('');
			if (this.value == 'D')
				$('#pago_vlr').attr('readonly', false);
			else
				$('#pago_vlr').attr('readonly', true)
		});

		$('#btn_aceptar').on('click', function(){
			console.info($('#pago_tipo').val);
			enviarPeticion(
				'prestamos/pago',
				{
					'cuota':$('#pago_cuota').val(),
					'tipo':$('#pago_tipo').val(),
					'valor':$('pago_vlr').val(),
					'fecha':$('#pago_fecha').val()
				}, 
				function(rta){
					console.info(rta);
				}
			);
		});
	});

	function registrarPago(cod)
	{
		$('#pago_cuota').val(cod);
		$('#mdl_pago').modal('show');
	}
</script>