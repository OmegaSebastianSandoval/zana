<?php

/**
 *
 */

class Bogota_ofertasController extends Bogota_mainController
{

    public function indexAction()
    {

        $this->_view->contenido = $this->template->getContentseccion("11");
    }
}
