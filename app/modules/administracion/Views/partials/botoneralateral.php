<ul>
  <?php if (Session::getInstance()->get('kt_login_level') == '1') { ?>
    <li <?php if ($this->botonpanel == 1) { ?>class="activo" <?php } ?>><a href="/administracion/panel"><i class="fas fa-info-circle"></i> Información Página</a></li>
  <?php } ?>
  <li <?php if ($this->botonpanel == 2) { ?>class="activo" <?php } ?>><a href="/administracion/publicidad"><i class="far fa-images"></i> Administrar Publicidad</a></li>
  <li <?php if ($this->botonpanel == 3) { ?>class="activo" <?php } ?>><a href="/administracion/contenido"><i class="fas fa-file-invoice"></i> Administrar Contenidos</a></li>
  <li <?php if ($this->botonpanel == 19) { ?>class="activo" <?php } ?>><a href="/administracion/planes"><i class="fas fa-file-invoice"></i> Administrar Planes</a></li>
 
  <?php if (Session::getInstance()->get('kt_login_level') == '1') { ?>
    <li <?php if ($this->botonpanel == 4) { ?>class="activo" <?php } ?>><a href="/administracion/usuario"><i class="fas fa-users"></i> Administrar Usuarios</a></li>
  <?php } ?>
  <!-- <li <?php if ($this->botonpanel == 5) { ?>class="activo" <?php } ?>><a href="/administracion/politicas"><i class="fa-solid fa-file-arrow-down"></i> Administrar políticas</a></li> -->
  <!-- <li <?php if ($this->botonpanel == 6) { ?>class="activo" <?php } ?>><a href="/administracion/frecuentes"><i class="fa-solid fa-file-circle-question"></i> Administrar Preguntas Frecuentes</a></li> -->
  <li <?php if ($this->botonpanel == 7) { ?>class="activo" <?php } ?>><a href="/administracion/galeria"><i class="fa-solid fa-images"></i> Administrar Galería</a></li>
  <li <?php if ($this->botonpanel == 18) { ?>class="activo" <?php } ?>><a href="/administracion/imagenesgaleria"><i class="fa-solid fa-images"></i> Administrar Imagenes Galería</a></li>
  <!-- <li <?php if ($this->botonpanel == 8) { ?>class="activo" <?php } ?>><a href="/administracion/lineasdenegocio"><i class="fa-solid fa-briefcase"></i> Administrar Lineas de Negocio</a></li> -->
  <!-- <li <?php if ($this->botonpanel == 9) { ?>class="activo" <?php } ?>><a href="/administracion/noticias"><i class="fa-solid fa-newspaper"></i> Administrar Noticias</a></li> -->
  <!-- <li <?php if ($this->botonpanel == 10) { ?>class="activo" <?php } ?>><a href="/administracion/sostenibilidad"><i class="fa-solid fa-people-line"></i> Administrar Sostenibilidad</a></li> -->
  <!-- <li <?php if ($this->botonpanel == 11) { ?>class="activo" <?php } ?>><a href="/administracion/convocatorias"><i class="fa-solid fa-calendar"></i> Administrar Convocatorias</a></li> -->
  <!-- <li <?php if ($this->botonpanel == 12) { ?>class="activo" <?php } ?>><a href="/administracion/habeasdata"><i class="fa-solid fa-calendar"></i> Administrar Habeas data</a></li> -->
  <!-- <li <?php if ($this->botonpanel == 13) { ?>class="activo" <?php } ?>><a href="/administracion/ciudades"><i class="fa-solid fa-calendar"></i> Administrar Ciudades</a></li> -->
  <li <?php if ($this->botonpanel == 14) { ?>class="activo" <?php } ?>><a href="/administracion/tipohabitacion"><i class="fa-solid fa-file-invoice"></i> Administrar Tipos de Habitación</a></li>
  <li <?php if ($this->botonpanel == 15) { ?>class="activo" <?php } ?>><a href="/administracion/habitaciones"><i class="fa-solid fa-file-invoice"></i> Administrar  Habitaciones</a></li>
  <li <?php if ($this->botonpanel == 16) { ?>class="activo" <?php } ?>><a href="/administracion/imageneshabitacion"><i class="fa-solid fa-images"></i> Administrar Imágenes de las Habitaciones</a></li>
  <li <?php if ($this->botonpanel == 17) { ?>class="activo" <?php } ?>><a href="/administracion/emprendimiento"><i class="fa-solid fa-file-invoice"></i> Administrar Emprendimiento</a></li>

</ul>