<?php 
/**
* clase que genera la insercion y edicion  de Emprendimiento en la base de datos
*/
class Administracion_Model_DbTable_Emprendimiento extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'emprendimiento';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'emprendimiento_id';

	/**
	 * insert recibe la informacion de un Emprendimiento y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$emprendimiento_estado = $data['emprendimiento_estado'];
		$emprendimiento_titulo = $data['emprendimiento_titulo'];
		$emprendimiento_imagen = $data['emprendimiento_imagen'];
		$emprendimiento_fecha = $data['emprendimiento_fecha'];
		$emprendimiento_importante = $data['emprendimiento_importante'];
		$emprendimiento_ciudad = $data['emprendimiento_ciudad'];
		// $emprendimiento_texto = substr($data['emprendimiento_texto'], 0, -69);

		$emprendimiento_texto = $data['emprendimiento_texto'];
		$query = "INSERT INTO emprendimiento( emprendimiento_estado, emprendimiento_titulo, emprendimiento_imagen, emprendimiento_fecha, emprendimiento_importante, emprendimiento_ciudad, emprendimiento_texto) VALUES ( '$emprendimiento_estado', '$emprendimiento_titulo', '$emprendimiento_imagen', '$emprendimiento_fecha', '$emprendimiento_importante', '$emprendimiento_ciudad', '$emprendimiento_texto')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Emprendimiento  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$emprendimiento_estado = $data['emprendimiento_estado'];
		$emprendimiento_titulo = $data['emprendimiento_titulo'];
		$emprendimiento_imagen = $data['emprendimiento_imagen'];
		$emprendimiento_fecha = $data['emprendimiento_fecha'];
		$emprendimiento_importante = $data['emprendimiento_importante'];
		$emprendimiento_ciudad = $data['emprendimiento_ciudad'];
		// $emprendimiento_texto = substr($data['emprendimiento_texto'], 0, -69);

		$emprendimiento_texto = $data['emprendimiento_texto'];
		$query = "UPDATE emprendimiento SET  emprendimiento_estado = '$emprendimiento_estado', emprendimiento_titulo = '$emprendimiento_titulo', emprendimiento_imagen = '$emprendimiento_imagen', emprendimiento_fecha = '$emprendimiento_fecha', emprendimiento_importante = '$emprendimiento_importante', emprendimiento_ciudad = '$emprendimiento_ciudad', emprendimiento_texto = '$emprendimiento_texto' WHERE emprendimiento_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}