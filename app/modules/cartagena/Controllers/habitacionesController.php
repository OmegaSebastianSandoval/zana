<?php

/**
 *
 */

class Cartagena_habitacionesController extends Cartagena_mainController
{

        public function indexAction()
        {
                $habitacionesModel = new Page_Model_DbTable_Habitaciones();
                $this->_view->habitacionesCartagena =  $habitacionesModel->getList("habitacion_ciudad = 'Cartagena' AND habitacion_estado = '1' ");
        }
        public function detalleAction()
        {
                $habitacionesModel = new Page_Model_DbTable_Habitaciones();
                $imagenesHabitacion = new Page_Model_DbTable_Imageneshabitacion();
                $id = $this->_getSanitizedParam("id");
                $habitacion = $habitacionesModel->getList("habitacion_id = '$id' AND habitacion_estado = '1'", "");
                foreach ($habitacion as $key => $value) {
                        $value->fotos = $imagenesHabitacion->getList("imagenes_habitacion_habitacion = " . $id, "");
                }
                $this->_view->imagenes = $habitacion;
        }
}
