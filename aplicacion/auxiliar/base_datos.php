<?php
namespace App\Auxiliar;

use App\Config\BD;
use Sis\Errores\AppError;
use \PDO;

/**
 * 
 */
abstract class BaseDatos extends BD
{
	
	/** 
	 * ---------------------------------
	 * 				  PDO
	 * ---------------------------------
	 */

	/**
	 * @var object PDO
	 */
	private static $instancaPDO;

	/**
	 * Se muestra un Error.
	 */
	public function __construct()
	{
		$e = new AppError('No está permitiodo llamar al consturctor de BaseDatos.', 1005);
		$e->mostrar();
		die();
	}

	/**
	 * @return object PDO $instanciaPDO
	 */
	protected static function conectarPDO() : object
	{
		if (null == self::$instancaPDO) 
		{
			try
			{
				$options = [
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				];

				self::$instancaPDO = BD::PDO_mySQL($options);
				self::$instancaPDO->exec("SET CHARACTER SET " . parent::$charset);

				return self::$instancaPDO;
				
			} catch (PDOException $e) {
   				$error = new AppError($e->getMessage(), 1015);
   				$error->mostrar();
   				die();
			}
		}
	}

	/**
	 * @return object = null
	 */
	protected static function desconectarPDO()
	{
		self::$instancaPDO = null;
	}
}
?>