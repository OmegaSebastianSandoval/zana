<?php 

/**
*
*/

class Page_lineasdenegocioController extends Page_mainController
{

	public function indexAction()
	{
    $this->_view->banner = $this->template->banner("3");
    $this->_view->contenido = $this->template->getContentseccion("3");

    $lineasModel = new Administracion_Model_DbTable_Lineasdenegocio();
    $lineas = $lineasModel->getList("contenido_estado = '1'" , "orden ASC");

    $imagenesModel = new Administracion_Model_DbTable_Imageneslineas();

    foreach ($lineas as $key => $value) {
      $value->imagenes = $imagenesModel->getList("imagen_linea = ".$value->contenido_id, "orden ASC");
    }

    $this->_view->lineas = $lineas;
  }
}