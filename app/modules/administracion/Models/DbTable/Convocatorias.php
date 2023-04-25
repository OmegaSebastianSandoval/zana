<?php 
/**
* clase que genera la insercion y edicion  de Convocatorias en la base de datos
*/
class Administracion_Model_DbTable_Convocatorias extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'convocatorias';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'convocatoria_id';

	/**
	 * insert recibe la informacion de un Convocatorias y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$convocatoria_titulo = $data['convocatoria_titulo'];
		$convocatoria_fecha = $data['convocatoria_fecha'];
		$convocatoria_imagen = $data['convocatoria_imagen'];
		$convocatoria_video = $data['convocatoria_video'];
		$convocatoria_galeria = $data['convocatoria_galeria'];
		$convocatoria_pdf = $data['convocatoria_pdf'];
		$convocatoria_descripcion = $data['convocatoria_descripcion'];
		$query = "INSERT INTO convocatorias( convocatoria_titulo, convocatoria_fecha, convocatoria_imagen, convocatoria_video, convocatoria_galeria, convocatoria_pdf, convocatoria_descripcion) VALUES ( '$convocatoria_titulo', '$convocatoria_fecha', '$convocatoria_imagen', '$convocatoria_video', '$convocatoria_galeria', '$convocatoria_pdf', '$convocatoria_descripcion')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Convocatorias  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$convocatoria_titulo = $data['convocatoria_titulo'];
		$convocatoria_fecha = $data['convocatoria_fecha'];
		$convocatoria_imagen = $data['convocatoria_imagen'];
		$convocatoria_video = $data['convocatoria_video'];
		$convocatoria_galeria = $data['convocatoria_galeria'];
		$convocatoria_pdf = $data['convocatoria_pdf'];
		$convocatoria_descripcion = $data['convocatoria_descripcion'];
		$query = "UPDATE convocatorias SET  convocatoria_titulo = '$convocatoria_titulo', convocatoria_fecha = '$convocatoria_fecha', convocatoria_imagen = '$convocatoria_imagen', convocatoria_video = '$convocatoria_video', convocatoria_galeria = '$convocatoria_galeria', convocatoria_pdf = '$convocatoria_pdf', convocatoria_descripcion = '$convocatoria_descripcion' WHERE convocatoria_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}