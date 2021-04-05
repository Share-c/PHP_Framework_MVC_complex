<?php
namespace App\Config;

/**
 * Clase para almacenar los valores por defecto de la apliación.
 */
class C_App
{
	/**
	 * Nombre de la carpeta del idioma por defecto.
	 * 
	 * @var string
	 */
	public static $idioma = "es";

	/**
	 * Nombre de la carpeta de mvc (controlador) por defecto.
	 * 
	 * @var string
	 */
	public static $controlador = "listado";

	/**
	 * Nombre del método usado por defecto.
	 * 
	 * @var string
	 */
	public static $metodo = "predefinido";

	/**
	 * Nombre de la aplicación.
	 * 
	 * @var string
	 */
	public static $nombreAplicacion = "eShare";

	/**
	 * Describe si la aplicación está en modo desarrollo (ver explicación de errores).
	 * 
	 * @var bool
	 */
	public static $enDesarrollo = true;

}
?> 