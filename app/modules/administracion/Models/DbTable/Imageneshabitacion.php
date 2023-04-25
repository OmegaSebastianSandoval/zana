<?php 
/**
* clase que genera la insercion y edicion  de Im&aacute;genes Habitaci&oacute;n en la base de datos
*/
class Administracion_Model_DbTable_Imageneshabitacion extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'imagenes_habitacion';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'imagenes_habitacion_id';

	/**
	 * insert recibe la informacion de un Im&aacute;genes Habitaci&oacute;n y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$imagenes_habitacion_estado = $data['imagenes_habitacion_estado'];
		$imagenes_habitacion_habitacion = $data['imagenes_habitacion_habitacion'];
		$imagenes_habitacion_titulo = $data['imagenes_habitacion_titulo'];
		$imagenes_habitacion_imagen = $data['imagenes_habitacion_imagen'];
		$query = "INSERT INTO imagenes_habitacion( imagenes_habitacion_estado, imagenes_habitacion_habitacion, imagenes_habitacion_titulo, imagenes_habitacion_imagen) VALUES ( '$imagenes_habitacion_estado', '$imagenes_habitacion_habitacion', '$imagenes_habitacion_titulo', '$imagenes_habitacion_imagen')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Im&aacute;genes Habitaci&oacute;n  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$imagenes_habitacion_estado = $data['imagenes_habitacion_estado'];
		$imagenes_habitacion_habitacion = $data['imagenes_habitacion_habitacion'];
		$imagenes_habitacion_titulo = $data['imagenes_habitacion_titulo'];
		$imagenes_habitacion_imagen = $data['imagenes_habitacion_imagen'];
		$query = "UPDATE imagenes_habitacion SET  imagenes_habitacion_estado = '$imagenes_habitacion_estado', imagenes_habitacion_habitacion = '$imagenes_habitacion_habitacion', imagenes_habitacion_titulo = '$imagenes_habitacion_titulo', imagenes_habitacion_imagen = '$imagenes_habitacion_imagen' WHERE imagenes_habitacion_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}