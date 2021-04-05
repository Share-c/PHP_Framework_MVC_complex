<?php
namespace App\Nucleo;

use App\Auxiliar\BaseDatos;

/**
 * 
 */
abstract class ModeloAbstracto extends BaseDatos
{
	/**
	 * @var object PDO
	 */
	protected static $DB_PDO;

	/**
	 * @return $DB_PDO
	 */
	public function __construct()
	{
		self::$DB_PDO = parent::conectarPDO();
	}	
}
?>