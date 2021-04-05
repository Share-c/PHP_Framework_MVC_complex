<?php

//////////////////////////////////
//								//
//			  eShare			//
//								//
//////////////////////////////////

/**
 * Definir DS como el separador de directorios.
 * @var string
 */
define('DS', DIRECTORY_SEPARATOR);
/**
 * Definir RUTA_RAIZ como ruta a la raíz de la app.
 * @var string Paths
 */
define('RUTA_RAIZ', realpath(__DIR__ . DS . '../') . DS);

/**
 * Se cargan las rutas de la aplicación.
 */
 require_once RUTA_RAIZ . 'aplicacion' . DS . 'configuracion' . DS . 'config_ruta.php';

 /**
 * ----------------------------------
 *  CARGAR LA APLICACIÓN
 * ----------------------------------
 **/
$app = require_once App\Config\Ruta::dirAuxiliar('lanzador.php');

 /**
 * ----------------------------------
 *  EJECUTAR LA APLICACIÓN
 * ----------------------------------
 **/
$app->ejecutar();
?>