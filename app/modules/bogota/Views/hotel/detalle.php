<div class="container">

    <a href="/bogota/hotel" class="btn btn-habitacion mt-4">
        <i class="fa-solid fa-arrow-left"></i> Volver
    </a>

    <div class="detalle-plan mt-4">
        <div class="row">
            <div class="col-sm-12 col-lg-5 mb-3">
                <img class="img-detalle-emp" src="/images/<?php echo $this->plan->plan_imagen ?>" alt="Imagen del plan<?php echo $this->plan->plan_nombre ?>">
            </div>
            <div class="col-sm-12 col-md-7 mb-3">
                <h2><?php echo $this->plan->plan_nombre ?></h2>
                <div class="row card-text ">

                    <div class="col-sm-12"> <i class="fas fa-map-marker-alt"></i>
                        <small class="text-muted"> <?php echo $this->plan->plan_ciudad ?></small>
                    </div>
                    <?php if ($this->plan->plan_precio_condesayuno) { ?>

                        <div class="col-sm-12">

                            Precio con desayuno:<small class="text-muted"> $ <?php echo $this->plan->plan_precio_condesayuno ?>
                            </small></div>
                    <?php } ?>

                    <?php if ($this->plan->plan_precio_sindesayuno) { ?>
                        <div class="col-sm-12">
                            Precio sin desayuno: <small class="text-muted"> $<?php echo $this->plan->plan_precio_sindesayuno ?>
                            </small>
                        </div>

                    <?php } ?>


                </div>
                <div class="detalle-descripcion">
                    <?php echo $this->plan->plan_descripcion ?>
                </div>
            </div>
        </div>
    </div>



</div>