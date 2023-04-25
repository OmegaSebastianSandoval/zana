<?php 
/**
* clase que genera la insercion y edicion  de Preguntas Frecuentes en la base de datos
*/
class Administracion_Model_DbTable_Frecuentes extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'frecuentes';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'frecuente_id';

	/**
	 * insert recibe la informacion de un Preguntas Frecuentes y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$frecuente_estado = $data['frecuente_estado'];
		$frecuente_pregunta = $data['frecuente_pregunta'];
		$frecuente_respuesta = $data['frecuente_respuesta'];
		$query = "INSERT INTO frecuentes( frecuente_estado, frecuente_pregunta, frecuente_respuesta) VALUES ( '$frecuente_estado', '$frecuente_pregunta', '$frecuente_respuesta')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Preguntas Frecuentes  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$frecuente_estado = $data['frecuente_estado'];
		$frecuente_pregunta = $data['frecuente_pregunta'];
		$frecuente_respuesta = $data['frecuente_respuesta'];
		$query = "UPDATE frecuentes SET  frecuente_estado = '$frecuente_estado', frecuente_pregunta = '$frecuente_pregunta', frecuente_respuesta = '$frecuente_respuesta' WHERE frecuente_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}