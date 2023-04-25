<?php

/**
 *
 */

class Page_indexController extends Page_mainController
{

  public function indexAction()
  {
    $this->_view->banner = $this->template->banner("1");
    $this->_view->contenido = $this->template->getContentseccion("1");


    $publicidadModel = new Page_Model_DbTable_Publicidad();
    $this->_view->bogota = $publicidadModel->getList("publicidad_id='9'")[0];
    $this->_view->cartagena = $publicidadModel->getList("publicidad_id='10'")[0];
  }
  public function contactAction()
  {
    $data = array();
    $res = array();
    $data['email'] = $this->_getSanitizedParam('email');
    $data['name'] = $this->_getSanitizedParam('name');
    $data['phone'] = $this->_getSanitizedParam('phone');
    $mail = $this->_getSanitizedParam('reason');
    $data['message'] = $this->_getSanitizedParam('message');

    $habeas_data = array();
    $habeas_data['data_name'] = $this->_getSanitizedParam('name');
    $habeas_data['data_mail'] = $this->_getSanitizedParam('email');
    $habeas_data['data_phone'] = $this->_getSanitizedParam('phone');
    $habeas_data['data_date'] = date('Y-m-d');
    $habeas_data['data_time'] = date('H:i:s');
    $habeas_data['data_ip'] = $_SERVER['REMOTE_ADDR'];
    $habeas_data['data_agree'] = $this->_getSanitizedParam('agree');

    $habeasdataModel = new Administracion_Model_DbTable_Habeasdata();
    $habeasdataModel->insert($habeas_data);

    $mailModel = new Core_Model_Sendingemail($this->_view);

    if ($mailModel->sendMailContact($data, $mail) == 1) {
      $res['status'] = 'ok';
    } else {
      $res['status'] = 'error';
    }
    die(json_encode($res));
  }
}
