<div class="banner-home">
  <?php echo $this->banner; ?>
</div>
<div class="contenidos-container">
  <div class="row mx-0">
    <!-- <?php echo $this->contenido ?> -->
  </div>
</div>
<div class="container">
  <div class="container-frecuentes row justify-content-center">
    <div class="col-10">
      <h2 class="title">Preguntas frecuentes</h2>
    </div>
    <div class="col-10">
      <div class="accordion" id="accordionFrecuentes">
        <?php foreach($this->frecuentes as $frecuente): ?>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#frecuente_<?php echo $frecuente->frecuente_id ?>" aria-expanded="false" aria-controls="collapseOne">
                <?php echo $frecuente->frecuente_pregunta ?>
              </button>
            </h2>
            <div id="frecuente_<?php echo $frecuente->frecuente_id ?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionFrecuentes">
              <div class="accordion-body">
                <?php echo $frecuente->frecuente_respuesta ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
<style>
  body{
    background: #F1F1F1;
  }
</style>