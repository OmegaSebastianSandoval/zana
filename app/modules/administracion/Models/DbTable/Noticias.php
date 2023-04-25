<?php 
/**
* clase que genera la insercion y edicion  de Noticias en la base de datos
*/
class Administracion_Model_DbTable_Noticias extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'noticias';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'noticia_id';

	/**
	 * insert recibe la informacion de un Noticias y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$noticia_titulo = $data['noticia_titulo'];
		$noticia_fecha = $data['noticia_fecha'];
		$noticia_imagen = $data['noticia_imagen'];
		$noticia_video = $data['noticia_video'];
		$noticia_galeria = $data['noticia_galeria'];
		$noticia_pdf = $data['noticia_pdf'];
		$noticia_descripcion = $data['noticia_descripcion'];
		$query = "INSERT INTO noticias( noticia_titulo, noticia_fecha, noticia_imagen, noticia_video, noticia_galeria, noticia_pdf, noticia_descripcion) VALUES ( '$noticia_titulo', '$noticia_fecha', '$noticia_imagen', '$noticia_video', '$noticia_galeria', '$noticia_pdf', '$noticia_descripcion')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Noticias  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$noticia_titulo = $data['noticia_titulo'];
		$noticia_fecha = $data['noticia_fecha'];
		$noticia_imagen = $data['noticia_imagen'];
		$noticia_video = $data['noticia_video'];
		$noticia_galeria = $data['noticia_galeria'];
		$noticia_pdf = $data['noticia_pdf'];
		$noticia_descripcion = $data['noticia_descripcion'];
		$query = "UPDATE noticias SET  noticia_titulo = '$noticia_titulo', noticia_fecha = '$noticia_fecha', noticia_imagen = '$noticia_imagen', noticia_video = '$noticia_video', noticia_galeria = '$noticia_galeria', noticia_pdf = '$noticia_pdf', noticia_descripcion = '$noticia_descripcion' WHERE noticia_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}