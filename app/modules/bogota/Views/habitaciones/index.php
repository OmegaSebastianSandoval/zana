<div class="container">
    
    <div class="row">

        <label class="titulo-interna">Bogotá</label>
        <div class="row">
            <?php foreach ($this->habitacionesBogota as $key => $habitacion) { ?>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="hotel-card bg-white rounded-lg shadow overflow-hidden d-block mb-4 ">
                        <div class="hotel-card_images">
                            <img src="/images/<?php echo $habitacion->habitacion_imagen ?>" alt="Imagen de la habitación <?php echo $habitacion->habitacion_nombre ?>">
                        </div>
                        <div class="hotel-card_info p-4">
                            <div class="d-flex align-items-center mb-2">
                                <h5 class="mb-0 mr-2"><?php echo $habitacion->habitacion_nombre ?></h5>

                            </div>
                            <div class="hotel-card_details ">
                                <div class="text-muted d-flex justify-content-between mb-2">
                                    <p> <i class="fas fa-map-marker-alt"></i> <?php echo $habitacion->habitacion_ciudad ?>
                                    </p>
                                    <p><i class="fa-solid fa-bed"></i> <?php echo $habitacion->habitacion_tipo ?></p>
                                </div>


                                <div class="hotel-descr p-0 mb-2">
                                    <?php echo $habitacion->habitacion_descripcion ?>
                                </div>
                            </div>

                            <a href="/bogota/habitaciones/detalle?id=<?php echo $habitacion->habitacion_id ?>" class="btn btn-block btn-habitacion">
                                Ver Habitación
                            </a>
                        </div>
                    </div>


                </div>
            <?php } ?>

        </div>

    </div>



</div>