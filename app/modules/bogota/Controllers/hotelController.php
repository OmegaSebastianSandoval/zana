<?php

/**
 *
 */

class Bogota_hotelController extends Bogota_mainController
{

	public function indexAction()
	{

		$this->_view->contenido = $this->template->getContentseccion("2");
		$this->_view->contenidoBogota = $this->template->getContentseccion("13");

		$planesModel = new Bogota_Model_DbTable_Planes();
		$this->_view->planes = $planesModel->getList("plan_ciudad ='Bogota' AND plan_estado= '1'", "orden ASC");
	}
	public function detalleAction()
	{
		$planesModel = new Bogota_Model_DbTable_Planes();

		$id = $this->_getSanitizedParam("id");
		$this->_view->plan = $planesModel->getById($id);
	}
}
