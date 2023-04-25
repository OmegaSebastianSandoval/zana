<div class="container">

    <a href="/page/emprendimiento" class="btn btn-habitacion mt-4">
        <i class="fa-solid fa-arrow-left"></i> Volver
    </a>
    <div class="row">
        <div class="col-sm-12 col-lg-9 mt-4">
            <div class="detalle-emprendimiento">
                <img class="img-detalle-emp" src="/images/<?php echo $this->emprendimiento->emprendimiento_imagen ?>" alt="Imagen del emprendimiento<?php echo $this->emprendimiento->emprendimiento_titulo ?>">
                <h2><?php echo $this->emprendimiento->emprendimiento_titulo ?></h2>
                <p class="card-text w-100 d-flex justify-content-between">
                    <small class="text-muted"><i class="fas fa-map-marker-alt"></i>
                        <?php echo $this->emprendimiento->emprendimiento_ciudad ?></small>

                    <small class="text-muted"> <i class="fas fa-calendar-alt"></i>

                        <?php echo getDateNumber($this->emprendimiento->emprendimiento_fecha); ?>

                        <?php echo getDateMonth($this->emprendimiento->emprendimiento_fecha) ?>

                        <?php echo getDateYear($this->emprendimiento->emprendimiento_fecha) ?>
                    </small>
                </p>
                <div class="detalle-descripcion">
                    <?php echo $this->emprendimiento->emprendimiento_texto ?>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-lg-3 mt-4">
            <h3 class="text-destacados">Destacados</h3>
            <?php foreach ($this->destacados as $key => $emp) { ?>
                <div class="destacados">
                    <a href="/page/emprendimiento/detalle?id=<?php echo $emp->emprendimiento_id ?>">
                        <img class="img-detalle-emp" src="/images/<?php echo $emp->emprendimiento_imagen ?>" alt="Imagen del emprendimiento<?php echo $emp->emprendimiento_titulo ?>">
                        <h4><?php echo $emp->emprendimiento_titulo ?></h4>
                    </a>
                    <div class="detalle-descripcion">
                        <?php echo $emp->emprendimiento_texto ?>
                    </div>

                </div>
                <hr>
            <?php } ?>
        </div>
    </div>
</div>
<?php

function getDateNumber($date)
{
    $date = date('d', strtotime($date));
    return $date;
}

function getDateMonth($date)
{
    $months = ['ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic'];
    $date = date('m', strtotime($date));
    $date = $months[$date - 1];
    return $date;
}
function getDateYear($date)
{

    $anio =  date("Y", strtotime($date));
    return $anio;
}

?>