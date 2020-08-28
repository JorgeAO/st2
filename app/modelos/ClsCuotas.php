<?

include_once '../nucleo/Modelo.php';

class ClsCuotas extends Modelo
{
	protected $strTabla = 'tb_pre_cuotas';
	protected $strLlavePrimaria = 'prcu_codigo';
	protected $sqlSentencia = 'select 
		prcu.*,
		esta.esta_descripcion
		from tb_pre_cuotas prcu 
		join tb_par_estados esta on (prcu.fk_par_estados = esta.esta_codigo) 
		';
}