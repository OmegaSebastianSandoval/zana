<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>"  data-bs-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->galeria_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->galeria_id; ?>" />
			<?php }?>
			<div class="row">
		<div class="col-12 form-group">
			<label   class="control-label">Activar</label>
				<input type="checkbox" name="galeria_estado" value="1" class="form-control switch-form " <?php if ($this->getObjectVariable($this->content, 'galeria_estado') == 1) { echo "checked";} ?>   ></input>
				<div class="help-block with-errors"></div>
		</div>
				<div class="col-6 form-group">
					<label for="galeria_nombre"  class="control-label">Nombre</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->galeria_nombre; ?>" name="galeria_nombre" id="galeria_nombre" class="form-control"  required >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-6 form-group">
					<label class="control-label">Ciudad</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rojo-claro " ><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="galeria_ciudad"  required >
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_galeria_ciudad AS $key => $value ){?>
								<option <?php if($this->getObjectVariable($this->content,"galeria_ciudad") == $key ){ echo "selected"; }?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
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