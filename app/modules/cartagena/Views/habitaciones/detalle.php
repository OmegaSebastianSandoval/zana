<div class="loading">Cargando imagenes...</div>
<div class="container contenedor-galeria">
<a href="/cartagena/habitaciones" class="btn btn-habitacion">
        <i class="fa-solid fa-arrow-left"></i> Volver
    </a>
  
    <h1>
        <?php echo $this->imagenes[0]->habitacion_nombre ?>
    </h1>
    <h4>
        Tipo de habitación: <span class="tipo-habitacion"> <?php echo $this->imagenes[0]->habitacion_tipo ?></span>

    </h4>
    <div class="descripcion-seccion">
        <?php echo $this->imagenes[0]->habitacion_descripcion ?>

    </div>
    <div class="d-flex justify-content-between mt-2 habitacion-precios ">
        <p> Precio con desayuno: <span class="habitacion-precio">$<?php echo $this->imagenes[0]->habitacion_precio_condesayuno ?>
            </span></p>

        <p> Precio sin desayuno: <span class="habitacion-precio">$<?php echo $this->imagenes[0]->habitacion_precio_sindesayuno ?>
            </span></p>
    </div>

    <div class="synch-carousels">

        <div class="left child">
            <div class="gallery">
                <?php foreach ($this->imagenes as $key => $imagen) { ?>


                    <?php foreach ($imagen->fotos as $key => $foto) { ?>
                        <div class="item">
                            <img src="/images/<?php echo $foto->imagenes_habitacion_imagen ?>" alt="">
                        </div>

                    <?php } ?>


                <?php } ?>
            </div>
        </div>

        <div class="right child">
            <div class="gallery2">
                <?php foreach ($this->imagenes as $key => $imagen) { ?>


                    <?php foreach ($imagen->fotos as $key => $foto) { ?>
                        <div class="item">
                            <img src="/images/<?php echo $foto->imagenes_habitacion_imagen ?>" alt="">
                        </div>

                    <?php } ?>


                <?php } ?>
            </div>
            <div class="nav-arrows">
                <button class="arrow-left">
                    <!--SVGs from iconmonstr.com-->
                    <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                        <path d="M2.117 12l7.527 6.235-.644.765-9-7.521 9-7.479.645.764-7.529 6.236h21.884v1h-21.883z" />
                    </svg>
                </button>
                <button class="arrow-right">
                    <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                        <path d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z" />
                    </svg>
                </button>
            </div>
            <div class="photos-counter">
                <span></span><span></span>
            </div>
        </div>
    </div>
</div>

<style>
  .headerHome {
    display: none;
  }

  .headerCartagena {
    display: block;
  }

</style>

<!-- <?php
        $numero = 50000;
        $numeroFormateado = number_format($numero);
        echo "El dinero formateado es:  ";
        echo '$' . $numeroFormateado;
        echo "<br>";
        ?> -->

<script>
    const $left = $(".left");
    const $gl = $(".gallery");
    const $gl2 = $(".gallery2");
    const $photosCounterFirstSpan = $(".photos-counter span:nth-child(1)");

    $gl2.on("init", (event, slick) => {
        $photosCounterFirstSpan.text(`${slick.currentSlide + 1}/`);
        $(".photos-counter span:nth-child(2)").text(slick.slideCount);
    });

    $gl.slick({
        rows: 0,
        slidesToShow: 2,
        arrows: false,
        draggable: false,
        useTransform: false,
        mobileFirst: true,
        responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 3
                }
            },


            {
                breakpoint: 1023,
                settings: {
                    slidesToShow: 1,
                    vertical: true
                }
            }
        ]
    });





    $gl2.slick({
        rows: 0,
        useTransform: false,
        prevArrow: ".arrow-left",
        nextArrow: ".arrow-right",
        fade: true,
        asNavFor: $gl
    });


    function handleCarouselsHeight() {
        if (window.matchMedia("(min-width: 1024px)").matches) {
            const gl2H = $(".gallery2").height();
            $left.css("height", gl2H);
        } else {
            $left.css("height", "auto");
        }
    }

    $(window).on("load", () => {
        handleCarouselsHeight();
        setTimeout(() => {
            $(".loading").fadeOut();
            $("body").addClass("over-visible");
        }, 300);
    });





    $(".gallery .item").on("click", function() {
        const index = $(this).attr("data-slick-index");
        $gl2.slick("slickGoTo", index);
    });

    $gl2.on("afterChange", (event, slick, currentSlide) => {
        $photosCounterFirstSpan.text(`${slick.currentSlide + 1}/`);
    });
</script>