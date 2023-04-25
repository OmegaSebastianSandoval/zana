<?php 
/**
* clase que genera la insercion y edicion  de Galer&iacute;as en la base de datos
*/
class Administracion_Model_DbTable_Galerias extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'galerias';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'galeria_id';

	/**
	 * insert recibe la informacion de un Galer&iacute;as y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$galeria_estado = $data['galeria_estado'];
		$galeria_nombre = $data['galeria_nombre'];
		$galeria_imagen = $data['galeria_imagen'];
		$query = "INSERT INTO galerias( galeria_estado, galeria_nombre, galeria_imagen) VALUES ( '$galeria_estado', '$galeria_nombre', '$galeria_imagen')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Galer&iacute;as  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$galeria_estado = $data['galeria_estado'];
		$galeria_nombre = $data['galeria_nombre'];
		$galeria_imagen = $data['galeria_imagen'];
		$query = "UPDATE galerias SET  galeria_estado = '$galeria_estado', galeria_nombre = '$galeria_nombre', galeria_imagen = '$galeria_imagen' WHERE galeria_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}