<?

include_once '../nucleo/Modelo.php';

class ClsParticipacion extends Modelo
{
	protected $strTabla = 'tb_pre_participacion';
	protected $strLlavePrimaria = 'prpa_codigo';
	protected $sqlSentencia = 'select 
		prpa.*, 
		inve.inve_nombre,
		inve.inve_apellido,
		inve.inve_celular,
		inve.inve_correo
		from tb_pre_participacion prpa 
		join tb_pre_prestamos pres on (prpa.fk_pre_prestamos = pres.pres_codigo) 
		join tb_par_inversionistas inve on (prpa.fk_par_inversionistas = inve.inve_codigo) 
		';
}