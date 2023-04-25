<?php
/**
* Controlador de Convocatorias que permite la  creacion, edicion  y eliminacion de los Convocatorias del Sistema
*/
class Administracion_convocatoriasController extends Administracion_mainController
{
  public $botonpanel = 11;
	/**
	 * $mainModel  instancia del modelo de  base de datos Convocatorias
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
	protected $_csrf_section = "administracion_convocatorias";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
     * Inicializa las variables principales del controlador convocatorias .
     *
     * @return void.
     */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Convocatorias();
		$this->namefilter = "parametersfilterconvocatorias";
		$this->route = "/administracion/convocatorias";
		$this->namepages ="pages_convocatorias";
		$this->namepageactual ="page_actual_convocatorias";
		$this->_view->route = $this->route;
		if(Session::getInstance()->get($this->namepages)){
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
     * Recibe la informacion y  muestra un listado de  Convocatorias con sus respectivos filtros.
     *
     * @return void.
     */
	public function indexAction()
	{
		$title = "Aministración de Convocatorias";
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
	}

	/**
     * Genera la Informacion necesaria para editar o crear un  Convocatorias  y muestra su formulario
     *
     * @return void.
     */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_convocatorias_".date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if($content->convocatoria_id){
				$this->_view->content = $content;
				$this->_view->routeform = $this->route."/update";
				$title = "Actualizar Convocatorias";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}else{
				$this->_view->routeform = $this->route."/insert";
				$title = "Crear Convocatorias";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route."/insert";
			$title = "Crear Convocatorias";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
     * Inserta la informacion de un Convocatorias  y redirecciona al listado de Convocatorias.
     *
     * @return void.
     */
	public function insertAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {	
			$data = $this->getData();
			$uploadImage =  new Core_Model_Upload_Image();
			if($_FILES['convocatoria_imagen']['name'] != ''){
				$data['convocatoria_imagen'] = $uploadImage->upload("convocatoria_imagen");
			}
			$uploadDocument =  new Core_Model_Upload_Document();
			if($_FILES['convocatoria_pdf']['name'] != ''){
				$data['convocatoria_pdf'] = $uploadDocument->upload("convocatoria_pdf");
			}
			$id = $this->mainModel->insert($data);
			$this->mainModel->changeOrder($id,$id);
			$data['convocatoria_id']= $id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'CREAR CONVOCATORIAS';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe un identificador  y Actualiza la informacion de un Convocatorias  y redirecciona al listado de Convocatorias.
     *
     * @return void.
     */
	public function updateAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {
			$id = $this->_getSanitizedParam("id");
			$content = $this->mainModel->getById($id);
			if ($content->convocatoria_id) {
				$data = $this->getData();
				$uploadImage =  new Core_Model_Upload_Image();
				if($_FILES['convocatoria_imagen']['name'] != ''){
					if($content->convocatoria_imagen){
						$uploadImage->delete($content->convocatoria_imagen);
					}
					$data['convocatoria_imagen'] = $uploadImage->upload("convocatoria_imagen");
				} else {
					$data['convocatoria_imagen'] = $content->convocatoria_imagen;
				}
				$uploadDocument =  new Core_Model_Upload_Document();
				if($_FILES['convocatoria_pdf']['name'] != ''){
					if($content->convocatoria_pdf){
						$uploadDocument->delete($content->convocatoria_pdf);
					}
					$data['convocatoria_pdf'] = $uploadDocument->upload("convocatoria_pdf");
				} else {
					$data['convocatoria_pdf'] = $content->convocatoria_pdf;
				}
				$this->mainModel->update($data,$id);
			}
			$data['convocatoria_id']=$id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'EDITAR CONVOCATORIAS';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe un identificador  y elimina un Convocatorias  y redirecciona al listado de Convocatorias.
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
					if (isset($content->convocatoria_imagen) && $content->convocatoria_imagen != '') {
						$uploadImage->delete($content->convocatoria_imagen);
					}
					$uploadDocument =  new Core_Model_Upload_Document();
					if (isset($content->convocatoria_pdf) && $content->convocatoria_pdf != '') {
						$uploadDocument->delete($content->convocatoria_pdf);
					}
					$this->mainModel->deleteRegister($id);$data = (array)$content;
					$data['log_log'] = print_r($data,true);
					$data['log_tipo'] = 'BORRAR CONVOCATORIAS';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data); }
			}
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Convocatorias.
     *
     * @return array con toda la informacion recibida del formulario.
     */
	private function getData()
	{
		$data = array();
		$data['convocatoria_titulo'] = $this->_getSanitizedParam("convocatoria_titulo");
		$data['convocatoria_fecha'] = $this->_getSanitizedParam("convocatoria_fecha");
		$data['convocatoria_imagen'] = "";
		$data['convocatoria_video'] = $this->_getSanitizedParam("convocatoria_video");
		$data['convocatoria_galeria'] = $this->_getSanitizedParam("convocatoria_galeria");
		$data['convocatoria_pdf'] = "";
		$data['convocatoria_descripcion'] = $this->_getSanitizedParamHtml("convocatoria_descripcion");
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
        if (Session::getInstance()->get($this->namefilter)!="") {
            $filters =(object)Session::getInstance()->get($this->namefilter);
            if ($filters->convocatoria_titulo != '') {
                $filtros = $filtros." AND convocatoria_titulo LIKE '%".$filters->convocatoria_titulo."%'";
            }
            if ($filters->convocatoria_fecha != '') {
                $filtros = $filtros." AND convocatoria_fecha LIKE '%".$filters->convocatoria_fecha."%'";
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
					$parramsfilter['convocatoria_titulo'] =  $this->_getSanitizedParam("convocatoria_titulo");
					$parramsfilter['convocatoria_fecha'] =  $this->_getSanitizedParam("convocatoria_fecha");Session::getInstance()->set($this->namefilter, $parramsfilter);
        }
        if ($this->_getSanitizedParam("cleanfilter") == 1) {
            Session::getInstance()->set($this->namefilter, '');
            Session::getInstance()->set($this->namepageactual,1);
        }
    }
}