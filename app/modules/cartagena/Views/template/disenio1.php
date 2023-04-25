<div class="caja-contenido-simple d design-one-bogota mb-3" style="background-color: <?php if ($contenido->contenido_fondo_color) {
																							echo  $contenido->contenido_fondo_color;
																						} else if ($contenido->colorfondo) {
																							echo $contenido->colorfondo;
																						}   ?>">


	<div class="row">
		<?php if ($contenido->contenido_titulo_ver == 1) { ?>
			<h3 class="d-block d-lg-none "><?php echo $contenido->contenido_titulo; ?></h3>
		<?php } ?>
		<div <?php if ($contenido->contenido_imagen) { ?>class="col-md-12 col-lg-7 order-2 order-md-1" <?php } else { ?>class="col-md-12" <?php } ?>>
			<?php if ($contenido->contenido_titulo_ver == 1) { ?>
				<h3 class="d-none  d-lg-block "><?php echo $contenido->contenido_titulo; ?></h3>
			<?php } ?>
			<div class="descripcion">
				<?php echo $contenido->contenido_descripcion; ?>
			</div>
			<?php if ($contenido->contenido_archivo) { ?>
				<div align="center" class="archivo">
					<a href="/files/<?php echo $contenido->contenido_archivo ?>" target="blank">Descargar Archivo <i class="fas fa-download"></i></a>
				</div>
			<?php } ?>
			<div>
				<?php if ($contenido->contenido_enlace) { ?>
					<a href="" class="btn btn-block btn-vermas" <?php if ($contenido->contenido_enlace_abrir == 1) { ?> target="blank" <?php } ?>> <?php if ($contenido->contenido_vermas) { ?><?php echo $contenido->contenido_vermas; ?><?php } else { ?>Ver Más<?php } ?></a>
				<?php } ?>
			</div>
		</div>
		<?php if ($contenido->contenido_imagen) { ?>
			<div class="col-md-12 col-lg-5 imagen order-1 order-md-2">
				<img src="/images/<?php echo $contenido->contenido_imagen; ?>">
			</div>
		<?php } ?>
	</div>
	<hr>
</div>