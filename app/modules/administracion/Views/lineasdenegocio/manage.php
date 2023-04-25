<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
  <form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>"
    data-bs-toggle="validator">
    <div class="content-dashboard">
      <input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
      <input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
      <?php if ($this->content->contenido_id) { ?>
      <input type="hidden" name="id" id="id" value="<?= $this->content->contenido_id; ?>" />
      <?php }?>
      <div class="row">
        <div class="col-12 form-group">
          <label class="control-label">Estado (Activar)</label>
          <input type="checkbox" name="contenido_estado" value="1" class="form-control switch-form "
            <?php if ($this->getObjectVariable($this->content, 'contenido_estado') == 1) { echo "checked";} ?>></input>
          <div class="help-block with-errors"></div>
        </div>
        <div class="col-12form-group">
          <label for="contenido_orden" class="control-label">Orden</label>
          <div class="row">
            <div class="col-2">
              <label class="radio-col">
                <input type="radio" value="1" <?php if($this->content->contenido_orden == '1'){ ?>
                  checked <?php } ?> name="contenido_orden" id="contenido_orden" class="form-control">
                <span>
                  <img src="/skins/administracion/images/orden1.png">
                </span>
              </label>
            </div>
            <div class="col-2">
              <label class="radio-col">
                <input type="radio" value="2" <?php if($this->content->contenido_orden == '2'){ ?>
                  checked <?php } ?> name="contenido_orden" id="contenido_orden" class="form-control">
                <span>
                  <img src="/skins/administracion/images/orden2.png">
                </span>
              </label>
            </div>
          </div>
          <div class="help-block with-errors"></div>
        </div>
        <div class="col-12 form-group">
          <label for="contenido_titulo" class="control-label">Titulo</label>
          <label class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text input-icono  fondo-verde-claro "><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" value="<?= $this->content->contenido_titulo; ?>" name="contenido_titulo"
              id="contenido_titulo" class="form-control" required>
          </label>
          <div class="help-block with-errors"></div>
        </div>
        <div class="col-12 form-group">
          <label for="contenido_fondo" class="control-label">Color de fondo</label>
          <label class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text input-icono  fondo-azul "><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" value="<?= $this->content->contenido_fondo; ?>" name="contenido_fondo"
              id="contenido_fondo" class="form-control">
          </label>
          <div class="help-block with-errors"></div>
        </div>
        <div class="col-12 form-group">
          <label for="contenido_descripcion" class="form-label">Descripci&oacute;n</label>
          <textarea name="contenido_descripcion" id="contenido_descripcion" class="form-control tinyeditor"
            rows="10"><?= $this->content->contenido_descripcion; ?></textarea>
          <div class="help-block with-errors"></div>
        </div>
      </div>
    </div>
    <div class="botones-acciones">
      <button class="btn btn-guardar" type="submit">Guardar</button>
      <a href="<?php echo $this->route; ?>" class="btn btn-cancelar">Cancelar</a>
    </div>
  </form>
</div>