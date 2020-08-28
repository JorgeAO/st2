<?

include_once '../app/modelos/ClsClientes.php';
include_once '../app/modelos/ClsUsuarios.php';
include_once '../nucleo/Control.php';

class CtrlClientes extends Control
{
	protected $intOpcion = 2003;
	protected $strClase = 'ClsClientes';

	public function insertar($arrParametros)
	{
		try 
		{
			if (!ClsPermisos::blValidarPermiso($this->intOpcion, 'c'))
				throw new Exception('Usted no posee permisos para ejecutar esta acción');

			$arrUsuario = ClsUsuarios::insertar([
				'usua_nombre' => $arrParametros['clie_nombre'].' '.$arrParametros['clie_apellido'],
				'usua_mail' => $arrParametros['clie_correo'],
				'usua_login' => $arrParametros['usua_login'],
				'usua_clave' => md5($arrParametros['usua_clave']),
				'fk_seg_perfiles' => '8',
				'fc' => date('Y-m-d H:m:s'),
				'uc' => $_SESSION['usuario_sesion'][0]['usua_codigo']
			]);

			unset(
				$arrParametros['usua_login'],
				$arrParametros['usua_clave'],
				$arrParametros['repetir_clave']
			);

			$arrParametros['fk_seg_usuarios'] = $arrUsuario['insert_id'];
			$arrParametros['fc'] = date('Y-m-d H:m:s');
			$arrParametros['uc'] = $_SESSION['usuario_sesion'][0]['usua_codigo'];

			ClsClientes::insertar($arrParametros);

			$objRta->tipo = 'exito';
			$objRta->mensaje = 'El proceso se realizó con éxito';
			return $objRta;
		} 
		catch (Exception $e) 
		{
			throw new Exception($e->getMessage());
		}
	}

	public function eliminar($arrParametros)
	{
		try 
		{
			if (!ClsPermisos::blValidarPermiso($this->intOpcion, 'd'))
				throw new Exception('Usted no posee permisos para ejecutar esta acción');

			$arrCliente = ClsClientes::consultar($arrParametros);

			ClsUsuarios::editar([
				'usua_codigo' => $arrCliente[0]['fk_seg_usuarios'],
				'fk_par_estados' => 2,
				'fm' => date('Y-m-d H:m:s'),
				'um' => $_SESSION['usuario_sesion'][0]['usua_codigo']
			]);

			include_once '../../app/modelos/'.$this->strClase.'.php';
			$clase = new $this->strClase();
			$clase::eliminar($arrParametros);

			$objRta->tipo = 'exito';
			$objRta->mensaje = 'El proceso se realizó con éxito';
			return $objRta;
		} 
		catch (Exception $e) 
		{
			throw new Exception($e->getMessage());
		}
	}
}