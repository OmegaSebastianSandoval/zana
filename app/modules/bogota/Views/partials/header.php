

<div class="header">
  <div class="social-container container">
    <ul class="social-icons">
      <?php if ($this->infopage->info_pagina_youtube) { ?>
        <li><a href="<?php echo $this->infopage->info_pagina_youtube ?>" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
      <?php } ?>
      <?php if ($this->infopage->info_pagina_facebook) { ?>
        <li><a href="<?php echo $this->infopage->info_pagina_facebook ?>" target="_blank"><i class="fa-brands fa-facebook"></i></a></li>
      <?php } ?>

      <?php if ($this->infopage->info_pagina_instagram) { ?>
        <li><a href="<?php echo $this->infopage->info_pagina_instagram ?>" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
      <?php } ?>

      <?php if ($this->infopage->info_pagina_twitter) { ?>
        <li><a href="<?php echo $this->infopage->info_pagina_twitter ?>" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>

      <?php } ?>

      <?php if ($this->infopage->info_pagina_linkedin) { ?>
        <li><a href="<?php echo $this->infopage->info_pagina_linkedin ?>" target="_blank"><i class="fa-brands fa-linkedin"></i></a></li>


      <?php } ?>

      <?php if ($this->infopage->info_pagina_pinterest) { ?>
        <li><a href="<?php echo $this->infopage->info_pagina_pinterest ?>" target="_blank"><i class="fa-brands fa-pinterest"></i></a></li>
      <?php } ?>

      <?php if ($this->infopage->info_pagina_flickr) { ?>
        <li><a href="<?php echo $this->infopage->info_pagina_flickr ?>" target="_blank"><i class="fa-brands fa-flickr"></i></a></li>


      <?php } ?>
      <?php if ($this->infopage->info_pagina_whatsapp) { ?>
        <!-- <?php $whatsapp = intval(preg_replace('/[^0-9]+/', '', $this->infopage->info_pagina_whatsapp), 10);  ?> -->

        <li><a href="https://api.whatsapp.com/send?phone=<?php echo $this->infopage->info_pagina_whatsapp ?>" target="_blank"><i class="fa-brands fa-whatsapp"></i></a></li>


      <?php } ?>

      <li><a href=""><i class="fa-solid fa-language"></i></a></li>
    </ul>
  </div>
  <div class="navbar  navbar-expand-lg">
    <div class="container">
      <ul class="nav d-flex justify-content-between w-100">
        <li class="nav-item"> <a href="/">
            <img src="/skins/page/images/logoZana.png" alt="">
          </a></li>
        <li class="nav-item">
          <a href="/" class="link">Inicio</a>
        </li>
        <li class="nav-item">
          <a href="/bogota/hotel" class="link">Hotel</a>
        </li>
        <li class="nav-item">
          <a href="/bogota/ofertas" class="link">Ofertas</a>
        </li>
        <li class="nav-item">
          <a href="/bogota/galeria" class="link">Galería</a>
        </li>
        <li class="nav-item">
          <a href="/bogota/emprendimiento" class="link">Emprendimiento</a>
        </li>
        <li class="nav-item">
          <a href="/bogota/habitaciones" class="link">Habitaciones</a>
        </li>
      </ul>
    </div>
  </div>
</div>
<div class="header-responsive">
  <div class="d-flex">
    <div class="col-6">
      <a href="/page" class="nav-brand">
        <img src="/skins/page/images/logoZana.png" class="logo">
      </a>
    </div>
    <div class="col-6 d-flex justify-content-end">
      <span class="menu-toggler">
        <i class="fa fa-bars" aria-hidden="true"></i>
      </span>
    </div>
  </div>
  <div class="menu row mx-0">
    <div class="col-12">
      <ul class="principal-menu">
        <li class="link-item">
          <a href="/" class="link">Inicio</a>
        </li>
        <li>
          <a href="/bogota/hotel" class="link">Hotel</a>
        </li>
        <li>
          <a href="/bogota/ofertas" class="link">Ofertas</a>
        </li>
        <li>
          <a href="/bogota/galeria" class="link">Galería</a>
        </li>
        <li>
          <a href="/bogota/emprendimiento" class="link">Emprendimiento</a>
        </li>
        <li>
          <a href="/bogota/habitaciones" class="link">Habitaciones</a>
        </li>
      </ul>
    </div>
  </div>
</div>