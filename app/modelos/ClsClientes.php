<?

include_once '../nucleo/Modelo.php';

class ClsClientes extends Modelo
{
	protected $strTabla = 'tb_par_clientes';
	protected $strLlavePrimaria = 'clie_codigo';
	protected $sqlSentencia = 'select 
		clie.*, 
		tiid.tiid_descripcion,
		usua.usua_login,
		esta.esta_descripcion
		from tb_par_clientes clie 
		join tb_par_tipos_identificacion tiid on (clie.fk_par_tipos_identificacion = tiid.tiid_codigo)
		left join tb_seg_usuarios usua on (clie.fk_seg_usuarios = usua.usua_codigo)
		join tb_par_estados esta on (clie.fk_par_estados = esta.esta_codigo) 
		';
}