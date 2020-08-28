<?

include_once '../nucleo/Modelo.php';

class ClsMovimientos extends Modelo
{
	protected $strTabla = 'tb_caj_movimientos';
	protected $strLlavePrimaria = 'movi_codigo';
	protected $sqlSentencia = 'select 
		movi.*, 
		date(movi_fecha) as fecha2,
		case movi_tipo
			when "E" then "Entrada"
			when "S" then "Salida"
		end as movi_tipo_2,
		inve.inve_nombre,
		inve.inve_apellido,
		inve.inve_celular,
		inve.inve_correo
		from tb_caj_movimientos movi 
		join tb_par_inversionistas inve on (movi.fk_par_inversionistas = inve.inve_codigo) ';
}