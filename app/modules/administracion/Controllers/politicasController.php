<?php

/**
 * Controlador de Politicas que permite la  creacion, edicion  y eliminacion de los Pol&iacute;ticas del Sistema
 */
class Administracion_politicasController extends Administracion_mainController
{
  public $botonpanel = 5;
  /**
   * $mainModel  instancia del modelo de  base de datos Pol&iacute;ticas
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
  protected $_csrf_section = "administracion_politicas";

  /**
   * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
   * @var string
   */
  protected $namepages;



  /**
   * Inicializa las variables principales del controlador politicas .
   *
   * @return void.
   */
  public function init()
  {
    $this->mainModel = new Administracion_Model_DbTable_Politicas();
    $this->namefilter = "parametersfilterpoliticas";
    $this->route = "/administracion/politicas";
    $this->namepages = "pages_politicas";
    $this->namepageactual = "page_actual_politicas";
    $this->_view->route = $this->route;
    if (Session::getInstance()->get($this->namepages)) {
      $this->pages = Session::getInstance()->get($this->namepages);
    } else {
      $this->pages = 20;
    }
    parent::init();
  }


  /**
   * Recibe la informacion y  muestra un listado de  Pol&iacute;ticas con sus respectivos filtros.
   *
   * @return void.
   */
  public function indexAction()
  {
    $title = "Aministración de Pol&iacute;ticas";
    $this->getLayout()->setTitle($title);
    $this->_view->titlesection = $title;
    $this->filters();
    $this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
    $filters = (object)Session::getInstance()->get($this->namefilter);
    $this->_view->filters = $filters;
    $filters = $this->getFilter();
    $order = "orden ASC";
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
    $this->_view->list_politica_seccion = $this->getPoliticaseccion();
  }

  /**
   * Genera la Informacion necesaria para editar o crear un  Pol&iacute;ticas  y muestra su formulario
   *
   * @return void.
   */
  public function manageAction()
  {
    $this->_view->route = $this->route;
    $this->_csrf_section = "manage_politicas_" . date("YmdHis");
    $this->_csrf->generateCode($this->_csrf_section);
    $this->_view->csrf_section = $this->_csrf_section;
    $this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
    $this->_view->list_politica_seccion = $this->getPoliticaseccion();
    $id = $this->_getSanitizedParam("id");
    if ($id > 0) {
      $content = $this->mainModel->getById($id);
      if ($content->politica_id) {
        $this->_view->content = $content;
        $this->_view->routeform = $this->route . "/update";
        $title = "Actualizar Pol&iacute;ticas";
        $this->getLayout()->setTitle($title);
        $this->_view->titlesection = $title;
      } else {
        $this->_view->routeform = $this->route . "/insert";
        $title = "Crear Pol&iacute;ticas";
        $this->getLayout()->setTitle($title);
        $this->_view->titlesection = $title;
      }
    } else {
      $this->_view->routeform = $this->route . "/insert";
      $title = "Crear Pol&iacute;ticas";
      $this->getLayout()->setTitle($title);
      $this->_view->titlesection = $title;
    }
  }

  /**
   * Inserta la informacion de un Pol&iacute;ticas  y redirecciona al listado de Pol&iacute;ticas.
   *
   * @return void.
   */
  public function insertAction()
  {
    $this->setLayout('blanco');
    $csrf = $this->_getSanitizedParam("csrf");
    if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {
      $data = $this->getData();
      $uploadDocument =  new Core_Model_Upload_Document();
      if ($_FILES['politica_archivo']['name'] != '') {
        $data['politica_archivo'] = $uploadDocument->upload("politica_archivo");
      }
      $id = $this->mainModel->insert($data);
      $this->mainModel->changeOrder($id, $id);
      $data['politica_id'] = $id;
      $data['log_log'] = print_r($data, true);
      $data['log_tipo'] = 'CREAR POL&IACUTE;TICAS';
      $logModel = new Administracion_Model_DbTable_Log();
      $logModel->insert($data);
    }
    header('Location: ' . $this->route . '' . '');
  }

  /**
   * Recibe un identificador  y Actualiza la informacion de un Pol&iacute;ticas  y redirecciona al listado de Pol&iacute;ticas.
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
      if ($content->politica_id) {
        $data = $this->getData();
        $uploadDocument =  new Core_Model_Upload_Document();
        if ($_FILES['politica_archivo']['name'] != '') {
          if ($content->politica_archivo) {
            $uploadDocument->delete($content->politica_archivo);
          }
          $data['politica_archivo'] = $uploadDocument->upload("politica_archivo");
        } else {
          $data['politica_archivo'] = $content->politica_archivo;
        }
        $this->mainModel->update($data, $id);
      }
      $data['politica_id'] = $id;
      $data['log_log'] = print_r($data, true);
      $data['log_tipo'] = 'EDITAR POL&IACUTE;TICAS';
      $logModel = new Administracion_Model_DbTable_Log();
      $logModel->insert($data);
    }
    header('Location: ' . $this->route . '' . '');
  }

  /**
   * Recibe un identificador  y elimina un Pol&iacute;ticas  y redirecciona al listado de Pol&iacute;ticas.
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
          $uploadDocument =  new Core_Model_Upload_Document();
          if (isset($content->politica_archivo) && $content->politica_archivo != '') {
            $uploadDocument->delete($content->politica_archivo);
          }
          $this->mainModel->deleteRegister($id);
          $data = (array)$content;
          $data['log_log'] = print_r($data, true);
          $data['log_tipo'] = 'BORRAR POL&IACUTE;TICAS';
          $logModel = new Administracion_Model_DbTable_Log();
          $logModel->insert($data);
        }
      }
    }
    header('Location: ' . $this->route . '' . '');
  }

  /**
   * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Politicas.
   *
   * @return array con toda la informacion recibida del formulario.
   */
  private function getData()
  {
    $data = array();
    $data['politica_estado'] = $this->_getSanitizedParam("politica_estado");
    $data['politica_nombre'] = $this->_getSanitizedParam("politica_nombre");
    $data['politica_archivo'] = "";
    $data['politica_seccion'] = $this->_getSanitizedParam("politica_seccion");
    return $data;
  }

  /**
   * Genera los valores del campo Secci&oacute;n.
   *
   * @return array cadena con los valores del campo Secci&oacute;n.
   */
  private function getPoliticaseccion()
  {
    $array = array();
    $array['1'] = 'Políticas Acerca de Nosotros';
    $array['2'] = 'Otras';
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
      if ($filters->politica_nombre != '') {
        $filtros = $filtros . " AND politica_nombre LIKE '%" . $filters->politica_nombre . "%'";
      }
      if ($filters->politica_seccion != '') {
        $filtros = $filtros . " AND politica_seccion ='" . $filters->politica_seccion . "'";
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
      $parramsfilter['politica_nombre'] =  $this->_getSanitizedParam("politica_nombre");
      $parramsfilter['politica_seccion'] =  $this->_getSanitizedParam("politica_seccion");
      Session::getInstance()->set($this->namefilter, $parramsfilter);
    }
    if ($this->_getSanitizedParam("cleanfilter") == 1) {
      Session::getInstance()->set($this->namefilter, '');
      Session::getInstance()->set($this->namepageactual, 1);
    }
  }
  public function deletedocumentAction()
  {
    $id = $this->_getSanitizedParam('id');
    $politicasModel = new Administracion_Model_DbTable_Politicas();
    $politica = $politicasModel->getById($id);

    $uploadDocument =  new Core_Model_Upload_Document();

    $document = $politica->politica_archivo;

    if($uploadDocument->delete($document)){
      $politicasModel->editField($id, 'politica_archivo', '');
    }

    die(json_encode('ok'));
  }
}
