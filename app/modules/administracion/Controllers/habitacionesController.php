<?php
/**
* Controlador de Habitaciones que permite la  creacion, edicion  y eliminacion de los Habitaciones del Sistema
*/
class Administracion_habitacionesController extends Administracion_mainController
{
	/**
	 * $mainModel  instancia del modelo de  base de datos Habitaciones
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
	protected $_csrf_section = "administracion_habitaciones";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
     * Inicializa las variables principales del controlador habitaciones .
     *
     * @return void.
     */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Habitaciones();
		$this->namefilter = "parametersfilterhabitaciones";
		$this->route = "/administracion/habitaciones";
		$this->namepages ="pages_habitaciones";
		$this->namepageactual ="page_actual_habitaciones";
		$this->_view->route = $this->route;
		if(Session::getInstance()->get($this->namepages)){
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
     * Recibe la informacion y  muestra un listado de  Habitaciones con sus respectivos filtros.
     *
     * @return void.
     */
	public function indexAction()
	{
		$title = "Aministración de Habitaciones";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
		$this->filters();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters =(object)Session::getInstance()->get($this->namefilter);
        $this->_view->filters = $filters;
		$filters = $this->getFilter();
		$order = "";
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
		$this->_view->list_habitacion_ciudad = $this->getHabitacionciudad();
		$this->_view->list_habitacion_tipo = $this->getHabitaciontipo();
	}

	/**
     * Genera la Informacion necesaria para editar o crear un  Tipo Habitaci&oacute;n  y muestra su formulario
     *
     * @return void.
     */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_habitaciones_".date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$this->_view->list_habitacion_ciudad = $this->getHabitacionciudad();
		$this->_view->list_habitacion_tipo = $this->getHabitaciontipo();
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if($content->habitacion_id){
				$this->_view->content = $content;
				$this->_view->routeform = $this->route."/update";
				$title = "Actualizar Tipo Habitaci&oacute;n";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}else{
				$this->_view->routeform = $this->route."/insert";
				$title = "Crear Tipo Habitaci&oacute;n";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route."/insert";
			$title = "Crear Tipo Habitaci&oacute;n";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
     * Inserta la informacion de un Tipo Habitaci&oacute;n  y redirecciona al listado de Habitaciones.
     *
     * @return void.
     */
	public function insertAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {	
			$data = $this->getData();
			$uploadImage =  new Core_Model_Upload_Image();
			if($_FILES['habitacion_imagen']['name'] != ''){
				$data['habitacion_imagen'] = $uploadImage->upload("habitacion_imagen");
			}
			$id = $this->mainModel->insert($data);
			
			$data['habitacion_id']= $id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'CREAR TIPO HABITACI&OACUTE;N';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe un identificador  y Actualiza la informacion de un Tipo Habitaci&oacute;n  y redirecciona al listado de Habitaciones.
     *
     * @return void.
     */
	public function updateAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {
			$id = $this->_getSanitizedParam("id");
			$content = $this->mainModel->getById($id);
			if ($content->habitacion_id) {
				$data = $this->getData();
				$uploadImage =  new Core_Model_Upload_Image();
				if($_FILES['habitacion_imagen']['name'] != ''){
					if($content->habitacion_imagen){
						$uploadImage->delete($content->habitacion_imagen);
					}
					$data['habitacion_imagen'] = $uploadImage->upload("habitacion_imagen");
				} else {
					$data['habitacion_imagen'] = $content->habitacion_imagen;
				}
				$this->mainModel->update($data,$id);
			}
			$data['habitacion_id']=$id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'EDITAR TIPO HABITACI&OACUTE;N';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe un identificador  y elimina un Tipo Habitaci&oacute;n  y redirecciona al listado de Habitaciones.
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
					if (isset($content->habitacion_imagen) && $content->habitacion_imagen != '') {
						$uploadImage->delete($content->habitacion_imagen);
					}
					$this->mainModel->deleteRegister($id);$data = (array)$content;
					$data['log_log'] = print_r($data,true);
					$data['log_tipo'] = 'BORRAR TIPO HABITACI&OACUTE;N';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data); }
			}
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Habitaciones.
     *
     * @return array con toda la informacion recibida del formulario.
     */
	private function getData()
	{
		$data = array();
		if($this->_getSanitizedParam("habitacion_estado") == '' ) {
			$data['habitacion_estado'] = '0';
		} else {
			$data['habitacion_estado'] = $this->_getSanitizedParam("habitacion_estado");
		}
		$data['habitacion_nombre'] = $this->_getSanitizedParam("habitacion_nombre");
		if($this->_getSanitizedParam("habitacion_ciudad") == '' ) {
			$data['habitacion_ciudad'] = '0';
		} else {
			$data['habitacion_ciudad'] = $this->_getSanitizedParam("habitacion_ciudad");
		}
		$data['habitacion_tipo'] = $this->_getSanitizedParam("habitacion_tipo");
		$data['habitacion_imagen'] = "";
		if($this->_getSanitizedParam("habitacion_precio_condesayuno") == '' ) {
			$data['habitacion_precio_condesayuno'] = '0';
		} else {
			$data['habitacion_precio_condesayuno'] = $this->_getSanitizedParam("habitacion_precio_condesayuno");
		}
		if($this->_getSanitizedParam("habitacion_precio_sindesayuno") == '' ) {
			$data['habitacion_precio_sindesayuno'] = '0';
		} else {
			$data['habitacion_precio_sindesayuno'] = $this->_getSanitizedParam("habitacion_precio_sindesayuno");
		}
		$data['habitacion_descripcion'] = $this->_getSanitizedParamHtml("habitacion_descripcion");
		return $data;
	}

	/**
     * Genera los valores del campo Ciudad.
     *
     * @return array cadena con los valores del campo Ciudad.
     */
	private function getHabitacionciudad()
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
     * Genera los valores del campo Tipo.
     *
     * @return array cadena con los valores del campo Tipo.
     */
	private function getHabitaciontipo()
	{
		$modelData = new Administracion_Model_DbTable_Dependtiposhabitacion();
		$data = $modelData->getList();
		$array = array();
		foreach ($data as $key => $value) {
			$array[$value->tipo_habitacion_nombre] = $value->tipo_habitacion_nombre;
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
            if ($filters->habitacion_nombre != '') {
                $filtros = $filtros." AND habitacion_nombre LIKE '%".$filters->habitacion_nombre."%'";
            }
            if ($filters->habitacion_ciudad != '') {
                $filtros = $filtros." AND habitacion_ciudad LIKE '%".$filters->habitacion_ciudad."%'";
            }
            if ($filters->habitacion_tipo != '') {
                $filtros = $filtros." AND habitacion_tipo LIKE '%".$filters->habitacion_tipo."%'";
            }
            if ($filters->habitacion_imagen != '') {
                $filtros = $filtros." AND habitacion_imagen LIKE '%".$filters->habitacion_imagen."%'";
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
					$parramsfilter['habitacion_nombre'] =  $this->_getSanitizedParam("habitacion_nombre");
					$parramsfilter['habitacion_ciudad'] =  $this->_getSanitizedParam("habitacion_ciudad");
					$parramsfilter['habitacion_tipo'] =  $this->_getSanitizedParam("habitacion_tipo");
					$parramsfilter['habitacion_imagen'] =  $this->_getSanitizedParam("habitacion_imagen");Session::getInstance()->set($this->namefilter, $parramsfilter);
        }
        if ($this->_getSanitizedParam("cleanfilter") == 1) {
            Session::getInstance()->set($this->namefilter, '');
            Session::getInstance()->set($this->namepageactual,1);
        }
    }
}