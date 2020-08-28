<?

include_once '../app/modelos/ClsUsuarios.php';
include_once '../nucleo/Control.php';
include_once '../nucleo/Generales.php';

class CtrlUsuarios extends Control
{
	protected $intOpcion = 1002;
	protected $strClase = 'ClsUsuarios';

	public function insertar($arrParametros)
	{
		try 
		{
			if (!ClsPermisos::blValidarPermiso($this->intOpcion, 'c'))
				throw new Exception('Usted no posee permisos para ejecutar esta acción');

			$arrParametros['usua_clave'] = md5($arrParametros['usua_clave']);
			unset($arrParametros['repetir_clave']);
			
			session_start();
			$arrParametros['fc'] = date('Y-m-d H:m:s');
			$arrParametros['uc'] = $_SESSION['usuarios_sesion'][0]['usua_codigo'];

			ClsUsuarios::insertar($arrParametros);

			$objRta->tipo = 'exito';
			$objRta->mensaje = 'El proceso se realizó con éxito';
			return $objRta;
		} 
		catch (Exception $e) 
		{
			throw new Exception($e->getMessage());
		}
	}

	public function validar($arrParametros = [])
	{
		try 
		{
			$arrUsuario = ClsUsuarios::consultar([
				'usua_mail'=>$arrParametros['usua_mail']
			]);

			if (count($arrUsuario) != 1)
				throw new Exception('No se pudo recuperar el usuario');

			if ($arrUsuario[0]['usua_clave'] != md5($arrParametros['usua_clave']))
				throw new Exception('La contraseña no es correcta');

			if ($arrUsuario[0]['fk_par_estados'] == 2)
				throw new Exception('Su usuario no se encuentra activo, comuniquese con un administrador del sistema');

			session_start();
			$_SESSION['usuario_sesion'] = $arrUsuario;

			$objRta->tipo = 'exito';
			$objRta->ruta = 'principal';
			return $objRta;
		} 
		catch (Exception $e) 
		{
			throw new Exception($e->getMessage());
		}
	}

	public function clave($arrParametros)
	{
		try 
		{
			if (md5($arrParametros['clave_actual']) != $_SESSION['usuario_sesion'][0]['usua_clave'])
				throw new Exception('La clave actual no es correcta, por favor valide');

			unset($arrParametros['clave_actual'],$arrParametros['repetir_clave']);

			ClsUsuarios::editar([
				'usua_codigo' =>$_SESSION['usuario_sesion'][0]['usua_codigo'],
				'usua_clave' =>md5($arrParametros['usua_clave']),
				'fm' => date('Y-m-d H:m:s'),
				'um' => $_SESSION['usuario_sesion'][0]['usua_codigo']
			]);

			$obRta->tipo = 'exito';
			$obRta->mensaje = 'El proceso se realizó con éxito';
			return $obRta;
		} 
		catch (Exception $e) 
		{
			throw new Exception($e->getMessage());
		}
	}

	public function recuperar($arrParametros)
	{
		try 
		{
			$arrUsuario = ClsUsuarios::consultar([
				'usua_login'=>$arrParametros['usua_login']
			]);

			if (count($arrUsuario) != 1)
				throw new Exception('No se pudo recuperar el usuario');

			if ($arrUsuario[0]['fk_par_estados'] != 1)
				throw new Exception('Su usuario no se encuentra en estado activo');

			$strToken = md5(date('YmdHis'));
			$strFecha = date('Y-m-d H:i:s', strtotime('+15 minutes', strtotime(date('Y-m-d H:i:s'))));

			ClsUsuarios::editar([
				'usua_codigo' => $arrUsuario[0]['usua_codigo'],
				'usua_token' => $strToken,
				'usua_vcto_token' => $strFecha
			]);

			$strCorreo = "Hola ".$arrUsuario[0]['usua_nombre'].
				"! <br><br>Usted ha solicitado recuperar su clave para ingresar al sistema.<br>".
				"El siguiente enlace estará vigente durante los próximos 15 minutos para que pueda realizar el cambio de su clave.<br><br>".
				"http://localhost/SmartTrader/seguridad/reestablecerClave/".$arrUsuario[0]['usua_codigo']."/".$strToken.".";

			Generales::enviarMail($arrUsuario[0]['usua_mail'], 'Recuperación de Clave', utf8_decode($strCorreo));

			$obRta->tipo = 'exito';
			$obRta->mensaje = 'Se ha enviado un mensaje a su cuenta de correo electrónico';
			return $obRta;
		} 
		catch (Exception $e) 
		{
			throw new Exception($e->getMessage());
		}
	}

	public function reestablecer($arrParametros)
	{
		try 
		{
			$arrUsuario = ClsUsuarios::consultar([
				'usua_codigo' => $arrParametros['usua_codigo']
			]);

			if (count($arrUsuario) != 1)
				throw new Exception('No se pudo recuperar su usuario');

			if ($arrParametros['usua_token'] != $arrUsuario[0]['usua_token'])
				throw new Exception('El código de seguridad no es válido');

			if (strtotime($arrUsuario[0]['usua_vcto_token']) < strtotime(date('Y-m-d H:i:s')))
				throw new Exception('El código de seguridad ya ha expirado, por favor solicite de nuevo la recuperación de clave');

			ClsUsuarios::editar([
				'usua_codigo' => $arrParametros['usua_codigo'],
				'usua_clave' => md5($arrParametros['usua_clave']),
				'usua_token' => '',
				'usua_vcto_token' => ''
			]);

			$obRta->tipo = 'exito';
			$obRta->mensaje = 'Su clave se ha reestablecido con éxito';
			return $obRta;
		} 
		catch (Exception $e) 
		{
			throw new Exception($e->getMessage());
		}
	}

	public function salir()
	{
		try 
		{
			session_start();
			session_destroy();

			$obRta->tipo = 'exito';
			$obRta->ruta = '/SmartTrader/';
			return $obRta;
		} 
		catch (Exception $e) 
		{
			throw new Exception($e->getMessage());
		}
	}
}