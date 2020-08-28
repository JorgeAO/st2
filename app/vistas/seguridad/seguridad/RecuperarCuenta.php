<script type="text/javascript" src="../recursos/librerias/jquery/jquery-3.2.0.min.js"></script>
<script type="text/javascript" src="../recursos/librerias/propias/js/scripts.js"></script>
<script type="text/javascript" src="../recursos/librerias/propias/js/validador.js"></script>
<script type="text/javascript" src="../recursos/librerias/bootstrap/bootstrap-4.1.2/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="../recursos/librerias/bootstrap/bootstrap-4.1.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../recursos/librerias/propias/css/estilos.css">

<script type="text/javascript">
	$(document).ready(function(){
		$('#btn_entrar').on('click', function(){
			if (validarFormulario('frm_upd'))
			{
				enviarPeticion('usuarios/recuperar', 
					prepararFormulario('frm_upd'), 
					function(rta){
						$('#lbl_mensaje').html(rta.mensaje);
					}
				);
			}
		});
	});
</script>

<br>

<div class="col-sm-6 offset-sm-3 texto-12">
	<div class="card">
		<div class="card-header bg-base7 text-white">Recuperar Cuenta</div>
		<div class="card-body">
			<div class="col-sm-12">
				<form id="frm_upd">
					<div class="form-group">
						<label>Usuario</label>
						<input type="text" class="form-control form-control-sm" name="usua_login" id="usua_login" data-tipo="login" data-req="true">
						<label id="hlp_usua_login" class="texto-error"></label>
					</div>
					<div class="form-group">
						<label id="lbl_mensaje"></label>
					</div>
				</form>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary btn-sm" id="btn_entrar">Recuperar</button>
			<a href="login" class="btn btn-danger btn-sm">Cancelar</a>
		</div>
	</div>
</div>