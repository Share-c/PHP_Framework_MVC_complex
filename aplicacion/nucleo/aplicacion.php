<?php
namespace App\Nucleo;

use App\Config\C_App;
use App\Config\Ruta;
use Sis\Errores\AppExcepcion;

/**
 * 
 */
class Aplicacion
{
	/**
	 * @var array
	 */ 
	private $url;

	/**
	 * @var object
	 */
	private $controlador;

	/**
	 * $url = [idioma(), controlador(), metodo(), [param()]]
	 * 
	 * @var array
	 */
	private $icmp = array();

	public function iniciar()
	{
		$this->url();
		$this->idioma();
		$this->controlador();
		$this->metodo();
		$this->params();

		//Se crea la constante con los datos mandados por $_GET['url'].
		define('ICMP', $this->icmp);

		//Se define el nombre ($n) del controlador a lanzar.
		$n = self::nombreControlador($this->icmp['controlador']);

		$this->controlador = new $n;
	}

	public function ejecutar()
	{
		$this->controlador->{ICMP['metodo']}(ICMP['params']);
	}

	/**
	 * @return $url
	 */
	private function url()
	{
		
		// $_GET['url'] definida en .htaccess	
		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = rtrim($url, '/');
		$url = filter_var($url, FILTER_SANITIZE_URL);
		$url = explode('/', $url);

		$this->url = $url;
	}

	/**
	 * @return $icmp['idioma']
	 */
	private function idioma()
	{
		// Se comprueba si se ha mandado algún idioma.
		if (empty($this->url[0])) 
		{
			// Se carga el idioma por defecto.
			$idioma = C_App::$idioma;
			// Como se ha mandado un $_GET['url'] = null, se le da también un contenedor por defecto.
			$this->url = [$idioma, C_App::$controlador];
		} else {
			$dirIdioma = Ruta::dirSistema() . DS . 'idiomas' . DS . $this->url[0];
			// Se verifica que exista el archivo de idioma.
			if (is_dir($dirIdioma))
			{
				// El idioma está en la aplicación. (sistema\idiomas\).
				$idioma = $this->url[0];
			} else {
				// Se da el idioma por defecto.
				$idioma = C_App::$idioma;
				// Se añade el idioma al array $url;
				array_unshift($this->url, $idioma);
			}
		}

		$this->icmp['idioma'] = $this->url[0];

		require_once Ruta::dirSistema('idiomas') . DS . 'idioma.php';
	}

	/**
	 * @return $icmp['controlador']
	 */
	private function controlador()
	{
		// Se comprueba si se manda un controlador.
		if (empty($this->url[1])) 
		{
			// Se carga el controlador por defecto.
			$controlador = C_App::$controlador; 
		} else {
			$controlador = $this->url[1];
		}

		try {
			// Se define la ruta al archivo del controlador.
			$archivoControlador = Ruta::archivoControlador($controlador);
			if (file_exists($archivoControlador)) 
			{
				// Se carga el controlador.
				require_once $archivoControlador;

				// Formatear nombre del controlador
				$nombreControlador = self::nombreControlador($controlador);
				
				// Se comprueba que exista la clase del controlador.
				if (! class_exists($nombreControlador)) 
				{
					throw new AppExcepcion('No se encuentra el controlador.', 404);
				}
			} else {
				throw new AppExcepcion('No se encuentra el archivo del controlador.', 404);
			}
			
		} catch (AppExcepcion $e) {
			$e->mostrar($this->icmp['idioma']);
			die();
		}

		$this->icmp['controlador'] = $controlador;
	}

	/**
	 * @return $url['metodo']
	 */
	private function metodo()
	{
		if (sizeof($this->url) > 2) 
		{
			try {
				// Comprobamos si el método que se ha mandado existe en el controlador.
				if (method_exists(self::nombreControlador($this->icmp['controlador']), $this->url[2])) 
				{
					// Ya se ha mandado un método válido.
					$metodo = $this->url[2];
				} else {
					throw new AppExcepcion('No se encuentra el método en el controlador.', 404);
				}
			} catch (AppExcepcion $e) {
				$e->mostrar($this->icmp['idioma']);
				die();
			}
		} else {
			# Se carga el método predefinido del controlador.
			$metodo = C_App::$metodo;
		}

		$this->icmp['metodo'] = $metodo;
	}

	/**
	 * Parametros que se pasan mediante GET o POST
	 * 
	 * @return $icmp['params']
	 */
	private function params()
	{
		$param = array();

		if ('POST' === $_SERVER['REQUEST_METHOD']) 
		{
			# Si se mandan los parametro por POST.
			$param = $_POST;
		} else {
			# Si se mandan los parametros por $_GET['url'];
			if (sizeof($this->url) > 3) 
			{
				for ($i=3; $i < sizeof($this->url); $i++) { 
					array_push($param, $this->url[$i]);
				}
			}
		}

		$this->icmp['params'] = $param;
	}

	/**
	 * Devuelve en nombre completo del controlador.
	 * 
	 * @param string
	 * 
	 * @return string
	 */
	private static function nombreControlador(string $controlador)
	{
		return 'App\MVC\Controlador' . ucfirst(strtolower($controlador));
	}
}
?>