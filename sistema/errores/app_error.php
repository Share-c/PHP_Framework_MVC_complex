<?php
namespace Sis\Errores;

use App\Config\Ruta;
use App\Config\C_App;

/**
 * 
 */
class AppError extends \Error implements iErrores
{
	/**
	 * Función para mostrar el html de error.
	 * 
	 * @return require html
	 */	
	public function mostrar(string $idioma = Cnull)
	{
		require Ruta::arcPlantilla('html_error');
	}

	/**
	 * Mensaje que se mostrará con el error.
	 * 
	 * @return string
	 */	
	public function mensaje()
	{
		if (true === C_App::$enDesarrollo)
		{
			//return print_r(parent:: getTrace());
			$idoma = require Ruta::dirSistema('idiomas') . DS . C_App::$idioma . DS . 'id_html.php';
			
			return '		<div>
				<b>' . $idioma['error'][parent::getCode()] . '</b>
				<b>' . parent::getMessage() . '</b>
				<br>
				Error en el archivo: <b>' . parent::getFile ( ) . '</b>, fila: <b>' . parent::getLine ( ) .'</b>
		</div>
';

		} else {
			return '		<div>
				' . "Fatal error." . '
		</div>
';
		}
	}
}
?>