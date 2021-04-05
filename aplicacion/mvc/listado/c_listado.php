<?php
namespace App\MVC;

use App\Nucleo\ControladorAbstracto;
use Sis\Idioma;

/**
 * 
 */
class ControladorListado extends ControladorAbstracto
{
	public function __construct()
	{
		parent::lanzar();
		Idioma::cargar('id_lista');
	}

	public function predefinido()
	{
		$this->vista->cuerpo = 'lc_predefindio';
		require_once $this->vista->imprimir();
	}
}
?>