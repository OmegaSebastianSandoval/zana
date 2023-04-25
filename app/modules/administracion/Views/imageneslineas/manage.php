<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>"  data-bs-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->imagen_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->imagen_id; ?>" />
			<?php }?>
			<div class="row">
		<div class="col-12 form-group">
			<label   class="control-label">Estado (Activar)</label>
				<input type="checkbox" name="imagen_estado" value="1" class="form-control switch-form " <?php if ($this->getObjectVariable($this->content, 'imagen_estado') == 1) { echo "checked";} ?>   ></input>
				<div class="help-block with-errors"></div>
		</div>
				<div class="col-12 form-group">
					<label for="imagen_nombre"  class="control-label">Nombre</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->imagen_nombre; ?>" name="imagen_nombre" id="imagen_nombre" class="form-control"  required >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="imagen_imagen" >Imagen</label>
					<input type="file" name="imagen_imagen" id="imagen_imagen" class="form-control  file-image" data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png"  >
					<div class="help-block with-errors"></div>
					<?php if($this->content->imagen_imagen) { ?>
						<div id="imagen_imagen_imagen">
							<img src="/images/<?= $this->content->imagen_imagen; ?>"  class="img-thumbnail thumbnail-administrator" />
							<div><button class="btn btn-danger btn-sm" type="button" onclick="eliminarImagen('imagen_imagen','<?php echo $this->route."/deleteimage"; ?>')"><i class="glyphicon glyphicon-remove" ></i> Eliminar Imagen</button></div>
						</div>
					<?php } ?>
				</div>
				<div class="col-12 form-group">
					<label for="imagen_video" class="form-label" >V&iacute;deo</label>
					<textarea name="imagen_video" id="imagen_video"   class="form-control" rows="10"   ><?= $this->content->imagen_video; ?></textarea>
					<div class="help-block with-errors"></div>
				</div>
				<input type="hidden" name="imagen_linea"  value="<?php if($this->content->imagen_linea){ echo $this->content->imagen_linea; } else { echo $this->linea_id; } ?>">
			</div>
		</div>
		<div class="botones-acciones">
			<button class="btn btn-guardar" type="submit">Guardar</button>
			<a href="<?php echo $this->route; ?>?linea_id=<?php if($this->content->imagen_linea){ echo $this->content->imagen_linea; } else { echo $this->linea_id; } ?>" class="btn btn-cancelar">Cancelar</a>
		</div>
	</form>
</div>