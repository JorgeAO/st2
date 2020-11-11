<script type="text/javascript" src="/apps/SmartTrader/recursos/librerias/jquery/jquery-3.2.0.min.js"></script>
<script type="text/javascript" src="/apps/SmartTrader/recursos/librerias/propias/js/scripts.js"></script>
<script type="text/javascript" src="/apps/SmartTrader/recursos/librerias/propias/js/validador.js"></script>
<script type="text/javascript" src="/apps/SmartTrader/recursos/librerias/bootstrap/bootstrap-4.1.2/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="/apps/SmartTrader/recursos/librerias/bootstrap/bootstrap-4.1.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/apps/SmartTrader/recursos/librerias/propias/css/estilos.css">

<script type="text/javascript">
	$(document).ready(function(){
		$('#btn_aceptar').on('click', function(){
			if (validarFormulario('frm_upd'))
			{
				if ($('#usua_clave').val() != $('#repetir_clave').val())
					alert('Las contraseñas no coinciden')
				else
					enviarPeticion('usuarios/reestablecer',
						{
							'usua_codigo':<?=$_GET['c']?>,
							'usua_token':'<?=$_GET['t']?>',
							'usua_clave':$('#usua_clave').val()
						}, 
						function(rta){
							console.info(rta);
							alert(rta.mensaje);
							if (rta.tipo == 'exito')
								window.location.href = '../../login';
						}
					);
			}
		});
	});
</script>

<br>

<div class="col-sm-6 offset-sm-3 texto-12">
	<div class="card">
		<div class="card-header bg-dark text-white">Reestablecer Clave</div>
		<div class="card-body">
			<div class="col-sm-12">
				<form id="frm_upd">
					<div class="form-group">
						<label>Token</label>
						<input type="text" class="form-control form-control-sm" name="usua_token" id="usua_token" value="<?=$_GET['t']?>" data-req="true" readonly="true">
						<label id="hlp_usua_token" class="texto-error"></label>
					</div>
					<div class="form-group">
						<label>Nueva Clave</label>
						<input type="password" class="form-control form-control-sm" name="usua_clave" id="usua_clave" data-tipo="clave" data-req="true">
						<label id="hlp_usua_clave" class="texto-error"></label>
					</div>
					<div class="form-group">
						<label>Repetir Nueva Clave</label>
						<input type="password" class="form-control form-control-sm" name="repetir_clave" id="repetir_clave" data-tipo="clave" data-req="true">
						<label id="hlp_repetir_clave" class="texto-error"></label>
					</div>
					<div class="form-group">
						<label id="lbl_mensaje"></label>
					</div>
				</form>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary btn-sm" id="btn_aceptar">Reestablecer</button>
		</div>
	</div>
</div>