<?php 
/**
* clase que genera la insercion y edicion  de Tipo Habitaci&oacute;n en la base de datos
*/
class Administracion_Model_DbTable_Tipohabitacion extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'tipos_habitacion';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'tipo_habitacion_id';

	/**
	 * insert recibe la informacion de un Tipo Habitaci&oacute;n y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$tipo_habitacion_estado = $data['tipo_habitacion_estado'];
		$tipo_habitacion_nombre = $data['tipo_habitacion_nombre'];
		$query = "INSERT INTO tipos_habitacion( tipo_habitacion_estado, tipo_habitacion_nombre) VALUES ( '$tipo_habitacion_estado', '$tipo_habitacion_nombre')";
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
		
		$tipo_habitacion_estado = $data['tipo_habitacion_estado'];
		$tipo_habitacion_nombre = $data['tipo_habitacion_nombre'];
		$query = "UPDATE tipos_habitacion SET  tipo_habitacion_estado = '$tipo_habitacion_estado', tipo_habitacion_nombre = '$tipo_habitacion_nombre' WHERE tipo_habitacion_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}