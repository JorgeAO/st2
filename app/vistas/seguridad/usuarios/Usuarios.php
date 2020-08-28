<script type="text/javascript" src="../recursos/librerias/jquery/jquery-3.2.0.min.js"></script>
<script type="text/javascript" src="../recursos/librerias/propias/js/scripts.js"></script>
<script type="text/javascript" src="../recursos/librerias/bootstrap/bootstrap-4.1.2/js/bootstrap.min.js"></script>
<script src="../recursos/librerias/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script src="../recursos/librerias/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

<link rel="stylesheet" type="text/css" href="../recursos/librerias/bootstrap/bootstrap-4.1.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../recursos/librerias/fontawesome/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../recursos/librerias/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.css">
<link rel="stylesheet" type="text/css" href="../recursos/librerias/propias/css/estilos.css">

<? require '../seguridad/Menu.php'; ?>

<script type="text/javascript">
	$(document).ready(function(){
		consultar();

		$('#btn_consultar').on('click', function(){
			consultar();
		});
	});

	function consultar()
	{
		enviarPeticion('usuarios/consultar',
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
						'<th>Login</th>'+
						'<th>Nombre</th>'+
						'<th>Correo</th>'+
						'<th>Perfil</th>'+
						'<th>Estado</th>'+
						'<th>Opciones</th>'+
						'</tr>'+
						'</thead>'+
						'<tbody>';

					$.each(rta.datos, function(i, val){
						tabla += '<tr>'+
							'<td>'+val['usua_codigo']+'</td>'+
							'<td>'+val['usua_login']+'</td>'+
							'<td>'+val['usua_nombre']+'</td>'+
							'<td>'+val['usua_mail']+'</td>'+
							'<td>'+val['perf_descripcion']+'</td>'+
							'<td>'+val['esta_descripcion']+'</td>'+
							'<td class="btn-group">'+
							'<a href="usuariosUpd/'+val['usua_codigo']+'" class="btn btn-primary btn-sm" title="Editar registro"><i class="fa fa-edit"></i></a>'+
							'<button class="btn btn-danger btn-sm" type="button" title="Eliminar registro" onclick="eliminar('+val['usua_codigo']+')"><i class="fa fa-trash-o"></i></button>'+
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

	function eliminar(cod)
	{
		if (confirm('¿Está seguro que desea eliminar el registro?'))
		{
			enviarPeticion('usuarios/eliminar',
				{'usua_codigo':cod}, 
				function(rta){
					alert(rta.mensaje);
					if (rta.tipo == 'exito')
						consultar();
				}
			);
		}
	}
</script>

<div class="col-sm-12">
	<div class="card">
		<div class="card-header bg-dark text-white">Usuarios</div>
		<div class="card-body">
			<div class="form-group">
				<a class="btn btn-success btn-sm" href="usuariosAdd">Agregar</a>
				<button class="btn btn-primary btn-sm" id="btn_consultar">Consultar</button>
			</div>
			<div class="table-responsive" id="div_resultados"></div>
		</div>
	</div>
</div>