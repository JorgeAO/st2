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

		$('#pres_fecha').datepicker({
			format: "yyyy-mm-dd",
			todayBtn: "linked",
			language: "es"
		});
		
		enviarPeticion('clientes/listar',
			{ 'clie.fk_par_estados':'1' }, 
			function(rta){
				$('#fk_par_clientes').append('<option value="">-- Seleccione --</option>');
				$.each(rta.datos, function(i, val){
					$('#fk_par_clientes').append('<option value="'+val['clie_codigo']+'">' + val['clie_identificacion']+' - '+val['clie_nombre']+' '+val['clie_apellido']+'</option>');
				});
			}
		);

		$("#fk_par_clientes").select2({
			placeholder:'-- Seleccione --'
		});

		/*$('.intCalcular').on('change', function(){
			intCalcular();
		});*/

		$('#btn_int_calcular').on('click', function(){
			intCalcular();
		});

		$('#btn_aceptar').on('click', function(){
			let valido = true;
			$.each($('.validar'), function(i, val){
				valido = validarCampo(val.id);
			});

			if (valido == true)
			{
				enviarPeticion('prestamos/insertar',
					{
						'fk_par_clientes':$('#fk_par_clientes').val(),
						'pres_fecha':$('#pres_fecha').val(),
						'pres_vlr_monto':$('#pres_vlr_monto').val(),
						'pres_plazo':$('#pres_plazo').val(),
						'pres_interes':$('#pres_interes').val(),
						'pres_int_mensual':$('#pres_int_mensual').val(),
						'pres_int_total':$('#pres_int_total').val(),
						'pres_vlr_pago':$('#pres_vlr_pago').val(),
						'pres_vlr_cuota':$('#pres_vlr_cuota').val()
					}, 
					function(rta){
						alert(rta.mensaje);
						if (rta.tipo == 'exito')
							window.location.href = 'prestamos';
					}
				);
			}
		});

		$('#btn_guardar').on('click', function(){
			let valido = true;
			$.each($('.validar'), function(i, val){
				valido = validarCampo(val.id);
			});

			if (valido == true)
			{
				enviarPeticion('prestamos/insertar',
					{
						'fk_par_clientes':$('#fk_par_clientes').val(),
						'pres_fecha':$('#pres_fecha').val(),
						'pres_vlr_monto':$('#pres_vlr_monto').val(),
						'pres_plazo':$('#pres_plazo').val(),
						'pres_interes':$('#pres_interes').val(),
						'pres_int_mensual':$('#pres_int_mensual').val(),
						'pres_int_total':$('#pres_int_total').val(),
						'pres_vlr_pago':$('#pres_vlr_pago').val(),
						'pres_vlr_cuota':$('#pres_vlr_cuota').val()
					}, 
					function(rta){
						alert(rta.mensaje);
						if (rta.tipo == 'exito')
							window.location.href = 'prestamosAdd';
					}
				);
			}
		});
	});

	function intCalcular()
	{
		enviarPeticion(
			'prestamos/intCalcular',
			{
				'pres_vlr_monto':$('#pres_vlr_monto').val(),
				'pres_plazo':$('#pres_plazo').val(),
				'pres_interes':$('#pres_interes').val()
			}, 
			function(rta){
				if (rta.tipo == 'exito'){
					$.each(rta.datos[0], function(i, val){
						$('#'+i).val(val);
					});
				}
			}
		);
	}
</script>

<? require '../../seguridad/seguridad/Menu.php'; ?>

<div class="col-sm-12">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-6">
				<div class="card">
					<div class="card-header bg-dark text-white">Información General</div>
					<div class="card-body">
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="card">
					<div class="card-header bg-dark text-white">Información Del Cliente</div>
					<div class="card-body">
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="card">
					<div class="card-header bg-dark text-white">Cuotas</div>
					<div class="card-body">
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="card">
					<div class="card-header bg-dark text-white">Participación</div>
					<div class="card-body">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>