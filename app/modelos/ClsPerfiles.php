<?

include_once '../nucleo/Modelo.php';

class ClsPerfiles extends Modelo
{
	protected $strTabla = 'tb_seg_perfiles';
	protected $strLlavePrimaria = 'perf_codigo';
	protected $sqlSentencia = 'select perf.*, esta.esta_descripcion
		from tb_seg_perfiles perf 
		join tb_par_estados esta on (perf.fk_par_estados = esta.esta_codigo) ';
}