var videos = [];
$(document).ready(function () {
  $('.toggler-docs').on('click', function () {
    $('.docs-container').slideToggle(300);
  })
  $('.dropdown-toggle').dropdown();
  $(".carouselsection").carousel({
    quantity: 4,
    sizes: {
      '900': 3,
      '500': 1
    }
  });

  $('.banner-video-youtube').each(function () {
    // console.log($(this).attr('data-video'));
    const datavideo = $(this).attr('data-video');
    const idvideo = $(this).attr('id');
    const playerDefaults = {
      'autoplay': 0,
      'autohide': 1,
      'modestbranding': 0,
      'rel': 0,
      'showinfo': 0,
      'controls': 0,
      'disablekb': 1,
      'enablejsapi': 0,
      'iv_load_policy': 3
    };
    const video = {
      'videoId': datavideo,
      'suggestedQuality': 'hd1080'
    };
    videos[videos.length] = new YT.Player(idvideo, {
      'videoId': datavideo,
      'playerVars': playerDefaults,
      'events': {
        'onReady': onAutoPlay,
        'onStateChange': onFinish
      }
    });
  });

  function onAutoPlay(event) {
    event.target.playVideo();
    event.target.mute();
  }

  function onFinish(event) {
    if (event.data === 0) {
      event.target.playVideo();
    }
  }
  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
  const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))


  //Funciones lineas de negocio

  $('.sm-img').on('click', function () {
    let _id = $(this).attr('data-id'),
      _parent = $(this).attr('data-parent')
    $('.big-img.parent_' + _parent).removeClass('active');
    $('#' + _parent + '_' + _id).addClass('active');
  })
  $('.btn-show-galeria').on('click', function () {
    $('.btn-show-noticias').removeClass('active');
    $('.btn-show-galeria').addClass('active');
    $('.container-galeria').show(300);
    $('.container-noticias').hide();
  })
  $('.btn-show-noticias').on('click', function () {
    $('.btn-show-noticias').addClass('active');
    $('.btn-show-galeria').removeClass('active');
    $('.container-galeria').hide();
    $('.container-noticias').show(300);
  })

  //Función enviar correo

  $('#contactForm').on('submit', function (e) {
    e.preventDefault();
    let _data = $(this).serializeArray();
    $.ajax({
      url: $(this).attr('action'),
      type: 'POST',
      dataType: 'json',
      data: _data,
      success: function (data) {
        if (data.status == 'ok') {
          Swal.fire({
            title: '¡Gracias!',
            text: 'Su mensaje ha sido recibido correctamente.',
            icon: 'success',
          })
        } else if(data.status == 'error') {
          Swal.fire({
            title: '¡Error!',
            text: 'Ha ocurrido un error enviando el mensaje, intente nuevamente.',
            icon: 'error',
          })
        }
      }
    })
  })


  let classes = ['', 'p-fz-2', 'p-fz-3', 'p-fz-4'];
  let activeNumber = 0

  $('.acces-float .plus').on('click', function(){
    if(activeNumber <= 3){
      // $(this).attr('data-number', parseInt(activeNumber) + 1);
      activeNumber++;
      if(activeNumber > 3){
        activeNumber = 3;
      }
      $('p').removeClass(classes[activeNumber-1]);
      $('.text-container p span').removeClass(classes[activeNumber-1]);
      $('.descripcion p').removeClass(classes[activeNumber-1]);
      $('.descripcion p span').removeClass(classes[activeNumber-1]);
      $('.descripcion p a').removeClass(classes[activeNumber-1]);
      $('p').addClass(classes[activeNumber]);
      $('.text-container p span').addClass(classes[activeNumber]);
      $('.descripcion p').addClass(classes[activeNumber]);
      $('.descripcion p span').addClass(classes[activeNumber]);
      $('.descripcion p a').addClass(classes[activeNumber]);
    }
  })
  $('.acces-float .minus').on('click', function(){
    if(activeNumber >= 0){
      // $(this).attr('data-number', parseInt(activeNumber) - 1);
      activeNumber--
      if(activeNumber < 0){
        activeNumber = 0;
      }
      $('p').removeClass(classes[activeNumber+1]);
      $('.text-container p span').removeClass(classes[activeNumber+1]);
      $('.descripcion p').removeClass(classes[activeNumber+1]);
      $('.descripcion p span').removeClass(classes[activeNumber+1]);
      $('.descripcion p a').removeClass(classes[activeNumber+1]);
      $('p').addClass(classes[activeNumber]);
      $('.text-container p span').addClass(classes[activeNumber]);
      $('.descripcion p').addClass(classes[activeNumber]);
      $('.descripcion p span').addClass(classes[activeNumber]);
      $('.descripcion p a').addClass(classes[activeNumber]);
    }
  })

});
$(document).ready(function () {
  $('.menu-toggler').on('click', function () {
    $('.header-responsive .menu').slideToggle(300);
  })
  $('.submenu-toggler').on('click', function (e) {
    e.preventDefault()
    $('.submenu').slideUp(300)
    let _id = $(this).attr('data-id')
    if ($(this).hasClass('active')) {
      $(this).removeClass('active')
      $(`#${_id}`).slideUp(300)
    } else {
      $('.submenu-toggler').removeClass('active')
      $(this).addClass('active')
    }
    $(`.submenu-${_id}`).slideToggle(300);
  })
})