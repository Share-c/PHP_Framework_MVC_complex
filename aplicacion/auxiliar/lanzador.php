<?php


/** 
 * ---------------------------------
 * CARGAR LAS CONFIGURACIONES
 * ---------------------------------
 * 
 * Se cargan los archivos donde estan las clases de configuración.
 */
require_once App\Config\Ruta::dirConfiguracion('config_app.php');
require_once App\Config\Ruta::dirConfiguracion('config_html.php');
require_once App\Config\Ruta::dirConfiguracion('config_bd.php');

/** 
 * ---------------------------------
 * CARGAR LOS ERRORES
 * ---------------------------------
 * 
 * Se cargan los archivos donde estan las clases de error y exception.
 */
require_once App\Config\Ruta::dirSistema('errores') . DS . 'interface.php';
require_once App\Config\Ruta::dirSistema('errores') . DS . 'app_error.php';
require_once App\Config\Ruta::dirSistema('errores') . DS . 'app_excepcion.php';

/** 
 * ---------------------------------
 * CARGAR ELEMENTOS COMUNES
 * ---------------------------------
 * 
 * Se cargan los archivos donde estan las clases de comunes.
 */
// Se carga la base de datos.
require_once App\Config\Ruta::dirAuxiliar('base_datos.php');

/** 
 * ---------------------------------
 * CARGAR LAS CLASES ABSTRACTAS MVC
 * ---------------------------------
 * 
 * Se cargan los archivos donde estan las clases abstractas MVC.
 */
require_once App\Config\Ruta::dirNucleo('abs_modelo.php');
require_once App\Config\Ruta::dirNucleo('abs_vista.php');
require_once App\Config\Ruta::dirNucleo('abs_controlador.php');

/** 
 * ---------------------------------
 * CARGAR LA APLICACION
 * ---------------------------------
 * 
 * Se cargan los archivos donde estan las clases abstractas MVC.
 */
require_once App\Config\Ruta::dirNucleo('aplicacion.php');

/**
 * ---------------------------------
 * INICIAR LA APLICACIÓN
 * ---------------------------------
 * 
 * Se instancia la aplicación y se inicia.
 */
$app = new App\Nucleo\Aplicacion();
$app->iniciar();

return $app;
?>