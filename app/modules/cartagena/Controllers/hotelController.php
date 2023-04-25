<?php

/**
 *
 */

class Cartagena_hotelController extends Cartagena_mainController
{

	public function indexAction()
	{

		$this->_view->contenido = $this->template->getContentseccion("2");
		$this->_view->contenidoCartagena = $this->template->getContentseccion("14");
		$planesModel = new Cartagena_Model_DbTable_Planes();
		$this->_view->planes = $planesModel->getList("plan_ciudad ='Cartagena' AND plan_estado= '1'", "orden ASC");
	}
	public function detalleAction()
    {
        $planesModel = new Cartagena_Model_DbTable_Planes();

        $id = $this->_getSanitizedParam("id");
        $this->_view->plan = $planesModel->getById($id);
		
    }
}
