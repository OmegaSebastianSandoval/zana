<?php 
/**
* clase que genera la insercion y edicion  de Pol&iacute;ticas en la base de datos
*/
class Administracion_Model_DbTable_Politicas extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'politicas';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'politica_id';

	/**
	 * insert recibe la informacion de un Pol&iacute;ticas y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$politica_estado = $data['politica_estado'];
		$politica_nombre = $data['politica_nombre'];
		$politica_archivo = $data['politica_archivo'];
		$politica_seccion = $data['politica_seccion'];
		$query = "INSERT INTO politicas( politica_estado, politica_nombre, politica_archivo, politica_seccion) VALUES ( '$politica_estado', '$politica_nombre', '$politica_archivo', '$politica_seccion')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Pol&iacute;ticas  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$politica_estado = $data['politica_estado'];
		$politica_nombre = $data['politica_nombre'];
		$politica_archivo = $data['politica_archivo'];
		$politica_seccion = $data['politica_seccion'];
		$query = "UPDATE politicas SET  politica_estado = '$politica_estado', politica_nombre = '$politica_nombre', politica_archivo = '$politica_archivo', politica_seccion = '$politica_seccion' WHERE politica_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}