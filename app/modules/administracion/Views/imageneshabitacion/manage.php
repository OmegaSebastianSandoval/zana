<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>"  data-bs-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->imagenes_habitacion_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->imagenes_habitacion_id; ?>" />
			<?php }?>
			<div class="row">
		<div class="col-12 form-group">
			<label   class="control-label">Estado</label>
				<input type="checkbox" name="imagenes_habitacion_estado" value="1" class="form-control switch-form " <?php if ($this->getObjectVariable($this->content, 'imagenes_habitacion_estado') == 1) { echo "checked";} ?>   ></input>
				<div class="help-block with-errors"></div>
		</div>
				<div class="col-4 form-group">
					<label class="control-label">Habitacion</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde-claro " ><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="imagenes_habitacion_habitacion"  required >
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_imagenes_habitacion_habitacion AS $key => $value ){?>
								<option <?php if($this->getObjectVariable($this->content,"imagenes_habitacion_habitacion") == $key ){ echo "selected"; }?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-4 form-group">
					<label for="imagenes_habitacion_titulo"  class="control-label">Titulo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->imagenes_habitacion_titulo; ?>" name="imagenes_habitacion_titulo" id="imagenes_habitacion_titulo" class="form-control"  required >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-4 form-group">
					<label for="imagenes_habitacion_imagen" >Imagen</label>
					<input type="file" name="imagenes_habitacion_imagen" id="imagenes_habitacion_imagen" class="form-control  file-image" data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png"  <?php if(!$this->content->imagenes_habitacion_id){ echo 'required'; } ?>>
					<div class="help-block with-errors"></div>
					<?php if($this->content->imagenes_habitacion_imagen) { ?>
						<div id="imagen_imagenes_habitacion_imagen">
							<img src="/images/<?= $this->content->imagenes_habitacion_imagen; ?>"  class="img-thumbnail thumbnail-administrator" />
							<div><button class="btn btn-danger btn-sm" type="button" onclick="eliminarImagen('imagenes_habitacion_imagen','<?php echo $this->route."/deleteimage"; ?>')"><i class="glyphicon glyphicon-remove" ></i> Eliminar Imagen</button></div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="botones-acciones">
			<button class="btn btn-guardar" type="submit">Guardar</button>
			<a href="<?php echo $this->route; ?>" class="btn btn-cancelar">Cancelar</a>
		</div>
	</form>
</div>