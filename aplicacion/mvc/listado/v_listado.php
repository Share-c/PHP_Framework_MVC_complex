<?php
namespace App\MVC;

use App\Nucleo\VistaAbstracta;
/**
 * 
 */
class VistaListado extends VistaAbstracta
{
	public function __construct()
	{
		$this->plantilla_html = 'html_lista';
	}
}
?> 