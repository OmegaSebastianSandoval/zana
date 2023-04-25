<?php

/**
 *
 */

class Bogota_emprendimientoController extends Bogota_mainController
{

    public function indexAction()
    {
		$emprendimientoModel = new Bogota_Model_DbTable_Emprendimiento();
		$filters = "emprendimiento_estado = 1 AND emprendimiento_ciudad = 'Bogota'";
		$order = "orden ASC";
		$list = $emprendimientoModel->getListCount($filters, $order)[0];
		$amount = 9;
		$page = $this->_getSanitizedParam("page");
		if (!$page) {
			$start = 0;
			$page = 1;
		} else {
			$start = ($page - 1) * $amount;
		}
		$this->_view->totalpages = ceil($list->total / $amount);
		$this->_view->page = $page;
		$this->_view->emprendimiento = $emprendimientoModel->getListPages($filters, $order, $start, $amount);
        
        
  /*       $emprendimientoModel = new Bogota_Model_DbTable_Emprendimiento();
        $this->_view->emprendimiento = $emprendimientoModel->getList("emprendimiento_estado = '1' AND emprendimiento_ciudad = 'Bogota'", "orden ASC");
 */    }
    public function detalleAction()
    {
        $emprendimientoModel = new Bogota_Model_DbTable_Emprendimiento();

        $id = $this->_getSanitizedParam("id");
        $this->_view->emprendimiento = $emprendimientoModel->getById($id);
        $this->_view->destacados = $emprendimientoModel->getList("emprendimiento_estado = '1' AND emprendimiento_ciudad = 'Bogota' AND emprendimiento_importante = '1' AND emprendimiento_id != '$id' ", "orden ASC LIMIT 3");
    }
}
