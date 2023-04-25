<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>"  data-bs-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->noticia_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->noticia_id; ?>" />
			<?php }?>
			<div class="row">
				<div class="col-6 form-group">
					<label for="noticia_titulo"  class="control-label">Titulo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rosado " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->noticia_titulo; ?>" name="noticia_titulo" id="noticia_titulo" class="form-control"  required >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-6 form-group">
					<label for="noticia_fecha"  class="control-label">Fecha de creaci&oacute;n</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="date" value="<?= $this->content->noticia_fecha; ?>" name="noticia_fecha" id="noticia_fecha" class="form-control"  required >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="noticia_imagen" >Imagen</label>
					<input type="file" name="noticia_imagen" id="noticia_imagen" class="form-control  file-image" data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png"  <?php if(!$this->content->noticia_id){ echo 'required'; } ?>>
					<div class="help-block with-errors"></div>
					<?php if($this->content->noticia_imagen) { ?>
						<div id="imagen_noticia_imagen">
							<img src="/images/<?= $this->content->noticia_imagen; ?>"  class="img-thumbnail thumbnail-administrator" />
							<div><button class="btn btn-danger btn-sm" type="button" onclick="eliminarImagen('noticia_imagen','<?php echo $this->route."/deleteimage"; ?>')"><i class="glyphicon glyphicon-remove" ></i> Eliminar Imagen</button></div>
						</div>
					<?php } ?>
				</div>
				<div class="col-12 form-group">
					<label for="noticia_video" class="form-label" >Video</label>
					<textarea name="noticia_video" id="noticia_video"   class="form-control" rows="10"   ><?= $this->content->noticia_video; ?></textarea>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="noticia_galeria"  class="control-label">Galer&iacute;a</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->noticia_galeria; ?>" name="noticia_galeria" id="noticia_galeria" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="noticia_pdf" >PDF</label>
					<input type="file" name="noticia_pdf" id="noticia_pdf" class="form-control  file-document" data-buttonName="btn-primary" onchange="validardocumento('noticia_pdf');" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf" >
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="noticia_descripcion" class="form-label" >Descripci&oacute;n</label>
					<textarea name="noticia_descripcion" id="noticia_descripcion"   class="form-control tinyeditor" rows="10"   >
            <?php if($this->content->noticia_descripcion){ ?>
              <?php echo $this->content->noticia_descripcion; ?>
            <?php }else{ ?><p>&nbsp;</p>
              <hr />
              <p><strong>M&aacute;s informaci&oacute;n</strong></p>
              <p>Alexandra Angel Ortega<br />Subdirectora de gesti&oacute;n sostenible y comunicaciones de Corparques<br />Celular: <a href="https://wa.me/573213250788">3213250788</a></p>
              <p>Alexander Barrios Morales<br />Profesional l&iacute;der de comunicaciones Corparques<br />Celular: <a href="https://wa.me/5730575040590">30575040590</a></p>
            <?php } ?>
              
          </textarea>
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