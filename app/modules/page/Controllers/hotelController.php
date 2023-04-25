<?php 

/**
*
*/

class Page_hotelController extends Page_mainController
{

	public function indexAction()
	{

    $this->_view->contenido = $this->template->getContentseccion("2");
   	}
}