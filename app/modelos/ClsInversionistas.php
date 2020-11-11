<?

include_once '../nucleo/Modelo.php';

class ClsInversionistas extends Modelo
{
	protected $strTabla = 'tb_par_inversionistas';
	protected $strLlavePrimaria = 'inve_codigo';
	protected $sqlSentencia = 'select 
		inve.*, 
		tiid.tiid_descripcion,
		usua.usua_login,
		esta.esta_descripcion
		from tb_par_inversionistas inve 
		join tb_par_tipos_identificacion tiid on (inve.fk_par_tipos_identificacion = tiid.tiid_codigo)
		left join tb_seg_usuarios usua on (inve.fk_seg_usuarios = usua.usua_codigo)
		join tb_par_estados esta on (inve.fk_par_estados = esta.esta_codigo) 
		';
}