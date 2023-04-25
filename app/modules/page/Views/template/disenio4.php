<?php if ($contenido->contenido_seccion == 10 &&  $contenido->contenido_tipo == 5) { ?>
	<div class="caja-contenido-simple blog-home p-0 design-four four-<?php echo $contenido->contenido_id ?>" style="background-color: <?php if ($contenido->contenido_fondo_color) {
																																			echo  $contenido->contenido_fondo_color;
																																		} else if ($colorfondo) {
																																			echo $colorfondo;
																																		}   ?> <?php if ($contenido->contenido_borde == '1') {
																																					echo '; border: 2px solid #13436B; border-radius:20px; padding: 0 !important; overflow: hidden; ';
																																				} ?>">
		<?php if ($contenido->contenido_enlace) { ?>
			<a <?php if ($contenido->contenido_enlace_abrir == 1) { ?> target="_blank" <?php } ?> href='<?php echo $contenido->contenido_enlace; ?>'>
				<?php if ($contenido->contenido_imagen) { ?>


					<img class="rounded-circle  blog-home-imagen" src="/images/<?php echo $contenido->contenido_imagen; ?>">

				<?php } ?>
			
			<?php if ($contenido->contenido_titulo_ver == 1) { ?>
				<h2><?php echo $contenido->contenido_titulo; ?></h2>
			<?php } ?>

			<div>
				<div class="descripcion blog-home-descripcion" style="<?php if ($contenido->contenido_borde == '1') {
																			echo 'padding: 10px; ';
																		} ?>">
					<?php echo $contenido->contenido_descripcion; ?>
				</div>
			</div>
			</a>
		<?php } else { ?>


			<img class=" rounded-circle blog-home-imagen" alt="<?php echo $contenido->contenido_titulo; ?>" src="/images/<?php echo $contenido->contenido_imagen; ?>">



			<?php if ($contenido->contenido_titulo_ver == 1) { ?>
				<h2><?php echo $contenido->contenido_titulo; ?></h2>
			<?php } ?>

			<div class="descripcion blog-home-descripcion" style="<?php if ($contenido->contenido_borde == '1') {
																		echo 'padding: 10px; ';
																	} ?>">
				<?php echo $contenido->contenido_descripcion; ?>
			</div>
			<?php if ($contenido->contenido_archivo) { ?>
				<div align="center" class="archivo">
					<a href="/files/<?php echo $contenido->contenido_archivo ?>" target="blank">Descargar Archivo <i class="fas fa-download"></i></a>
				</div>
			<?php } ?>
			<?php if ($contenido->contenido_enlace && $contenido->contenido_id == '186') { ?>
				<div>
					<a href="<?php echo $contenido->contenido_enlace; ?>" <?php if ($contenido->contenido_enlace_abrir == 1) { ?> target="_blank" <?php } ?> class="btn btn-block btn-vermas"> <?php if ($contenido->contenido_vermas) { ?><?php echo $contenido->contenido_vermas; ?><?php } else { ?>Ver Más<?php } ?></a>
				</div>
			<?php } ?>
		<?php } ?>

	</div>
<?php } else { ?>

	<div class="caja-contenido-simple p-0 design-four four-<?php echo $contenido->contenido_id ?>" style="background-color: <?php if ($contenido->contenido_fondo_color) {
																																echo  $contenido->contenido_fondo_color;
																															} else if ($colorfondo) {
																																echo $colorfondo;
																															}   ?> <?php if ($contenido->contenido_borde == '1') {
																																		echo '; border: 2px solid #13436B; border-radius:20px; padding: 0 !important; overflow: hidden; ';
																																	} ?>">

		<a <?php if ($contenido->contenido_enlace_abrir == 1) { ?> target="_blank" <?php } ?> href='<?php echo $contenido->contenido_enlace; ?>'>
			<?php if ($contenido->contenido_imagen) { ?>
				<div class="imagen-contenido">
					<div>

						<img src="/images/<?php echo $contenido->contenido_imagen; ?>">
					</div>
				</div>
			<?php } ?>
			<?php if ($contenido->contenido_titulo_ver == 1) { ?>
				<h2><?php echo $contenido->contenido_titulo; ?></h2>
			<?php } ?>

			<div>
				<div class="descripcion" style="<?php if ($contenido->contenido_borde == '1') {
													echo 'padding: 10px; ';
												} ?>">
					<?php echo $contenido->contenido_descripcion; ?>
				</div>
			</div>
		</a>
		<?php if ($contenido->contenido_archivo) { ?>
			<div align="center" class="archivo">
				<a href="/files/<?php echo $contenido->contenido_archivo ?>" target="blank">Descargar Archivo <i class="fas fa-download"></i></a>
			</div>
		<?php } ?>
		<?php if ($contenido->contenido_enlace && $contenido->contenido_id == '186') { ?>
			<div>
				<a href="<?php echo $contenido->contenido_enlace; ?>" <?php if ($contenido->contenido_enlace_abrir == 1) { ?> target="_blank" <?php } ?> class="btn btn-block btn-vermas"> <?php if ($contenido->contenido_vermas) { ?><?php echo $contenido->contenido_vermas; ?><?php } else { ?>Ver Más<?php } ?></a>
			</div>
		<?php } ?>

	</div>
<?php } ?>