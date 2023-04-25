<?php 
/**
* clase que genera la insercion y edicion  de Habeas data en la base de datos
*/
class Administracion_Model_DbTable_Habeasdata extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'habeas_data';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'data_id';

	/**
	 * insert recibe la informacion de un Habeas data y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$data_name = $data['data_name'];
		$data_mail = $data['data_mail'];
		$data_phone = $data['data_phone'];
		$data_date = $data['data_date'];
		$data_time = $data['data_time'];
		$data_ip = $data['data_ip'];
		$data_agree = $data['data_agree'];
		$query = "INSERT INTO habeas_data( data_name, data_mail, data_phone, data_date, data_time, data_ip, data_agree) VALUES ( '$data_name', '$data_mail', '$data_phone', '$data_date', '$data_time', '$data_ip', '$data_agree')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Habeas data  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$data_name = $data['data_name'];
		$data_mail = $data['data_mail'];
		$data_phone = $data['data_phone'];
		$data_date = $data['data_date'];
		$data_time = $data['data_time'];
		$data_ip = $data['data_ip'];
		$data_agree = $data['data_agree'];
		$query = "UPDATE habeas_data SET  data_name = '$data_name', data_mail = '$data_mail', data_phone = '$data_phone', data_date = '$data_date', data_time = '$data_time', data_ip = '$data_ip', data_agree = '$data_agree' WHERE data_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}