<?php

/**
 *
 */

class Page_cartagenaController extends Page_mainController
{

    public function indexAction()
    {
        $this->_view->banner = $this->template->banner("10");
        $this->_view->contenido = $this->template->getContentseccion("10");
    $this->_view->bannerGaleria = $this->template->bannersimple(11);

        
    }
}
