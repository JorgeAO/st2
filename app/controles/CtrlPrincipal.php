<?php

include_once '../app/modelos/ClsPrestamos.php';
include_once '../app/modelos/ClsClientes.php';
include_once '../app/modelos/ClsInversionistas.php';
include_once '../nucleo/Control.php';

class CtrlPrincipal
{
	public function consultarTarjetas($arrParametros = [])
    {
        try 
        {
            // Consultar prestamos
            $clsPrestamos = new ClsPrestamos();
            $arrPrestamos = $clsPrestamos->consultar([ 'pres.fk_par_estados' => 1 ]);

            // Consultar clientes
            $clsClientes = new ClsClientes();
            $arrClientes = $clsClientes->consultar([ 'clie.fk_par_estados' => 1 ]);

            // Consultar inversionistas
            $clsInversionistas = new ClsInversionistas();
            $arrInversionistas = $clsInversionistas->consultar([ 'inve.fk_par_estados' => 1 ]);

            $arrDatos['fecha'] = date('Y-m-d');
            $arrDatos['prestamos'] = count($arrPrestamos);
            $arrDatos['clientes'] = count($arrClientes);
            $arrDatos['inversionistas'] = count($arrInversionistas);

			$objRta->tipo = 'exito';
			$objRta->datos = $arrDatos;
			return $objRta;
        } 
        catch (Exception $e) 
        {
            throw new Exception($e->getMessage());
        }
    }
}

?>