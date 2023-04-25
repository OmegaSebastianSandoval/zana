<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>"  data-bs-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->emprendimiento_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->emprendimiento_id; ?>" />
			<?php }?>
			<div class="row">
		<div class="col-12 form-group">
			<label   class="control-label">Activar</label>
				<input type="checkbox" name="emprendimiento_estado" value="1" class="form-control switch-form " <?php if ($this->getObjectVariable($this->content, 'emprendimiento_estado') == 1) { echo "checked";} ?>   ></input>
				<div class="help-block with-errors"></div>
		</div>
				<div class="col-4 form-group">
					<label for="emprendimiento_titulo"  class="control-label">Titulo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-morado " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->emprendimiento_titulo; ?>" name="emprendimiento_titulo" id="emprendimiento_titulo" class="form-control"  required >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-4 form-group">
					<label for="emprendimiento_imagen" >Imagen</label>
					<input type="file" name="emprendimiento_imagen" id="emprendimiento_imagen" class="form-control  file-image" data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png"  >
					<div class="help-block with-errors"></div>
					<?php if($this->content->emprendimiento_imagen) { ?>
						<div id="imagen_emprendimiento_imagen">
							<img src="/images/<?= $this->content->emprendimiento_imagen; ?>"  class="img-thumbnail thumbnail-administrator" />
							<div><button class="btn btn-danger btn-sm" type="button" onclick="eliminarImagen('emprendimiento_imagen','<?php echo $this->route."/deleteimage"; ?>')"><i class="glyphicon glyphicon-remove" ></i> Eliminar Imagen</button></div>
						</div>
					<?php } ?>
				</div>
				<div class="col-4 form-group">
					<label for="emprendimiento_fecha"  class="control-label">Fecha</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rosado " ><i class="fas fa-calendar-alt"></i></span>
						</div>
					<input type="text" value="<?php if($this->content->emprendimiento_fecha){ echo $this->content->emprendimiento_fecha; } else { echo date('Y-m-d'); } ?>" name="emprendimiento_fecha" id="emprendimiento_fecha" class="form-control"   data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-language="es"  >
					</label>
					<div class="help-block with-errors"></div>
				</div>
		<div class="col-4 form-group mt-4">
			<label   class="control-label">Importante</label>
				<input type="checkbox" name="emprendimiento_importante" value="1" class="form-control switch-form " <?php if ($this->getObjectVariable($this->content, 'emprendimiento_importante') == 1) { echo "checked";} ?>   ></input>
				<div class="help-block with-errors"></div>
		</div>
				<div class="col-4 form-group">
					<label class="control-label">Ciudad</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul-claro " ><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="emprendimiento_ciudad"  required >
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_emprendimiento_ciudad AS $key => $value ){?>
								<option <?php if($this->getObjectVariable($this->content,"emprendimiento_ciudad") == $key ){ echo "selected"; }?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="emprendimiento_texto" class="form-label" >Texto</label>
					<textarea name="emprendimiento_texto" id="emprendimiento_texto"   class="form-control tinyeditor" rows="10"   ><?= $this->content->emprendimiento_texto; ?></textarea>
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