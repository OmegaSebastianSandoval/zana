<?php 

/**
*
*/

class Bogota_galeriaController extends Bogota_mainController
{

	public function indexAction()
	{
		$imagenesModel = new Page_Model_DbTable_Imagenesgaleria();
		$filters = "imagen_estado = 1 AND imagen_galeria = '2' ";
		$order = " orden ASC";
		$list = $imagenesModel->getListCount($filters, $order)[0];
		$amount = 15;
		$page = $this->_getSanitizedParam("page");
		if (!$page) {
			$start = 0;
			$page = 1;
		} else {
			$start = ($page - 1) * $amount;
		}
		$this->_view->totalpages = ceil($list->total / $amount);
		$this->_view->page = $page;
		$this->_view->imagenes = $imagenesModel->getListPages($filters, $order, $start, $amount);
        
        
  /*   $imagenesModel = new Page_Model_DbTable_Imagenesgaleria();
    $this->_view->imagenes = $imagenesModel->getList("imagen_estado = '1'", "orden ASC");
 */	}
}