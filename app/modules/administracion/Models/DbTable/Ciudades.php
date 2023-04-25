<?php 
/**
* clase que genera la insercion y edicion  de Ciudades en la base de datos
*/
class Administracion_Model_DbTable_Ciudades extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'ciudades';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'ciudad_id';

	/**
	 * insert recibe la informacion de un Ciudades y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$ciudad_estado = $data['ciudad_estado'];
		$ciudad_nombre = $data['ciudad_nombre'];
		$query = "INSERT INTO ciudades( ciudad_estado, ciudad_nombre) VALUES ( '$ciudad_estado', '$ciudad_nombre')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Ciudades  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$ciudad_estado = $data['ciudad_estado'];
		$ciudad_nombre = $data['ciudad_nombre'];
		$query = "UPDATE ciudades SET  ciudad_estado = '$ciudad_estado', ciudad_nombre = '$ciudad_nombre' WHERE ciudad_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}