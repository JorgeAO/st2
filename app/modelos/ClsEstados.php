<?

include_once '../nucleo/Modelo.php';

class ClsEstados extends Modelo
{
	protected $strTabla = 'tb_par_estados';
	protected $strLlavePrimaria = 'esta_codigo';
	protected $sqlSentencia = 'select esta.* from tb_par_estados esta ';
}