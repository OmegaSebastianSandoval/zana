<img class="image-gallry-container  imagen_galeria_home_<?php echo $contenido->contenido_id ?>" src="/images/<?php echo $contenido->contenido_imagen ?>" alt="<?php echo $contenido->contenido_titulo ?>" onclick="$('#modalGallery-<?php echo $contenido->contenido_id ?>').modal('show')">

<!-- Modal -->
<div class="modal fade" id="modalGallery-<?php echo $contenido->contenido_id ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content" style="background: transparent; border: none;">
      <div class="modal-header" style="background:linear-gradient(45deg, #30303c, #1b5499);border:none;">

        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>
      <div class="modal-body modal-body-galeria d-flex justify-content-center">
        <img class="img-modal" src="/images/<?php echo $contenido->contenido_imagen ?>" alt="<?php echo $contenido->contenido_titulo ?>">
      </div>
      <div style="background:linear-gradient(45deg, #30303c, #1b5499);border:none; padding: 5px;" class="modal-footer">
        <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
