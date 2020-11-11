<?

include_once '../app/modelos/ClsInversionistas.php';
include_once '../app/modelos/ClsUsuarios.php';
include_once '../app/modelos/ClsMovimientos.php';
include_once '../nucleo/Control.php';

class CtrlInversionistas extends Control
{
	protected $intOpcion = 2002;
	protected $strClase = 'ClsInversionistas';

	public function insertar($arrParametros)
	{
		try 
		{
			if (!ClsPermisos::blValidarPermiso($this->intOpcion, 'c'))
				throw new Exception('Usted no posee permisos para ejecutar esta acción');

			/*$arrUsuario = ClsUsuarios::insertar([
				'usua_nombre' => $arrParametros['inve_nombre'].' '.$arrParametros['inve_apellido'],
				'usua_mail' => $arrParametros['inve_correo'],
				'usua_login' => $arrParametros['usua_login'],
				'usua_clave' => md5($arrParametros['usua_clave']),
				'fk_seg_perfiles' => '7',
				'fc' => date('Y-m-d H:m:s'),
				'uc' => $_SESSION['usuario_sesion'][0]['usua_codigo']
			]);*/

			unset(
				$arrParametros['usua_login'],
				$arrParametros['usua_clave'],
				$arrParametros['repetir_clave']
			);

			//$arrParametros['fk_seg_usuarios'] = $arrUsuario['insert_id'];
			$arrParametros['fc'] = date('Y-m-d H:m:s');
			$arrParametros['uc'] = $_SESSION['usuario_sesion'][0]['usua_codigo'];

			$arrInversionista = ClsInversionistas::insertar($arrParametros);

			if ($arrParametros['inve_saldo'] > 0)
			{
				ClsMovimientos::insertar([
					'fk_par_inversionistas' => $arrInversionista['insert_id'],
					'movi_tipo' => 'E',
					'movi_descripcion' => 'Capital de ingreso',
					'movi_fecha' => date('Y-m-d H:m:s'),
					'movi_monto' => $arrParametros['inve_saldo'],
					'fc' => date('Y-m-d H:m:s'),
					'uc' => $_SESSION['usuario_sesion'][0]['usua_codigo']
				]);
			}

			$objRta->tipo = 'exito';
			$objRta->mensaje = 'El proceso se realizó con éxito';
			return $objRta;
		} 
		catch (Exception $e) 
		{
			throw new Exception($e->getMessage());
		}
	}

	/*public function eliminar($arrParametros)
	{
		try 
		{
			if (!ClsPermisos::blValidarPermiso($this->intOpcion, 'd'))
				throw new Exception('Usted no posee permisos para ejecutar esta acción');

			$arrInversionista = ClsInversionistas::consultar($arrParametros);

			ClsUsuarios::editar([
				'usua_codigo' => $arrInversionista[0]['fk_seg_usuarios'],
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
	}*/
}