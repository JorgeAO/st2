<script type="text/javascript" src="../../../../recursos/librerias/jquery/jquery-3.2.0.min.js"></script>
<script type="text/javascript" src="../../../../recursos/librerias/propias/js/scripts.js"></script>
<script type="text/javascript" src="../../../../recursos/librerias/bootstrap/bootstrap-4.1.2/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="../../../../recursos/librerias/bootstrap/bootstrap-4.1.2/css/bootstrap.min.css">

<script type="text/javascript">
	$(document).ready(function(){
		$('#btn_entrar').on('click', function(){
			enviarPeticion('usuarios/validar',
				prepararFormulario('frm_src'), 
				function(rta){
					alert(rta.mensaje)
				}
			);
		});
	});
</script>

<div class="col-sm-6 offset-sm-3">
	<div class="card">
		<div class="card-header text-white bg-dark">Iniciar Sesión</div>
		<div class="card-body">
			<div class="col-sm-12">
				<form id="frm_src">
					<div class="form-group">
						<label>Usuario</label>
						<input type="text" class="form-control form-control-sm" name="usua_login" id="usua_login">
					</div>
					<div class="form-group">
						<label>Contraseña</label>
						<input type="password" class="form-control form-control-sm" name="usua_clave" id="usua_clave">
					</div>
				</form>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary btn-sm" id="btn_entrar">Entrar</button>
		</div>
	</div>
</div>