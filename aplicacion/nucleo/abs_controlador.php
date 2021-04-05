<?php
namespace App\Nucleo;

use App\Config\Ruta;
use Sis\Idioma;

/**
 * 
 */
abstract class ControladorAbstracto
{
	/**
	 * @var object
	 */
	protected $modelo;

	/**
	 * @var object
	 */
	protected $vista;

	/**
	 * Método por defecto en todos los controladores.
	 */
	abstract public function predefinido();

	/**
	 * @return object
	 */
	private function modelo()
	{
		require_once Ruta::archivoModelo(ICMP['controlador']);

		$nombreModelo = 'App\MVC\Modelo' . ucfirst(strtolower(ICMP['controlador']));

		return new $nombreModelo;
	}

	/**
	 * @return object
	 */
	private function vista()
	{
		require_once Ruta::archivoVista(ICMP['controlador']);

		$nombreVista = 'App\MVC\Vista' . ucfirst(strtolower(ICMP['controlador']));

		return new $nombreVista;
	}
	
	/**
	 * Instanciar la vista y el modelo.
	 * Cargar el idioma general.
	 */
	protected function lanzar()
	{
		$this->vista = $this->vista();
		$this->modelo = $this->modelo();
		Idioma::cargar('id_html');
	}
}
?>