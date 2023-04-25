<section class="row section-index">

  <div class="col-sm-12 col-lg-6 left" style=" background-image: url(/images/<?php echo $this->bogota->publicidad_imagen ?>);">

    <div class="contenido-home">

      <?php echo $this->bogota->publicidad_descripcion ?>

      <a class="btn" href="<?php echo $this->bogota->publicidad_enlace === '' ? '#' : $this->bogota->publicidad_enlace ?>" target="<?php if ($this->bogota->publicidad_tipo_enlace === '1') {
                                                                                                                                      echo '_blank';
                                                                                                                                    } ?>">
        <?php echo $this->bogota->publicidad_texto_enlace === '' ? 'Ver más' : $this->bogota->publicidad_texto_enlace ?>
      </a>
    </div>
  </div>

  <div class="col-sm-12 col-lg-6 left left-responsive" style=" background-image: url(/images/<?php echo $this->bogota->publicidad_imagenresponsive ?>);">

    <div class="contenido-home">

      <?php echo $this->bogota->publicidad_descripcion ?>

      <a class="btn" href="<?php echo $this->bogota->publicidad_enlace === '' ? '#' : $this->bogota->publicidad_enlace ?>" target="<?php if ($this->bogota->publicidad_tipo_enlace === '1') {
                                                                                                                                      echo '_blank';
                                                                                                                                    } ?>">
        <?php echo $this->bogota->publicidad_texto_enlace === '' ? 'Ver más' : $this->bogota->publicidad_texto_enlace ?>
      </a>
    </div>
  </div>


  <div class="col-sm-12 col-lg-6  right" style=" background-image: url(/images/<?php echo $this->cartagena->publicidad_imagen ?>);">
    <div class="contenido-home">

      <?php echo $this->cartagena->publicidad_descripcion ?>

      <a class="btn" href="<?php echo $this->cartagena->publicidad_enlace === '' ? '#' : $this->cartagena->publicidad_enlace ?>" target="<?php if ($this->cartagena->publicidad_tipo_enlace === '1') {
                                                                                                                                            echo '_blank';
                                                                                                                                          } ?>">
        <?php echo $this->cartagena->publicidad_texto_enlace === '' ? 'Ver más' : $this->cartagena->publicidad_texto_enlace ?>
      </a>
    </div>
  </div>
  <div class="col-sm-12 col-lg-6  right right-responsive" style=" background-image: url(/images/<?php echo $this->cartagena->publicidad_imagenresponsive ?>);">
    <div class="contenido-home">

      <?php echo $this->cartagena->publicidad_descripcion ?>

      <a class="btn" href="<?php echo $this->cartagena->publicidad_enlace === '' ? '#' : $this->cartagena->publicidad_enlace ?>" target="<?php if ($this->cartagena->publicidad_tipo_enlace === '1') {
                                                                                                                                            echo '_blank';
                                                                                                                                          } ?>">
        <?php echo $this->cartagena->publicidad_texto_enlace === '' ? 'Ver más' : $this->cartagena->publicidad_texto_enlace ?>
      </a>
    </div>
  </div>
</section>