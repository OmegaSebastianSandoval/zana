<?php

/**
 * clase que genera la insercion y edicion  de Planes en la base de datos
 */
class Administracion_Model_DbTable_Planes extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'planes';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'plan_id';

	/**
	 * insert recibe la informacion de un Planes y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data)
	{
		$plan_estado = $data['plan_estado'];
		$plan_nombre = $data['plan_nombre'];
		$plan_imagen = $data['plan_imagen'];
		$plan_precio_condesayuno = $data['plan_precio_condesayuno'];
		$plan_ciudad = $data['plan_ciudad'];
		$plan_precio_sindesayuno = $data['plan_precio_sindesayuno'];
		$plan_descripcion = $data['plan_descripcion'];
		// $plan_descripcion = substr($data['plan_descripcion'], 0, -69);

		$query = "INSERT INTO planes( plan_estado, plan_nombre, plan_imagen, plan_precio_condesayuno, plan_ciudad, plan_precio_sindesayuno, plan_descripcion) VALUES ( '$plan_estado', '$plan_nombre', '$plan_imagen', '$plan_precio_condesayuno', '$plan_ciudad', '$plan_precio_sindesayuno', '$plan_descripcion')";
		$res = $this->_conn->query($query);
		return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Planes  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data, $id)
	{

		$plan_estado = $data['plan_estado'];
		$plan_nombre = $data['plan_nombre'];
		$plan_imagen = $data['plan_imagen'];
		$plan_precio_condesayuno = $data['plan_precio_condesayuno'];
		$plan_ciudad = $data['plan_ciudad'];
		$plan_precio_sindesayuno = $data['plan_precio_sindesayuno'];
		$plan_descripcion = $data['plan_descripcion'];
		// $plan_descripcion = substr($data['plan_descripcion'], 0, -69);
		$query = "UPDATE planes SET  plan_estado = '$plan_estado', plan_nombre = '$plan_nombre', plan_imagen = '$plan_imagen', plan_precio_condesayuno = '$plan_precio_condesayuno', plan_ciudad = '$plan_ciudad', plan_precio_sindesayuno = '$plan_precio_sindesayuno', plan_descripcion = '$plan_descripcion' WHERE plan_id = '" . $id . "'";
		$res = $this->_conn->query($query);
	}
}
