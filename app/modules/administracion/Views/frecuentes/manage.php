<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>"  data-bs-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->frecuente_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->frecuente_id; ?>" />
			<?php }?>
			<div class="row">
		<div class="col-12 form-group">
			<label   class="control-label">Estado (Activar)</label>
				<input type="checkbox" name="frecuente_estado" value="1" class="form-control switch-form " <?php if ($this->getObjectVariable($this->content, 'frecuente_estado') == 1) { echo "checked";} ?>   ></input>
				<div class="help-block with-errors"></div>
		</div>
				<div class="col-12 form-group">
					<label for="frecuente_pregunta"  class="control-label">Pregunta</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->frecuente_pregunta; ?>" name="frecuente_pregunta" id="frecuente_pregunta" class="form-control"  required >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="frecuente_respuesta" class="form-label" >Respuesta</label>
					<textarea name="frecuente_respuesta" id="frecuente_respuesta"   class="form-control tinyeditor" rows="10"><?= $this->content->frecuente_respuesta; ?></textarea>
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