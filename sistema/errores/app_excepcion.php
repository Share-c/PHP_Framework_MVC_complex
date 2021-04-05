<?php
namespace Sis\Errores;

use App\Config\Ruta;
use App\Config\C_App;

/**
 * 
 */
class AppExcepcion extends \Exception implements iErrores
{
	/**
	 * @var array
	 */	
	private $idioma;

	/**
	 * Función para mostrar el html de error.
	 * 
	 * @param string
	 * 
	 * @return require html
	 */	
	public function mostrar(string $idioma)
	{
		$this->idioma = require realpath(Ruta::dirSistema('idiomas') . DS . $idioma . DS . 'id_html.php');

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
			
			return '		<div>
				<b>' . parent::getMessage() . '</b>
				<br>
				Error en el archivo: <b>' . parent::getFile ( ) . '</b>, fila: <b>' . parent::getLine ( ) .'</b>
		</div>
';

		} else {
			return '		<div>
				' . $this->idioma['exception'][parent::getCode()] . '
		</div>
';
		}
	}

}
?>