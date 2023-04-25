<?php 
/**
* clase que genera la insercion y edicion  de L&iacute;neas de Negocio en la base de datos
*/
class Administracion_Model_DbTable_Lineasdenegocio extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'lineas_negocio';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'contenido_id';

	/**
	 * insert recibe la informacion de un L&iacute;neas de Negocio y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$contenido_estado = $data['contenido_estado'];
		$contenido_orden = $data['contenido_orden'];
		$contenido_titulo = $data['contenido_titulo'];
		$contenido_fondo = $data['contenido_fondo'];
		$contenido_descripcion = $data['contenido_descripcion'];
		$query = "INSERT INTO lineas_negocio( contenido_estado, contenido_orden, contenido_titulo, contenido_fondo, contenido_descripcion) VALUES ( '$contenido_estado', '$contenido_orden', '$contenido_titulo', '$contenido_fondo', '$contenido_descripcion')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un L&iacute;neas de Negocio  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$contenido_estado = $data['contenido_estado'];
		$contenido_orden = $data['contenido_orden'];
		$contenido_titulo = $data['contenido_titulo'];
		$contenido_fondo = $data['contenido_fondo'];
		$contenido_descripcion = $data['contenido_descripcion'];
		$query = "UPDATE lineas_negocio SET  contenido_estado = '$contenido_estado', contenido_orden = '$contenido_orden', contenido_titulo = '$contenido_titulo', contenido_fondo = '$contenido_fondo', contenido_descripcion = '$contenido_descripcion' WHERE contenido_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}