<?php

/**
 *
 */

class Page_ofertasController extends Page_mainController
{

    public function indexAction()
    {
        $this->_view->ofertasBogota = $this->template->getContentseccion("11");
        $this->_view->ofertasCartagena = $this->template->getContentseccion("12");
    }
}
