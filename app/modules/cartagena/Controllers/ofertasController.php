<?php

/**
 *
 */

class Cartagena_ofertasController extends Cartagena_mainController
{

    public function indexAction()
    {

        $this->_view->contenido = $this->template->getContentseccion("12");
    }
}
