<?php

/**
 * Controlador de Habeasdata que permite la  creacion, edicion  y eliminacion de los Habeas data del Sistema
 */

use Dompdf\Dompdf;

class Administracion_habeasdataController extends Administracion_mainController
{
  public $botonpanel = 12;
  /**
   * $mainModel  instancia del modelo de  base de datos Habeas data
   * @var modeloContenidos
   */
  public $mainModel;

  /**
   * $route  url del controlador base
   * @var string
   */
  protected $route;

  /**
   * $pages cantidad de registros a mostrar por pagina]
   * @var integer
   */
  protected $pages;

  /**
   * $namefilter nombre de la variable a la fual se le van a guardar los filtros
   * @var string
   */
  protected $namefilter;

  /**
   * $_csrf_section  nombre de la variable general csrf  que se va a almacenar en la session
   * @var string
   */
  protected $_csrf_section = "administracion_habeasdata";

  /**
   * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
   * @var string
   */
  protected $namepages;



  /**
   * Inicializa las variables principales del controlador habeasdata .
   *
   * @return void.
   */
  public function init()
  {
    $this->mainModel = new Administracion_Model_DbTable_Habeasdata();
    $this->namefilter = "parametersfilterhabeasdata";
    $this->route = "/administracion/habeasdata";
    $this->namepages = "pages_habeasdata";
    $this->namepageactual = "page_actual_habeasdata";
    $this->_view->route = $this->route;
    if (Session::getInstance()->get($this->namepages)) {
      $this->pages = Session::getInstance()->get($this->namepages);
    } else {
      $this->pages = 20;
    }
    parent::init();
  }


  /**
   * Recibe la informacion y  muestra un listado de  Habeas data con sus respectivos filtros.
   *
   * @return void.
   */
  public function indexAction()
  {
    $title = "Aministración de Habeas data";
    $this->getLayout()->setTitle($title);
    $this->_view->titlesection = $title;
    $this->filters();
    $this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
    $filters = (object)Session::getInstance()->get($this->namefilter);
    $this->_view->filters = $filters;
    $filters = $this->getFilter();
    $order = "data_id DESC";
    $list = $this->mainModel->getList($filters, $order);
    $amount = $this->pages;
    $page = $this->_getSanitizedParam("page");
    if (!$page && Session::getInstance()->get($this->namepageactual)) {
      $page = Session::getInstance()->get($this->namepageactual);
      $start = ($page - 1) * $amount;
    } else if (!$page) {
      $start = 0;
      $page = 1;
      Session::getInstance()->set($this->namepageactual, $page);
    } else {
      Session::getInstance()->set($this->namepageactual, $page);
      $start = ($page - 1) * $amount;
    }
    $this->_view->register_number = count($list);
    $this->_view->pages = $this->pages;
    $this->_view->totalpages = ceil(count($list) / $amount);
    $this->_view->page = $page;
    $this->_view->lists = $this->mainModel->getListPages($filters, $order, $start, $amount);
    $this->_view->csrf_section = $this->_csrf_section;
    $this->_view->list_data_agree = $this->getDataagree();
  }

  /**
   * Genera la Informacion necesaria para editar o crear un  Habeas data  y muestra su formulario
   *
   * @return void.
   */
  public function manageAction()
  {
    $this->_view->route = $this->route;
    $this->_csrf_section = "manage_habeasdata_" . date("YmdHis");
    $this->_csrf->generateCode($this->_csrf_section);
    $this->_view->csrf_section = $this->_csrf_section;
    $this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
    $this->_view->list_data_agree = $this->getDataagree();
    $id = $this->_getSanitizedParam("id");
    if ($id > 0) {
      $content = $this->mainModel->getById($id);
      if ($content->data_id) {
        $this->_view->content = $content;
        $this->_view->routeform = $this->route . "/update";
        $title = "Actualizar Habeas data";
        $this->getLayout()->setTitle($title);
        $this->_view->titlesection = $title;
      } else {
        $this->_view->routeform = $this->route . "/insert";
        $title = "Crear Habeas data";
        $this->getLayout()->setTitle($title);
        $this->_view->titlesection = $title;
      }
    } else {
      $this->_view->routeform = $this->route . "/insert";
      $title = "Crear Habeas data";
      $this->getLayout()->setTitle($title);
      $this->_view->titlesection = $title;
    }
  }

  /**
   * Inserta la informacion de un Habeas data  y redirecciona al listado de Habeas data.
   *
   * @return void.
   */
  public function insertAction()
  {
    $this->setLayout('blanco');
    $csrf = $this->_getSanitizedParam("csrf");
    if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {
      $data = $this->getData();
      $id = $this->mainModel->insert($data);

      $data['data_id'] = $id;
      $data['log_log'] = print_r($data, true);
      $data['log_tipo'] = 'CREAR HABEAS DATA';
      $logModel = new Administracion_Model_DbTable_Log();
      $logModel->insert($data);
    }
    header('Location: ' . $this->route . '' . '');
  }

  /**
   * Recibe un identificador  y Actualiza la informacion de un Habeas data  y redirecciona al listado de Habeas data.
   *
   * @return void.
   */
  public function updateAction()
  {
    $this->setLayout('blanco');
    $csrf = $this->_getSanitizedParam("csrf");
    if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {
      $id = $this->_getSanitizedParam("id");
      $content = $this->mainModel->getById($id);
      if ($content->data_id) {
        $data = $this->getData();
        $this->mainModel->update($data, $id);
      }
      $data['data_id'] = $id;
      $data['log_log'] = print_r($data, true);
      $data['log_tipo'] = 'EDITAR HABEAS DATA';
      $logModel = new Administracion_Model_DbTable_Log();
      $logModel->insert($data);
    }
    header('Location: ' . $this->route . '' . '');
  }

  /**
   * Recibe un identificador  y elimina un Habeas data  y redirecciona al listado de Habeas data.
   *
   * @return void.
   */
  public function deleteAction()
  {
    $this->setLayout('blanco');
    $csrf = $this->_getSanitizedParam("csrf");
    if (Session::getInstance()->get('csrf')[$this->_csrf_section] == $csrf) {
      $id =  $this->_getSanitizedParam("id");
      if (isset($id) && $id > 0) {
        $content = $this->mainModel->getById($id);
        if (isset($content)) {
          $this->mainModel->deleteRegister($id);
          $data = (array)$content;
          $data['log_log'] = print_r($data, true);
          $data['log_tipo'] = 'BORRAR HABEAS DATA';
          $logModel = new Administracion_Model_DbTable_Log();
          $logModel->insert($data);
        }
      }
    }
    header('Location: ' . $this->route . '' . '');
  }

  /**
   * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Habeasdata.
   *
   * @return array con toda la informacion recibida del formulario.
   */
  private function getData()
  {
    $data = array();
    $data['data_name'] = $this->_getSanitizedParam("data_name");
    $data['data_mail'] = $this->_getSanitizedParam("data_mail");
    $data['data_phone'] = $this->_getSanitizedParam("data_phone");
    $data['data_date'] = $this->_getSanitizedParam("data_date");
    $data['data_time'] = $this->_getSanitizedParam("data_time");
    $data['data_ip'] = $this->_getSanitizedParam("data_ip");
    $data['data_agree'] = $this->_getSanitizedParam("data_agree");
    return $data;
  }

  /**
   * Genera los valores del campo Aceptaci&oacute;n.
   *
   * @return array cadena con los valores del campo Aceptaci&oacute;n.
   */
  private function getDataagree()
  {
    $array = array();
    $array[''] = 'No acepta';
    $array['1'] = 'Acepta';
    return $array;
  }

  /**
   * Genera la consulta con los filtros de este controlador.
   *
   * @return array cadena con los filtros que se van a asignar a la base de datos
   */
  protected function getFilter()
  {
    $filtros = " 1 = 1 ";
    if (Session::getInstance()->get($this->namefilter) != "") {
      $filters = (object)Session::getInstance()->get($this->namefilter);
      if ($filters->data_name != '') {
        $filtros = $filtros . " AND data_name LIKE '%" . $filters->data_name . "%'";
      }
      if ($filters->data_date != '') {
        $filtros = $filtros . " AND data_date LIKE '%" . $filters->data_date . "%'";
      }
      if ($filters->data_time != '') {
        $filtros = $filtros . " AND data_time LIKE '%" . $filters->data_time . "%'";
      }
      if ($filters->data_ip != '') {
        $filtros = $filtros . " AND data_ip LIKE '%" . $filters->data_ip . "%'";
      }
      if ($filters->data_agree != '') {
        $filtros = $filtros . " AND data_agree ='" . $filters->data_agree . "'";
      }
    }
    return $filtros;
  }

  /**
   * Recibe y asigna los filtros de este controlador
   *
   * @return void
   */
  protected function filters()
  {
    if ($this->getRequest()->isPost() == true) {
      Session::getInstance()->set($this->namepageactual, 1);
      $parramsfilter = array();
      $parramsfilter['data_name'] =  $this->_getSanitizedParam("data_name");
      $parramsfilter['data_date'] =  $this->_getSanitizedParam("data_date");
      $parramsfilter['data_time'] =  $this->_getSanitizedParam("data_time");
      $parramsfilter['data_ip'] =  $this->_getSanitizedParam("data_ip");
      $parramsfilter['data_agree'] =  $this->_getSanitizedParam("data_agree");
      Session::getInstance()->set($this->namefilter, $parramsfilter);
    }
    if ($this->_getSanitizedParam("cleanfilter") == 1) {
      Session::getInstance()->set($this->namefilter, '');
      Session::getInstance()->set($this->namepageactual, 1);
    }
  }


  public function exportexcelAction()
  {
    $this->setLayout('blanco');

    $dataAgree = $this->getDataagree();

    $output = '';

    $output .= '<table border="1" cellspacing="0" cellpadding="5">';
    $output .= '
    <tr>
      <th>Nombre</th>
      <th>Correo</th>
      <th>Tel&eacute;fono</th>
      <th>Fecha</th>
      <th>Hora</th>
      <th>IP</th>
      <th>Aceptaci&oacute;n</th>
    </tr>';

    $habeasdataModel = new Administracion_Model_DbTable_Habeasdata();

    $data = $habeasdataModel->getList('', 'data_id DESC');

    foreach ($data as $row) {
      $output .= '
      <tr>
        <td>' . $row->data_name . '</td>
        <td>' . $row->data_mail . '</td>
        <td>' . $row->data_phone . '</td>
        <td>' . $row->data_date . '</td>
        <td>' . $row->data_time . '</td>
        <td>' . $row->data_ip . '</td>
        <td>' . $dataAgree[$row->data_agree] . '</td>
      </tr>
      ';
    }

    $output .= '</table>';

    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename=Habeasdata.xls');
    echo $output;
  }

  public function exportpdfAction()
  {
    $this->setLayout('blanco');

    $dataAgree = $this->getDataagree();

    $output = '';

    $output = '
    <table style="margin-bottom: 20px;">
      <tr>
        <td>
          <h2 style="color: #333333;  font-size: 26px;">
            Habeas data 
          </h2>
        </td>
        <td style="text-align: right;">
          <h2 style="color: #256D31;  font-size: 35px;">
            Corparques 
          </h2>
        </td>
      </tr>
    </table>
    <br>
    <br>
    <br>
    <br>
    ';

    // $output = '
    //   <table>
    //     <tr>
    //       <img src="/skins/page/images/logo.png" alt="Logo" width="100" height="100">
    //     </tr>
    //   </table>
    // ';

    $output .= '<table border="1" cellspacing="0" cellpadding="5" style="width: 100%; margin-top: 20px;">';
    $output .= '
    <tr>
      <th style="font-weight: bolder; text-align: center; font-size: 12px;">Nombre</th>
      <th style="font-weight: bolder; text-align: center; font-size: 12px;">Correo</th>
      <th style="font-weight: bolder; text-align: center; font-size: 12px;">Tel&eacute;fono</th>
      <th style="font-weight: bolder; text-align: center; font-size: 12px;">Fecha</th>
      <th style="font-weight: bolder; text-align: center; font-size: 12px;">Hora</th>
      <th style="font-weight: bolder; text-align: center; font-size: 12px;">IP</th>
      <th style="font-weight: bolder; text-align: center; font-size: 12px;">Aceptaci&oacute;n</th>
    </tr>';

    $habeasdataModel = new Administracion_Model_DbTable_Habeasdata();

    $data = $habeasdataModel->getList('', 'data_id DESC');

    foreach ($data as $row) {
      $output .= '
      <tr>
        <td>' . $row->data_name . '</td>
        <td>' . $row->data_mail . '</td>
        <td>' . $row->data_phone . '</td>
        <td>' . $row->data_date . '</td>
        <td>' . $row->data_time . '</td>
        <td>' . $row->data_ip . '</td>
        <td>' . $dataAgree[$row->data_agree] . '</td>
      </tr>
      ';
    }

    $output .= '</table>';

		$this->setLayout('blanco');
		$this->getLayout()->setTitle("PDF");
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetMargins(7,10, 7);
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(0);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->AddPage('L', 'A4');
		$pdf->SetFont('helvetica','',8);
		// $content = $this->_view->getRoutPHP('modules/page/Views/estadocuenta/imprimir.php');
    $content = $output;
		$pdf->writeHTML($content, true, false, true, false, '');
		$pdf->Output('Habeasdata.pdf', 'I');
  }
}
