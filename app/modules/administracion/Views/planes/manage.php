<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>"  data-bs-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->plan_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->plan_id; ?>" />
			<?php }?>
			<div class="row">
		<div class="col-12 form-group">
			<label   class="control-label">Activar</label>
				<input type="checkbox" name="plan_estado" value="1" class="form-control switch-form " <?php if ($this->getObjectVariable($this->content, 'plan_estado') == 1) { echo "checked";} ?>   ></input>
				<div class="help-block with-errors"></div>
		</div>
				<div class="col-6 form-group">
					<label for="plan_nombre"  class="control-label">Nombre</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->plan_nombre; ?>" name="plan_nombre" id="plan_nombre" class="form-control"  required >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-6 form-group">
					<label for="plan_imagen" >Imagen</label>
					<input type="file" name="plan_imagen" id="plan_imagen" class="form-control  file-image" data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png"  >
					<div class="help-block with-errors"></div>
					<?php if($this->content->plan_imagen) { ?>
						<div id="imagen_plan_imagen">
							<img src="/images/<?= $this->content->plan_imagen; ?>"  class="img-thumbnail thumbnail-administrator" />
							<div><button class="btn btn-danger btn-sm" type="button" onclick="eliminarImagen('plan_imagen','<?php echo $this->route."/deleteimage"; ?>')"><i class="glyphicon glyphicon-remove" ></i> Eliminar Imagen</button></div>
						</div>
					<?php } ?>
				</div>
				<div class="col-6 form-group">
					<label for="plan_precio_condesayuno"  class="control-label">Precio con desayuno</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rojo-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->plan_precio_condesayuno; ?>" name="plan_precio_condesayuno" id="plan_precio_condesayuno" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-6 form-group">
					<label for="plan_precio_sindesayuno"  class="control-label">Precio sin desayuno</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-morado " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->plan_precio_sindesayuno; ?>" name="plan_precio_sindesayuno" id="plan_precio_sindesayuno" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-6 form-group">
					<label class="control-label">Ciudad</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rosado " ><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="plan_ciudad"  required >
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_plan_ciudad AS $key => $value ){?>
								<option <?php if($this->getObjectVariable($this->content,"plan_ciudad") == $key ){ echo "selected"; }?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col-12 form-group">
					<label for="plan_descripcion" class="form-label" >Descripcion</label>
					<textarea name="plan_descripcion" id="plan_descripcion"   class="form-control tinyeditor" rows="10"   ><?= $this->content->plan_descripcion; ?></textarea>
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