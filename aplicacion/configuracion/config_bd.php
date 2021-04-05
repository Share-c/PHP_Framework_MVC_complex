<?php
namespace App\Config;

use \PDO;

/**
 * Clase para almacenar los valores de acceso a la base de datos.
 */
abstract class BD
{	
	/**
	 * @var string
	 */
	protected static $sistema = "mysql";

	/**
	 * @var string
	 */
	protected static $baseDatos = "v0.3";
	
	/**
	 * @var string
	 */
	protected static $servidor = "localhost";
	
	/**
	 * @var string
	 */
	protected static $usuario = "root";
	
	/**
	 * @var string
	 */
	protected static $clave = "";
	
	/**
	 * @var string
	 */
	protected static $charset = "utf8mb4";
	
	/**
	 * @var string
	 */
	protected static $collate = "utf8mb4_unicode_ci";

	/**
	 * @return object
	 */
	protected function PDO_mySQL($opciones = null)
	{
		return new PDO(self::$sistema . ":host=" . self::$servidor . ";" . "dbname=" . self::$baseDatos , self::$usuario , self::$clave , $opciones);
	}
}
?>