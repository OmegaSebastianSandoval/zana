<?php
/**
* Controlador de Imageneslineas que permite la  creacion, edicion  y eliminacion de los Im&aacute;genes del Sistema
*/
class Administracion_imageneslineasController extends Administracion_mainController
{
	/**
	 * $mainModel  instancia del modelo de  base de datos Im&aacute;genes
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
	protected $_csrf_section = "administracion_imageneslineas";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
     * Inicializa las variables principales del controlador imageneslineas .
     *
     * @return void.
     */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Imageneslineas();
		$this->namefilter = "parametersfilterimageneslineas";
		$this->route = "/administracion/imageneslineas";
		$this->namepages ="pages_imageneslineas";
		$this->namepageactual ="page_actual_imageneslineas";
		$this->_view->route = $this->route;
		if(Session::getInstance()->get($this->namepages)){
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
     * Recibe la informacion y  muestra un listado de  Im&aacute;genes con sus respectivos filtros.
     *
     * @return void.
     */
	public function indexAction()
	{
		$title = "Aministración de Im&aacute;genes";
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
		$this->_view->linea_id = $this->_getSanitizedParam("linea_id");
	}

	/**
     * Genera la Informacion necesaria para editar o crear un  Im&aacute;genes  y muestra su formulario
     *
     * @return void.
     */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_imageneslineas_".date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$this->_view->linea_id = $this->_getSanitizedParam("linea_id");
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if($content->imagen_id){
				$this->_view->content = $content;
				$this->_view->routeform = $this->route."/update";
				$title = "Actualizar Im&aacute;genes";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}else{
				$this->_view->routeform = $this->route."/insert";
				$title = "Crear Im&aacute;genes";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route."/insert";
			$title = "Crear Im&aacute;genes";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
     * Inserta la informacion de un Im&aacute;genes  y redirecciona al listado de Im&aacute;genes.
     *
     * @return void.
     */
	public function insertAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {	
			$data = $this->getData();
			$uploadImage =  new Core_Model_Upload_Image();
			if($_FILES['imagen_imagen']['name'] != ''){
				$data['imagen_imagen'] = $uploadImage->upload("imagen_imagen");
			}
			$id = $this->mainModel->insert($data);
			$this->mainModel->changeOrder($id,$id);
			$data['imagen_id']= $id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'CREAR IM&AACUTE;GENES';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		$linea_id = $this->_getSanitizedParam("imagen_linea");
		header('Location: '.$this->route.'?linea_id='.$linea_id.'');
	}

	/**
     * Recibe un identificador  y Actualiza la informacion de un Im&aacute;genes  y redirecciona al listado de Im&aacute;genes.
     *
     * @return void.
     */
	public function updateAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {
			$id = $this->_getSanitizedParam("id");
			$content = $this->mainModel->getById($id);
			if ($content->imagen_id) {
				$data = $this->getData();
				$uploadImage =  new Core_Model_Upload_Image();
				if($_FILES['imagen_imagen']['name'] != ''){
					if($content->imagen_imagen){
						$uploadImage->delete($content->imagen_imagen);
					}
					$data['imagen_imagen'] = $uploadImage->upload("imagen_imagen");
				} else {
					$data['imagen_imagen'] = $content->imagen_imagen;
				}
				$this->mainModel->update($data,$id);
			}
			$data['imagen_id']=$id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'EDITAR IM&AACUTE;GENES';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);}
		$linea_id = $this->_getSanitizedParam("imagen_linea");
		header('Location: '.$this->route.'?linea_id='.$linea_id.'');
	}

	/**
     * Recibe un identificador  y elimina un Im&aacute;genes  y redirecciona al listado de Im&aacute;genes.
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
					if (isset($content->imagen_imagen) && $content->imagen_imagen != '') {
						$uploadImage->delete($content->imagen_imagen);
					}
					$this->mainModel->deleteRegister($id);$data = (array)$content;
					$data['log_log'] = print_r($data,true);
					$data['log_tipo'] = 'BORRAR IM&AACUTE;GENES';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data); }
			}
		}
		$linea_id = $this->_getSanitizedParam("linea_id");
		header('Location: '.$this->route.'?linea_id='.$linea_id.'');
	}

	/**
     * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Imageneslineas.
     *
     * @return array con toda la informacion recibida del formulario.
     */
	private function getData()
	{
		$data = array();
		$data['imagen_estado'] = $this->_getSanitizedParam("imagen_estado");
		$data['imagen_nombre'] = $this->_getSanitizedParam("imagen_nombre");
		$data['imagen_imagen'] = "";
		$data['imagen_video'] = $this->_getSanitizedParamHtml("imagen_video");
		$data['imagen_linea'] = $this->_getSanitizedParamHtml("imagen_linea");
		return $data;
	}
	/**
     * Genera la consulta con los filtros de este controlador.
     *
     * @return array cadena con los filtros que se van a asignar a la base de datos
     */
    protected function getFilter()
    {
    	$filtros = " 1 = 1 ";
		$linea_id= $this->_getSanitizedParam("linea_id");
		$filtros = $filtros." AND imagen_linea = '$linea_id' ";
        if (Session::getInstance()->get($this->namefilter)!="") {
            $filters =(object)Session::getInstance()->get($this->namefilter);
            if ($filters->imagen_nombre != '') {
                $filtros = $filtros." AND imagen_nombre LIKE '%".$filters->imagen_nombre."%'";
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
					$parramsfilter['imagen_nombre'] =  $this->_getSanitizedParam("imagen_nombre");Session::getInstance()->set($this->namefilter, $parramsfilter);
        }
        if ($this->_getSanitizedParam("cleanfilter") == 1) {
            Session::getInstance()->set($this->namefilter, '');
            Session::getInstance()->set($this->namepageactual,1);
        }
    }
}