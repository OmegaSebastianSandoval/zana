<?php
/**
* Controlador de Emprendimiento que permite la  creacion, edicion  y eliminacion de los Emprendimiento del Sistema
*/
class Administracion_emprendimientoController extends Administracion_mainController
{
	/**
	 * $mainModel  instancia del modelo de  base de datos Emprendimiento
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
	protected $pages ;

	/**
	 * $namefilter nombre de la variable a la fual se le van a guardar los filtros
	 * @var string
	 */
	protected $namefilter;

	/**
	 * $_csrf_section  nombre de la variable general csrf  que se va a almacenar en la session
	 * @var string
	 */
	protected $_csrf_section = "administracion_emprendimiento";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
     * Inicializa las variables principales del controlador emprendimiento .
     *
     * @return void.
     */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Emprendimiento();
		$this->namefilter = "parametersfilteremprendimiento";
		$this->route = "/administracion/emprendimiento";
		$this->namepages ="pages_emprendimiento";
		$this->namepageactual ="page_actual_emprendimiento";
		$this->_view->route = $this->route;
		if(Session::getInstance()->get($this->namepages)){
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
     * Recibe la informacion y  muestra un listado de  Emprendimiento con sus respectivos filtros.
     *
     * @return void.
     */
	public function indexAction()
	{
		$title = "Aministración de Emprendimiento";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
		$this->filters();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters =(object)Session::getInstance()->get($this->namefilter);
        $this->_view->filters = $filters;
		$filters = $this->getFilter();
		$order = "orden ASC";
		$list = $this->mainModel->getList($filters,$order);
		$amount = $this->pages;
		$page = $this->_getSanitizedParam("page");
		if (!$page && Session::getInstance()->get($this->namepageactual)) {
		   	$page = Session::getInstance()->get($this->namepageactual);
		   	$start = ($page - 1) * $amount;
		} else if(!$page){
			$start = 0;
		   	$page=1;
			Session::getInstance()->set($this->namepageactual,$page);
		} else {
			Session::getInstance()->set($this->namepageactual,$page);
		   	$start = ($page - 1) * $amount;
		}
		$this->_view->register_number = count($list);
		$this->_view->pages = $this->pages;
		$this->_view->totalpages = ceil(count($list)/$amount);
		$this->_view->page = $page;
		$this->_view->lists = $this->mainModel->getListPages($filters,$order,$start,$amount);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->list_emprendimiento_ciudad = $this->getEmprendimientociudad();
	}

	/**
     * Genera la Informacion necesaria para editar o crear un  Emprendimiento  y muestra su formulario
     *
     * @return void.
     */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_emprendimiento_".date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$this->_view->list_emprendimiento_ciudad = $this->getEmprendimientociudad();
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if($content->emprendimiento_id){
				$this->_view->content = $content;
				$this->_view->routeform = $this->route."/update";
				$title = "Actualizar Emprendimiento";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}else{
				$this->_view->routeform = $this->route."/insert";
				$title = "Crear Emprendimiento";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route."/insert";
			$title = "Crear Emprendimiento";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
     * Inserta la informacion de un Emprendimiento  y redirecciona al listado de Emprendimiento.
     *
     * @return void.
     */
	public function insertAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {	
			$data = $this->getData();
			$uploadImage =  new Core_Model_Upload_Image();
			if($_FILES['emprendimiento_imagen']['name'] != ''){
				$data['emprendimiento_imagen'] = $uploadImage->upload("emprendimiento_imagen");
			}
			$id = $this->mainModel->insert($data);
			$this->mainModel->changeOrder($id,$id);
			$data['emprendimiento_id']= $id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'CREAR EMPRENDIMIENTO';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe un identificador  y Actualiza la informacion de un Emprendimiento  y redirecciona al listado de Emprendimiento.
     *
     * @return void.
     */
	public function updateAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {
			$id = $this->_getSanitizedParam("id");
			$content = $this->mainModel->getById($id);
			if ($content->emprendimiento_id) {
				$data = $this->getData();
				$uploadImage =  new Core_Model_Upload_Image();
				if($_FILES['emprendimiento_imagen']['name'] != ''){
					if($content->emprendimiento_imagen){
						$uploadImage->delete($content->emprendimiento_imagen);
					}
					$data['emprendimiento_imagen'] = $uploadImage->upload("emprendimiento_imagen");
				} else {
					$data['emprendimiento_imagen'] = $content->emprendimiento_imagen;
				}
				$this->mainModel->update($data,$id);
			}
			$data['emprendimiento_id']=$id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'EDITAR EMPRENDIMIENTO';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe un identificador  y elimina un Emprendimiento  y redirecciona al listado de Emprendimiento.
     *
     * @return void.
     */
	public function deleteAction()
	{
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_csrf_section] == $csrf ) {
			$id =  $this->_getSanitizedParam("id");
			if (isset($id) && $id > 0) {
				$content = $this->mainModel->getById($id);
				if (isset($content)) {
					$uploadImage =  new Core_Model_Upload_Image();
					if (isset($content->emprendimiento_imagen) && $content->emprendimiento_imagen != '') {
						$uploadImage->delete($content->emprendimiento_imagen);
					}
					$this->mainModel->deleteRegister($id);$data = (array)$content;
					$data['log_log'] = print_r($data,true);
					$data['log_tipo'] = 'BORRAR EMPRENDIMIENTO';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data); }
			}
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Emprendimiento.
     *
     * @return array con toda la informacion recibida del formulario.
     */
	private function getData()
	{
		$data = array();
		$data['emprendimiento_estado'] = $this->_getSanitizedParam("emprendimiento_estado");
		$data['emprendimiento_titulo'] = $this->_getSanitizedParam("emprendimiento_titulo");
		$data['emprendimiento_imagen'] = "";
		$data['emprendimiento_fecha'] = $this->_getSanitizedParam("emprendimiento_fecha");
		$data['emprendimiento_importante'] = $this->_getSanitizedParam("emprendimiento_importante");
		$data['emprendimiento_ciudad'] = $this->_getSanitizedParam("emprendimiento_ciudad");
		$data['emprendimiento_texto'] = $this->_getSanitizedParamHtml("emprendimiento_texto");
		return $data;
	}

	/**
     * Genera los valores del campo Ciudad.
     *
     * @return array cadena con los valores del campo Ciudad.
     */
	private function getEmprendimientociudad()
	{
		$modelData = new Administracion_Model_DbTable_Dependciudades();
		$data = $modelData->getList();
		$array = array();
		foreach ($data as $key => $value) {
			$array[$value->ciudad_nombre] = $value->ciudad_nombre;
		}
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
        if (Session::getInstance()->get($this->namefilter)!="") {
            $filters =(object)Session::getInstance()->get($this->namefilter);
            if ($filters->emprendimiento_titulo != '') {
                $filtros = $filtros." AND emprendimiento_titulo LIKE '%".$filters->emprendimiento_titulo."%'";
            }
            if ($filters->emprendimiento_imagen != '') {
                $filtros = $filtros." AND emprendimiento_imagen LIKE '%".$filters->emprendimiento_imagen."%'";
            }
            if ($filters->emprendimiento_ciudad != '') {
                $filtros = $filtros." AND emprendimiento_ciudad LIKE '%".$filters->emprendimiento_ciudad."%'";
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
        if ($this->getRequest()->isPost()== true) {
        	Session::getInstance()->set($this->namepageactual,1);
            $parramsfilter = array();
					$parramsfilter['emprendimiento_titulo'] =  $this->_getSanitizedParam("emprendimiento_titulo");
					$parramsfilter['emprendimiento_imagen'] =  $this->_getSanitizedParam("emprendimiento_imagen");
					$parramsfilter['emprendimiento_ciudad'] =  $this->_getSanitizedParam("emprendimiento_ciudad");Session::getInstance()->set($this->namefilter, $parramsfilter);
        }
        if ($this->_getSanitizedParam("cleanfilter") == 1) {
            Session::getInstance()->set($this->namefilter, '');
            Session::getInstance()->set($this->namepageactual,1);
        }
    }
}