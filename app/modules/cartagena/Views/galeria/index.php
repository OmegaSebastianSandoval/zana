<!-- <div class="container">
<?php print_r($this->imagenes) ?>
    <h2>Galería</h2>

</div> -->

<div class="container gallery-container">

    <h1>Galería</h1>



    <div id="static-thumbnails" class="static-thumbnails  p-4">
        <?php foreach ($this->imagenes as $key => $imagen) { ?>

            <a class="lightgallery" href="/images/<?php echo $imagen->imagen_imagen ?>">
                <img data-title="<?php echo  $imagen->imagen_nombre ?>" src="/images/<?php echo $imagen->imagen_imagen ?>" alt="Imagen de <?php echo $imagen->imagen_nombre ?>" />
                <label class="overlay"> <?php echo  $imagen->imagen_nombre ?></label>

            </a>

        <?php } ?>

    </div>
    <ul class="pagination justify-content-center">
        <?php
        $url = '/cartagena/galeria';
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


<script>
    lightGallery(document.getElementById('static-thumbnails'), {
        titleElement: 'data-title',

    });
</script>