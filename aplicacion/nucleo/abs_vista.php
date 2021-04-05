<?php
namespace App\Nucleo;

use App\Config\Ruta;

/**
 * 
 */
abstract class VistaAbstracta
{
	/**
	 * @var string
	 */
	protected $plantilla_html;

	/**
	 * @var string
	 */
	public $cuerpo;

	/**
	 * @return string Paths
	 */
	public function imprimir() : string
	{
		return Ruta::arcPlantilla($this->plantilla_html);
	}

	/**
	 * @return string Paths
	 */
	public function cuerpo(): string
	{
		return Ruta::arcCuerpo(ICMP['controlador'], $this->cuerpo);
	}
}
?>