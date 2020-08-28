<?

include_once '../app/modelos/ClsPermisos.php';

class CtrlPermisos
{
	public function menu()
	{
		try 
		{
			session_start();
			$strMenu = ClsPermisos::strMenuNav($_SESSION['usuario_sesion'][0]['fk_seg_perfiles']);

			$obRta->tipo = 'exito';
			$obRta->mensaje = $strMenu;
			return $obRta;
		} 
		catch (Exception $e) 
		{
			throw new Exception($e->getMessage());
		}
	}

	public function insertar($arrParametros)
	{
		try 
		{
			ClsPermisos::eliminar([
				'fk_seg_perfiles'=>$arrParametros['fk_seg_perfiles']
			]);

			// Recorrer el listado de los permisos
			foreach ($arrParametros['permisos'] as $key => $value) 
			{
				// Separar el tipo de permiso (Create, Read, Update, Delete, List)
				$strPermiso = explode('_', $value['name']);
				
				// Saltar la primera fila
				if ($strPermiso[1] == 'permisos') 
					continue;

				// Tipos de permisos
				$arrTipoPermiso = array('c'=>'perm_c','r'=>'perm_r','u'=>'perm_u','d'=>'perm_d','l'=>'perm_l');
					
				// Identificar el permiso que se va a insertar
				$strCampo = $arrTipoPermiso[$strPermiso[1]];

				// Consultar si el permiso ya existe
				$arrConsulta = ClsPermisos::consultar([
					'fk_seg_perfiles'=>$arrParametros['fk_seg_perfiles'],
					'fk_seg_opciones'=>$strPermiso[0]
				]);

				// Si el permiso no existe
				if (count($arrConsulta) == 0)
				{
					// Insertar permiso
					ClsPermisos::insertar([
						'fk_seg_perfiles'=>$arrParametros['fk_seg_perfiles'],
						'fk_seg_opciones'=>$strPermiso[0],
						$arrTipoPermiso[$strPermiso[1]]=>'1'
					]);
				}
				// Si el permiso ya existe
				else 
				{
					// Modificar el registro
					ClsPermisos::editar([
						'perm_codigo'=>$arrConsulta[0]['perm_codigo'],
						$arrTipoPermiso[$strPermiso[1]]=>'1'
					]);
				}
			}

			$obRta->tipo = 'exito';
			$obRta->mensaje = 'El proceso se realizó con éxito';
			return $obRta;
		} 
		catch (Exception $e) 
		{
			throw new Exception($e->getMessage());
		}
	}

	public function ver($arrParametros = [])
	{
		try 
		{
			if (!ClsPermisos::blValidarPermiso(1003, 'r'))
				throw new Exception('Usted no posee permisos para ejecutar esta acción');

			$arrResultados = ClsPermisos::arrVerPermisos($arrParametros['fk_seg_perfiles']);

			$objRta->tipo = 'exito';
			$objRta->datos = $arrResultados;
			return $objRta;
		} 
		catch (Exception $e) 
		{
			throw new Exception($e->getMessage());
		}
	}
}