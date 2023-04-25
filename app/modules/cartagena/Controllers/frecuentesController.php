<?php 

/**
*
*/

class Page_frecuentesController extends Page_mainController
{

	public function indexAction()
	{
    $this->_view->banner = $this->template->banner("2");
    $this->_view->contenido = $this->template->getContentseccion("2");
    $frecuentesModel = new Administracion_Model_DbTable_Frecuentes();
    $this->_view->frecuentes = $frecuentesModel->getList("frecuente_estado = '1'", "orden ASC");
	}
}