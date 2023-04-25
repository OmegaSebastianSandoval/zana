<div class="container">
    <?php echo   $this->contenido ?>
    <?php echo   $this->contenidoCartagena ?>


    <div class="text-center mt-4">
        <h2 class="titulo-emprendimiento">Planes</h2>
    </div>

    <div class="row">
        <?php foreach ($this->planes as $key => $emp) { ?>

            <div class="col-sm-12 col-lg-6 col-xl-4">



                <div class="card card-planes">
                    <a href="/cartagena/hotel/detalle?id=<?php echo $emp->plan_id ?>">
                        <img class="card-img-top" src="/images/<?php echo $emp->plan_imagen ?>" alt="Imagen del emprendimiento <?php echo $emp->plan_nombre ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $emp->plan_nombre ?></h5>
                            <div class="card-texto">
                                <?php echo $emp->plan_descripcion ?>
                            </div>
                            <p class="card-text w-100 d-grid d-sm-flex justify-content-between">
                                <small class="text-muted"><i class="fas fa-map-marker-alt"></i><?php echo $emp->plan_ciudad ?></small>

                            </p>
                        </div>
                    </a>
                </div>
            </div>
        <?php } ?>


    </div>
</div>