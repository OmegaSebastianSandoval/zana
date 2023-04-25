<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
  <form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>"
    data-bs-toggle="validator">
    <div class="content-dashboard">
      <input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
      <input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
      <?php if ($this->content->politica_id) { ?>
      <input type="hidden" name="id" id="id" value="<?= $this->content->politica_id; ?>" />
      <?php }?>
      <div class="row">
        <div class="col-12 form-group">
          <label class="control-label">Estado (Activar)</label>
          <input type="checkbox" name="politica_estado" value="1" class="form-control switch-form "
            <?php if ($this->getObjectVariable($this->content, 'politica_estado') == 1) { echo "checked";} ?>></input>
          <div class="help-block with-errors"></div>
        </div>
        <div class="col-12 form-group">
          <label for="politica_nombre" class="control-label">Nombre</label>
          <label class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text input-icono  fondo-cafe "><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" value="<?= $this->content->politica_nombre; ?>" name="politica_nombre"
              id="politica_nombre" class="form-control" required>
          </label>
          <div class="help-block with-errors"></div>
        </div>
        <div class="col-6 form-group">
          <label for="politica_archivo">Archivo</label>
          <input type="file" name="politica_archivo" id="politica_archivo" class="form-control  file-document"
            data-buttonName="btn-primary" onchange="validardocumento('politica_archivo');"
            accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf">
            <?php if($this->content->politica_archivo){ ?>
              <div id="doc_<?php echo $this->content->politica_id ?>">
                <a href="/files/<?php echo $this->content->politica_archivo ?>" target="_blank"><?php echo $this->content->politica_archivo ?></a>
                <br>
                <span class="btn btn-sm btn-danger deletePolDoc" data-id="<?php echo $this->content->politica_id ?>">
                  Eliminar archivo
                </span>
              </div>
            <?php } ?>
          <div class="help-block with-errors"></div>
        </div>
        <div class="col-6 form-group">
          <label class="control-label">Secci&oacute;n</label>
          <label class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text input-icono  fondo-verde "><i class="far fa-list-alt"></i></span>
            </div>
            <select class="form-control" name="politica_seccion" required>
              <option value="">Seleccione...</option>
              <?php foreach ($this->list_politica_seccion AS $key => $value ){?>
              <option
                <?php if($this->getObjectVariable($this->content,"politica_seccion") == $key ){ echo "selected"; }?>
                value="<?php echo $key; ?>" /> <?= $value; ?></option>
              <?php } ?>
            </select>
          </label>
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