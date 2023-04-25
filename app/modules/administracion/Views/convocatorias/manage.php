<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>"  data-bs-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->convocatoria_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->convocatoria_id; ?>" />
			<?php }?>
			<div class="row">
				<div class="col-6 form-group">
					<label for="convocatoria_titulo"  class="control-label">Titulo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->convocatoria_titulo; ?>" name="convocatoria_titulo" id="convocatoria_titulo" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-6 form-group">
					<label for="convocatoria_fecha"  class="control-label">Fecha</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rojo-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->convocatoria_fecha; ?>" name="convocatoria_fecha" id="convocatoria_fecha" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="convocatoria_imagen" >Imagen</label>
					<input type="file" name="convocatoria_imagen" id="convocatoria_imagen" class="form-control  file-image" data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png"  >
					<div class="help-block with-errors"></div>
					<?php if($this->content->convocatoria_imagen) { ?>
						<div id="imagen_convocatoria_imagen">
							<img src="/images/<?= $this->content->convocatoria_imagen; ?>"  class="img-thumbnail thumbnail-administrator" />
							<div><button class="btn btn-danger btn-sm" type="button" onclick="eliminarImagen('convocatoria_imagen','<?php echo $this->route."/deleteimage"; ?>')"><i class="glyphicon glyphicon-remove" ></i> Eliminar Imagen</button></div>
						</div>
					<?php } ?>
				</div>
				<div class="col-12 form-group">
					<label for="convocatoria_video" class="form-label" >Video</label>
					<textarea name="convocatoria_video" id="convocatoria_video"   class="form-control" rows="10"   ><?= $this->content->convocatoria_video; ?></textarea>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="convocatoria_galeria"  class="control-label">Galer&iacute;a</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rosado " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->convocatoria_galeria; ?>" name="convocatoria_galeria" id="convocatoria_galeria" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="convocatoria_pdf" >PDF</label>
					<input type="file" name="convocatoria_pdf" id="convocatoria_pdf" class="form-control  file-document" data-buttonName="btn-primary" onchange="validardocumento('convocatoria_pdf');" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf" >
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="convocatoria_descripcion" class="form-label" >Descripci&oacute;n</label>
					<textarea name="convocatoria_descripcion" id="convocatoria_descripcion"   class="form-control tinyeditor" rows="10"   ><?= $this->content->convocatoria_descripcion; ?></textarea>
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