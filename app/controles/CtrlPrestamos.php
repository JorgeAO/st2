<?php

include_once '../app/modelos/ClsPrestamos.php';
include_once '../app/modelos/ClsInversionistas.php';
include_once '../app/modelos/ClsCuotas.php';
include_once '../app/modelos/ClsMovimientos.php';
include_once '../app/modelos/ClsParticipacion.php';
include_once '../nucleo/Control.php';

class CtrlPrestamos extends Control
{
	protected $intOpcion = 4001;
	protected $strClase = 'ClsPrestamos';

	public function intCalcular($arrParametros)
	{
		try 
		{

			$strMensaje = '';

			if ($arrParametros['pres_vlr_monto'] == '')
				$strMensaje .= 'Ingrese el valor\n';
			if ($arrParametros['pres_nro_cuotas'] == '')
				$strMensaje .= 'Ingrese el número de cuotas\n';
			if ($arrParametros['pres_plazo'] == '')
				$strMensaje .= 'Ingrese el plazo\n';
			if ($arrParametros['pres_interes'] == '')
				$strMensaje .= 'Ingrese el interés\n';
			
			if (!empty($strMensaje))
				throw new Exception('\n'.$strMensaje);

			$flInteresMensual = $arrParametros['pres_vlr_monto'] * $arrParametros['pres_interes'] / 100;
			$flInteresTotal = $flInteresMensual * $arrParametros['pres_plazo'];
			$flTotalPago = $arrParametros['pres_vlr_monto'] + $flInteresTotal;
			$flCuota = $flTotalPago / $arrParametros['pres_nro_cuotas'];

			$arrCalculo[0]['pres_int_mensual'] = round($flInteresMensual, -2);
			$arrCalculo[0]['pres_int_total'] = round($flInteresTotal, -2);
			$arrCalculo[0]['pres_vlr_pago'] = round($flTotalPago, -2);
			$arrCalculo[0]['pres_vlr_cuota'] = round($flCuota, -2);

			$objRta->tipo = 'exito';
			$objRta->datos = $arrCalculo;
			return $objRta;
		} 
		catch (Exception $e) 
		{
			throw new Exception('CtrlPrestamos.intCalcular: '.$e->getMessage());
		}
	}

	public function insertar($arrParametros)
	{
		try 
		{
			if (!ClsPermisos::blValidarPermiso($this->intOpcion, 'c'))
				throw new Exception('Usted no posee permisos para ejecutar esta acción');

			// Consultar los inversionistas activos
			$arrInversionistas = ClsInversionistas::consultar([
				'inve.fk_par_estados' => 1
			]);

			// Calcular el capital disponible y el mínimo por inversionista
			$dbCapitalDispo = 0;
			$arrMontoXInver = array();
			foreach ($arrInversionistas as $key => $value)
			{
				$dbCapitalDispo += $value['inve_saldo'];
				$arrMontoXInver[$value['inve_codigo']]['inve_saldo'] = $value['inve_saldo'];
				$arrMontoXInver[$value['inve_codigo']]['inve_saldo_min'] = $value['inve_saldo_min'];
			}

			// Calcular porcentaje de partcipación de los inversionistas
			// la cantidad que aporta cada uno
			// el saldo restante
			foreach ($arrMontoXInver as $key => $value) 
			{
				$dbPorcentaje = 0;
				$dbAporte = 0;
				$dbSaldo = 0;
				
				$dbPorcentaje = round(($value['inve_saldo'] / $dbCapitalDispo * 100), 2);
				$dbAporte = $arrParametros['pres_vlr_monto'] * $dbPorcentaje / 100;
				$dbSaldo = $value['inve_saldo'] - $dbAporte;

				$arrMontoXInver[$key]['part_porcentaje'] = $dbPorcentaje;
				$arrMontoXInver[$key]['part_monto'] = $dbAporte;
				$arrMontoXInver[$key]['saldo_final'] = $dbSaldo;
			}

			// Insertar el registro del préstamo
			$arrPrestamo = ClsPrestamos::insertar([
				'fk_par_clientes' => $arrParametros['fk_par_clientes'],
				'pres_fecha' => $arrParametros['pres_fecha'],
				'pres_vlr_monto' => $arrParametros['pres_vlr_monto'],
				'pres_frecuencia' => $arrParametros['pres_frecuencia'],
				'pres_nro_cuotas' => $arrParametros['pres_nro_cuotas'],
				'pres_plazo' => $arrParametros['pres_plazo'],
				'pres_interes' => $arrParametros['pres_interes'],
				'pres_int_mensual' => $arrParametros['pres_int_mensual'],
				'pres_int_mensual' => $arrParametros['pres_int_mensual'],
				'pres_int_total' => $arrParametros['pres_int_total'],
				'pres_vlr_pago' => $arrParametros['pres_vlr_pago'],
				'pres_vlr_cuota' => $arrParametros['pres_vlr_cuota'],
				'fc' => date('Y-m-d H:m:s'),
				'uc' => $_SESSION['usuario_sesion'][0]['usua_codigo']
			]);

			// Calular la cuotas y crear el registro de cada una
			for ($i = 1; $i <= $arrParametros['pres_nro_cuotas']; $i++)
			{
				$strFrecuencia = '';
				if ($arrParametros['pres_frecuencia'] == 'S')
					$strFrecuencia = $i.' weeks';
				else if ($arrParametros['pres_frecuencia'] == 'Q')
					$strFrecuencia = ($i*2).' weeks';
				else if ($arrParametros['pres_frecuencia'] == 'M')
					$strFrecuencia = $i.' months';

				if ($strFrecuencia == '')
					throw new Exception('No se pudo calcular la frecuencia de las cuotas');

				ClsCuotas::insertar([
					'fk_pre_prestamos' => $arrPrestamo['insert_id'],
					'prcu_numero' => $i,
					'prcu_fecha' => date('Y-m-d', strtotime('+'.$strFrecuencia, strtotime($arrParametros['pres_fecha']))),
					'prcu_valor' => $arrParametros['pres_vlr_cuota']
				]);
			}

			/**
			 * Modificar el saldo de cada inversionista
			 * Insertar el registro del movimiento en la caja
			 * Insertar el registro de participación en el préstamo
			 */
			foreach ($arrMontoXInver as $key => $value)
			{
				ClsInversionistas::editar([
					'inve_codigo' => $key,
					'inve_saldo' => $value['saldo_final']
				]);

				ClsMovimientos::insertar([
					'fk_par_inversionistas' => $key,
					'movi_tipo' => 'S',
					'movi_descripcion' => 'participación en el prestamo '.$arrPrestamo['insert_id'],
					'movi_fecha' => $arrParametros['pres_fecha'],
					'movi_monto' => $value['part_monto'],
					'fc' => date('Y-m-d H:m:s'),
					'uc' => $_SESSION['usuario_sesion'][0]['usua_codigo']
				]);

				ClsParticipacion::insertar([
					'fk_pre_prestamos' => $arrPrestamo['insert_id'],
					'fk_par_inversionistas' => $key,
					'prpa_porcentaje' => $value['part_porcentaje']
				]);
			}

			$objRta->tipo = 'exito';
			$objRta->mensaje = 'El proceso se realizó con éxito';
			return $objRta;

			print_r($arrParametros);
			exit();
		} 
		catch (Exception $e) 
		{
			throw new Exception('CtrlMovimientos.insertar: '.$e->getMessage());
		}
	}

	public function detalles($arrParametros)
	{
		try 
		{
			// Consultar los préstamos para obtener la información general
			$clsPrestamos = new ClsPrestamos();
			$arrPrestamos = $clsPrestamos->consultar([ 
				'pres.pres_codigo' => $arrParametros['pres_codigo'] 
			]);

			// Consultar cuotas
			$clsCoutas = new ClsCuotas();
			$arrCuotas = $clsCoutas->consultar([ 'fk_pre_prestamos' => $arrParametros['pres_codigo'] ]);

			// Consultar participación
			$clsParticipacion = new ClsParticipacion();
			$arrParticipacion = $clsParticipacion->consultar([ 'fk_pre_prestamos' => $arrParametros['pres_codigo'] ]);

			$arrDatos['prestamo'] = $arrPrestamos;
			$arrDatos['cuotas'] = $arrCuotas;
			$arrDatos['participacion'] = $arrParticipacion;

			$objRta->tipo = 'exito';
			$objRta->datos = $arrDatos;
			return $objRta;
		} 
		catch (Exception $e) 
		{
			throw new Exception('CtrlPrestamos.detalles: '.$e->getMessage());
		}
	}

	public function pago($arrParametros = [])
	{
		try 
		{
			var_dump($arrParametros);
			exit();
		}
		catch (Exception $e) 
		{
			throw new Exception('CtrlPrestamos.pago: '.$e->getMessage());
		}
	}
}