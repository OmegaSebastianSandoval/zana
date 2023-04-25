<?php 
/**
* clase que genera la insercion y edicion  de Habitaciones en la base de datos
*/
class Administracion_Model_DbTable_Habitaciones extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'habitaciones';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'habitacion_id';

	/**
	 * insert recibe la informacion de un Tipo Habitaci&oacute;n y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$habitacion_estado = $data['habitacion_estado'];
		$habitacion_nombre = $data['habitacion_nombre'];
		$habitacion_ciudad = $data['habitacion_ciudad'];
		$habitacion_tipo = $data['habitacion_tipo'];
		$habitacion_imagen = $data['habitacion_imagen'];
		$habitacion_precio_condesayuno = $data['habitacion_precio_condesayuno'];
		$habitacion_precio_sindesayuno = $data['habitacion_precio_sindesayuno'];
		// $habitacion_descripcion = substr($data['habitacion_descripcion'], 0, -69);
		$habitacion_descripcion = $data['habitacion_descripcion'];

		$query = "INSERT INTO habitaciones( habitacion_estado, habitacion_nombre, habitacion_ciudad, habitacion_tipo, habitacion_imagen, habitacion_precio_condesayuno, habitacion_precio_sindesayuno, habitacion_descripcion) VALUES ( '$habitacion_estado', '$habitacion_nombre', '$habitacion_ciudad', '$habitacion_tipo', '$habitacion_imagen', '$habitacion_precio_condesayuno', '$habitacion_precio_sindesayuno', '$habitacion_descripcion')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Tipo Habitaci&oacute;n  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$habitacion_estado = $data['habitacion_estado'];
		$habitacion_nombre = $data['habitacion_nombre'];
		$habitacion_ciudad = $data['habitacion_ciudad'];
		$habitacion_tipo = $data['habitacion_tipo'];
		$habitacion_imagen = $data['habitacion_imagen'];
		$habitacion_precio_condesayuno = $data['habitacion_precio_condesayuno'];
		$habitacion_precio_sindesayuno = $data['habitacion_precio_sindesayuno'];
		$habitacion_descripcion = $data['habitacion_descripcion'];
		$query = "UPDATE habitaciones SET  habitacion_estado = '$habitacion_estado', habitacion_nombre = '$habitacion_nombre', habitacion_ciudad = '$habitacion_ciudad', habitacion_tipo = '$habitacion_tipo', habitacion_imagen = '$habitacion_imagen', habitacion_precio_condesayuno = '$habitacion_precio_condesayuno', habitacion_precio_sindesayuno = '$habitacion_precio_sindesayuno', habitacion_descripcion = '$habitacion_descripcion' WHERE habitacion_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}
