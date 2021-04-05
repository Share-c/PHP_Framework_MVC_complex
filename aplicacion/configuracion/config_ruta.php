<?php
namespace App\Config;

/**
 * Clase a las rutas de la aplicación
 */
class Ruta
{
	/**
	 * Funcion que devuelve la ruta al directorio \sistema\$directorio
	 * 
	 * @param string | null : nombre del directorio (o archivo) en el directorio sistema
	 * 
	 * @return string Paths : ruta al directorio o archivo.
	 */
	public static function dirSistema(string $directorio = null) : string
	{
		return RUTA_RAIZ . 'sistema' . DS . $directorio;
	}

	/**
	 * @param string : nombre del directorio idioma (ISO639-1).
	 * 
	 * @return string Paths : ruta al directorio.
	 */
	public static function dirIdioma(string $idioma) : string
	{
		return self::dirSistema('idiomas') . DS . $idioma;
	}

	/**
	 * @param string : nombre del archivo idioma.
	 * 
	 * @return string Paths : ruta al directorio.
	 */
	public static function arcIdioma(string $idioma, string $archivo) 
	: string
	{
		return self::dirIdioma($idioma) . DS . $archivo . '.php';
	}

	/**
	 * @param string : nombre de la plantilla html.
	 * 
	 * @return string Paths : ruta al directorio.
	 */
	public static function arcPlantilla(string $archivo) : string
	{
		return Ruta::dirSistema('html') . DS . '_plantillas' . DS . $archivo . '.php';
	}

	/**
	 * @param string : nombre del cuerpo html.
	 * 
	 * @return string Paths : ruta al directorio.
	 */
	public static function arcCuerpo(string $controlador, string $archivo) : string
	{
		return Ruta::dirSistema('html') . DS . 'cuerpos' . DS . $controlador . DS . $archivo . '.php';
	}

	/**
	 * Funcion que devuelve la ruta al directorio \aplicacion\$archivo
	 * 
	 * @param string | null : nombre del directorio aplicacion.
	 * 
	 * @return string Paths : ruta al directorio o archivo.
	 */
	public static function dirAplicacion(string $archivo = null) : string
	{
		return RUTA_RAIZ . 'aplicacion' . DS . $archivo;
	}

	/**
	 * @param string | null : nombre del archivo.
	 * 
	 * @return string Paths : ruta al directorio o archivo.
	 */
	public static function dirAuxiliar(string $archivo = null) : string
	{
		return self::dirAplicacion('auxiliar') . DS . $archivo;
	}

	/**
	 * @param string | null : nombre del archivo.
	 * 
	 * @return string Paths : ruta al directorio o archivo.
	 */
	public static function dirConfiguracion(string $archivo = null) : string
	{
		return self::dirAplicacion('configuracion') . DS . $archivo;
	}

	/**
	 * Ruta al directorio del controlador MVC.
	 * 
	 * @param string : nombre del directorio-controlador
	 * 
	 * @return string Paths
	 */
	public static function dirMVC(string $controlador) : string
	{
		return self::dirAplicacion('mvc') . DS . $controlador;
	}

	/**
	 * Ruta al archivo del modelo.
	 * 
	 * @param string : nombre del modelo.
	 * 
	 * @return string Paths
	 */
	public static function archivoModelo(string $controlador) : string
	{
		return self::dirMVC($controlador) . DS . 'm_' . $controlador . '.php';
	}

	/**
	 * Ruta al archivo de la vista.
	 * 
	 * @param string : nombre de la vista.
	 * 
	 * @return string Paths
	 */
	public static function archivoVista(string $controlador) : string
	{
		return self::dirMVC($controlador) . DS . 'v_' . $controlador . '.php';
	}

	/**
	 * Ruta al archivo del controlador $controlador.
	 * 
	 * @param string : nombre del controlador.
	 * 
	 * @return string Paths
	 */
	public static function archivoControlador(string $controlador) : string
	{
		return self::dirMVC($controlador) . DS . 'c_' . $controlador . '.php';
	}

	/**
	 * @param string | null : nombre del archivo.
	 * 
	 * @return string Paths : ruta al directorio o archivo.
	 */
	public static function dirNucleo(string $archivo = null) : string
	{
		return realpath(self::dirAplicacion('nucleo') . DS . $archivo);
	}

	/**
	 * url a la cabecera de la aplicación.
	 * 
	 * @return string
	 */
	public static function urlLocal() : string
	{
		return sprintf( "%s://%s%s", isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http', $_SERVER['SERVER_NAME'], str_replace($_SERVER['DOCUMENT_ROOT'], "", str_replace(DS, "/", RUTA_RAIZ)));
	}

	/**
	 * url actual en la aplicación.
	 * !!!! Deve de estar definida la constante ICMP !!!!
	 * 
	 * @param array ICMP
	 * 
	 * @return string
	 */	
	public static function urlActual(array $icmp)
	{
		$param = null;

		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			$param = implode("/", $icmp['params']);
		}

		return self::urlLocal() . $icmp['idioma'] . "/" . $icmp['controlador'] . "/" .$icmp['metodo'] . "/" .$param . "/" ;
	}
}
?>