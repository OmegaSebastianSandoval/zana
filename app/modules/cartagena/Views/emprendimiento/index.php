<div class="container">

    <div class="text-center mt-4">
        <h2 class="titulo-emprendimiento">Emprendimiento Inclusivo</h2>
    </div>

    <div class="row">
        <?php foreach ($this->emprendimiento as $key => $emp) { ?>

            <div class="col-sm-12 col-lg-6 col-xl-4">



                <div class="card card-emprendimiento">
                    <a href="/cartagena/emprendimiento/detalle?id=<?php echo $emp->emprendimiento_id ?>">
                        <img class="card-img-top" src="/images/<?php echo $emp->emprendimiento_imagen ?>" alt="Imagen del emprendimiento <?php echo $emp->emprendimiento_titulo ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $emp->emprendimiento_titulo ?></h5>
                            <div class="card-texto">
                                <?php echo $emp->emprendimiento_texto ?>
                            </div>
                            <p class="card-text w-100 d-grid d-sm-flex justify-content-between">
                                <small class="text-muted"><i class="fas fa-map-marker-alt"></i><?php echo $emp->emprendimiento_ciudad ?></small>

                                <small class="text-muted"> <i class="fas fa-calendar-alt"></i><?php echo getDateNumber($emp->emprendimiento_fecha); ?>

                                    <?php echo getDateMonth($emp->emprendimiento_fecha) ?>

                                    <?php echo getDateYear($emp->emprendimiento_fecha) ?>
                                </small>
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        <?php } ?>


    </div>
    <ul class="pagination justify-content-center">
        <?php
        $url = '/cartagena/emprendimiento';
        $min = $this->page - 10;
        if ($min < 0) {
            $min = 1;
        }
        $max = $this->page + 10;
        if ($this->totalpages > 1) {
            if ($this->page != 1)
                echo '<li class="page-item"><a class="page-link text-pagination" href="' . $url . '?page=' . ($this->page - 1) . '"> &laquo; Anterior </a></li>';
            for ($i = 1; $i <= $this->totalpages; $i++) {
                if ($this->page == $i) {
                    echo '<li class="page-item  fondo-pagination active"><a class="page-link  text-pagination">' . $this->page . '</a></li>';
                } else {
                    if ($i <= $max and $i >= $min) {
                        echo '<li class="page-item fondo-pagination"><a class="page-link text-pagination" href="' . $url . '?page=' . $i . '">' . $i . '</a></li>  ';
                    }
                }
            }
            if ($this->page != $this->totalpages)
                echo '<li class="page-item"><a class="page-link text-pagination" href="' . $url . '?page=' . ($this->page + 1) . '">Siguiente &raquo;</a></li>';
        }
        ?>
    </ul>
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