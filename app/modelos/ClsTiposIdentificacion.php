<?

include_once '../nucleo/Modelo.php';

class ClsTiposIdentificacion extends Modelo
{
	protected $strTabla = 'tb_par_tipos_identificacion';
	protected $strLlavePrimaria = 'tiid_codigo';
	protected $sqlSentencia = 'select tiid.*, esta.esta_descripcion
		from tb_par_tipos_identificacion tiid 
		join tb_par_estados esta on (tiid.fk_par_estados = esta.esta_codigo) ';
}