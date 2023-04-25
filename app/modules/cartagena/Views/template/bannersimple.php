<div class="slider-simple banner-simple">
	<div id="carouselsimple<?php echo $this->seccionbanner;  ?>" class="carousel slide" data-ride="carousel">
		<?php foreach ($this->banners as $key => $banner) { ?>
			<?php if ($banner->publicidad_enlace) { ?>
				<?php if ($banner->publicidad_nombre) { ?>
								<h2 class="titulo-seccion"><?php echo $banner->publicidad_nombre; ?></h2>
							<?php } ?>
				<a href="<?php if ($banner->publicidad_enlace != "") {
								echo $banner->publicidad_enlace;
							} else {
								echo "";
							} ?>" target="<?php if ($banner->publicidad_enlace_abrir == 1) { ?>_blank<?php } ?>">

					<div class="carousel-inner carousel-banner-simple">

						<div class="carousel-item <?php if ($key == 0) { ?>active <?php } ?>">

							<img class="d-block w-100" src="/images/<?php echo $banner->publicidad_imagen; ?>" alt="<?php echo $banner->publicidad_nombre; ?>">
							<div class="carousel-caption d-flex h-100 align-items-center  <?php if ($banner->contenido_columna_alineacion == 2) { ?>justify-content-center text-center<?php } else if ($banner->contenido_columna_alineacion == 3) { ?> justify-content-end text-right  <?php } else { ?> justify-content-start  text-left<?php } ?>">
								<div class="<?php echo $banner->contenido_columna; ?>">
									<div class="content-caption" style="background-color:<?php echo $banner->contenido_fondo_color; ?> ">

										<div><?php echo $banner->publicidad_descripcion; ?></div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</a>
			<?php } else { ?>
				<div class="carousel-inner">

					<div class="carousel-item <?php if ($key == 0) { ?>active <?php } ?>">
						<?php if ($banner->publicidad_nombre) { ?>
							<h2 class="titulo-seccion"><?php echo $banner->publicidad_nombre; ?></h2>
						<?php } ?>
						<img class="d-block w-100" src="/images/<?php echo $banner->publicidad_imagen; ?>" alt="<?php echo $banner->publicidad_nombre; ?>">
						<div class="carousel-caption d-flex h-100 align-items-center  <?php if ($banner->contenido_columna_alineacion == 2) { ?>justify-content-center text-center<?php } else if ($banner->contenido_columna_alineacion == 3) { ?> justify-content-end text-right  <?php } else { ?> justify-content-start  text-left<?php } ?>">
							<div class="<?php echo $banner->contenido_columna; ?>">
								<div class="content-caption" style="background-color:<?php echo $banner->contenido_fondo_color; ?> ">

									<div><?php echo $banner->publicidad_descripcion; ?></div>
								</div>
							</div>
						</div>
					</div>

				</div>
			<?php }  ?>
		<?php }  ?>

	</div>
</div>