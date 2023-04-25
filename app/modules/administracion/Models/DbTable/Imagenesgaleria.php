<?php 
/**
* clase que genera la insercion y edicion  de Imagenes Galeria en la base de datos
*/
class Administracion_Model_DbTable_Imagenesgaleria extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'imagenes_galeria';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'imagen_id';

	/**
	 * insert recibe la informacion de un Imagenes Galeria y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$imagen_estado = $data['imagen_estado'];
		$imagen_nombre = $data['imagen_nombre'];
		$imagen_imagen = $data['imagen_imagen'];
		$imagen_fecha = $data['imagen_fecha'];
		$imagen_galeria = $data['imagen_galeria'];
		$query = "INSERT INTO imagenes_galeria( imagen_estado, imagen_nombre, imagen_imagen, imagen_fecha, imagen_galeria) VALUES ( '$imagen_estado', '$imagen_nombre', '$imagen_imagen', '$imagen_fecha', '$imagen_galeria')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Imagenes Galeria  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$imagen_estado = $data['imagen_estado'];
		$imagen_nombre = $data['imagen_nombre'];
		$imagen_imagen = $data['imagen_imagen'];
		$imagen_fecha = $data['imagen_fecha'];
		$imagen_galeria = $data['imagen_galeria'];
		$query = "UPDATE imagenes_galeria SET  imagen_estado = '$imagen_estado', imagen_nombre = '$imagen_nombre', imagen_imagen = '$imagen_imagen', imagen_fecha = '$imagen_fecha', imagen_galeria = '$imagen_galeria' WHERE imagen_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}