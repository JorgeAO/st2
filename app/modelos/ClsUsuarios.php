<?

include_once '../nucleo/Modelo.php';

class ClsUsuarios extends Modelo
{
	protected $strTabla = 'tb_seg_usuarios';
	protected $strLlavePrimaria = 'usua_codigo';
	protected $sqlSentencia = 'select usua.*, perf.perf_descripcion, esta.esta_descripcion
		from tb_seg_usuarios usua 
		left join tb_seg_perfiles perf on (usua.fk_seg_perfiles = perf.perf_codigo)
		join tb_par_estados esta on (usua.fk_par_estados = esta.esta_codigo) ';
}