<?php
namespace Sis\Errores;

interface iErrores
{
	/**
	 * Función para mostrar el html de error.
	 * 
	 * @param string : idioma que se debe cargar.
	 * 
	 * @return require html
	 */	
	public function mostrar(string $idoma);

	/**
	 * Mensaje que se mostrará con el error.
	 * 
	 * @return string
	 */	
	public function mensaje();
}
?>