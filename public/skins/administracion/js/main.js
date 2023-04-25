$(document).ready(function () {
  tinymce.init({
    selector: 'textarea.tinyeditor',  // change this value according to your HTML
    plugins: [
      'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
      'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
      'insertdatetime', 'media', 'table', 'help', 'wordcount', 'code', 'file-manager'
    ],
    toolbar: 'undo redo | blocks | ' +
      'bold italic backcolor | alignleft aligncenter ' +
      'alignright alignjustify | bullist numlist outdent indent | ' +
      'removeformat | Upload Flmngr ImgPen | code | help ',
    Flmngr: {
      urlFileManager: '/components/flmngr/flmngr.php',
      urlFiles: '/upload',
      acceptextensions: ["zip", "psd", "html", "doc", "xml", "pdf", "js", "txt"]
    },
    image_advtab: true,
    a_plugin_option: true,
    language: 'es',
    a_configuration_option: 400,
    browser_spellcheck: true,
    contextmenu: false,
    skin: 'oxide-dark',
    content_css: 'tinymce-5',
  });
  $('.deletePolDoc').on('click', function () {
    let id = $(this).attr('data-id');
    $.ajax({
      url: '/administracion/politicas/deletedocument',
      method: 'POST',
      data: {
        id: id
      },
      dataType: 'json',
      success: function (data) {
        if (data == 'ok') {
          $('#doc_' + id).remove();
        }
      }
    })
  })
  $(function () {
    $('#fecha_tipo_bloqueo').on('change', function () {
      let _val = $(this).val()
      if (_val == '1') {
        $('#fecha_ciudad').show(300)
        $('#fecha_empleado').val('')
        $('#fecha_empleado').hide(300)
      } else if (_val == '2') {
        $('#fecha_empleado').show(300)
        $('#fecha_ciudad').val('')
        $('#fecha_ciudad').hide(300)
      } else if (_val == '3') {
        $('#fecha_empleado').val('')
        $('#fecha_empleado').hide(300)
        $('#fecha_ciudad').val('')
        $('#fecha_ciudad').hide(300)
      }
    })
  })

  $(".file-image").fileinput({
    maxFileSize: 10000,
    previewFileType: "image",
    allowedFileExtensions: ["jpg", "jpeg", "gif", "png", "ico"],
    browseClass: "btn  btn-verde",
    showUpload: false,
    showRemove: false,
    browseIcon: "<i class=\"fas fa-image\"></i> ",
    browseLabel: "Imagen",
    language: "es",
    dropZoneEnabled: false
  });

  $(".file-document").fileinput({
    maxFileSize: 2048,
    previewFileType: "image",
    browseLabel: "Archivo",
    browseClass: "btn  btn-cafe",
    allowedFileExtensions: ["pdf", "xlsx", "xls", "doc", "docx", "ico"],
    showUpload: false,
    showRemove: false,
    browseIcon: "<i class=\"fas fa-folder-open\"></i> ",
    language: "es",
    dropZoneEnabled: false
  });

  $(".file-robot").fileinput({
    maxFileSize: 2048,
    previewFileType: "image",
    allowedFileExtensions: ["txt", ".txt"],
    browseClass: "btn btn-success btn-file-robot",
    showUpload: false,
    showRemove: false,
    browseLabel: "Robot",
    browseIcon: "<i class=\"fas fa-robot\"></i> ",
    language: "es",
    dropZoneEnabled: false,
    showPreview: false
  });

  $(".file-sitemap").fileinput({
    maxFileSize: 2048,
    previewFileType: "image",
    allowedFileExtensions: ["xml", ".xml"],
    browseClass: "btn btn-success btn-file-sitemap",
    showUpload: false,
    showRemove: false,
    browseLabel: "SiteMap",
    browseIcon: "<i class=\"fas fa-sitemap\"></i> ",
    language: "es",
    dropZoneEnabled: false,
    showPreview: false
  });
  $('[ data-bs-toggle="tooltip"]').tooltip();
  $(".up_table,.down_table").click(function () {
    var row = $(this).parents("tr:first");
    var value = row.find("input").val();
    var content1 = row.find("input").attr("id");
    var content2 = 0;
    if ($(this).is(".up_table")) {
      if (row.prev().find("input").val() > 0) {
        row.find("input").val(row.prev().find("input").val());
        row.prev().find("input").val(value);
        content2 = row.prev().find("input").attr("id");
        row.insertBefore(row.prev());
      }
    } else {
      if (row.next().find("input").val() > 0) {
        row.find("input").val(row.next().find("input").val());
        row.next().find("input").val(value);
        content2 = row.next().find("input").attr("id");
        row.insertAfter(row.next());
      }
    }
    var route = $("#order-route").val();
    var csrf = $("#csrf").val();
    if (route != "") {
      $.post(route, {
        'csrf': csrf,
        'id1': content1,
        'id2': content2
      });
    }
  });


  $(".selectpagination").change(function () {
    var route = $("#page-route").val();
    var pages = $(this).val();
    $.post(route, {
      'pages': pages
    }, function () {
      location.reload();
    });
  });

  $(".changetheme").on("change", function () {
    var color = "#FFFFFF";

    var contenedor = $(this).attr("data-campo-tiny");
    if ($(this).val() == 1) {
      color = "#333333";
    }
    var editor = window.tinyMCE.get(contenedor);
    editor.getWin().document.body.style.backgroundColor = color;

  });
  $(".switch-form").bootstrapSwitch({
    "onText": "Si",
    "offText": "No"
  });
  let text = document.getElementById('contenido_tipo').value;

  function aparecercolumna() {
    let id_columna = document.getElementById('contenido_tipo').value;
    if (id_columna == '5' || id_columna == '6') {
      $(".no-colum").attr("style", "display:block!important")

    } else {

      $(".no-colum").attr("style", "display:none!important")

    }
  }
  $("#contenido_tipo").on("change", function () {
    var value = $(this).val();
    if (parseInt(value) == 1) {
      //Si es un banner
      $(".no-seccion").hide();
      $(".no-banner").hide();
      $(".no-contenido").hide();
      $(".si-banner").show();
    } else if (parseInt(value) == 2) {
      //Si es un Contenedor
      $(".no-seccion").hide();
      $(".no-banner").hide();
      $(".no-contenido").hide();
      $(".si-seccion").show();
    } else if (parseInt(value) == 3) {
      //Si es un contenido simple
      $(".no-seccion").hide();
      $(".no-banner").hide();
      $(".no-contenido").hide();
      $(".si-contenido").show();
    } else if (parseInt(value) == 5) {
      //Si es un contenido de Contenedor
      $(".no-acordion").hide();
      $(".no-carrousel").hide();
      $(".no-contenido2").hide();
      $(".si-contenido2").show();
    } else if (parseInt(value) == 6) {
      //Si es un contenido de Contenedor
      $(".no-contenido2").hide();
      $(".no-acordion").show();
      $(".no-carrousel").hide();
      $(".si-carrousel").show();
    } else if (parseInt(value) == 7) {
      //Si es un banner
      $(".no-acordion").hide();
      $(".no-contenido2").hide();
      $(".no-acordion").hide();
      $(".no-carrousel").hide();
      $(".si-acordion").show();
    }
  });
  $(".colorpicker").colorpicker({
    onChange: function (e) {
      console.log("entro");
    }
  }).on('colorpickerChange colorpickerCreate', function (e) {
    console.log("entro");
    // console.log( e.colorpicker.picker.parents('.input-group'));
    //e.colorpicker.picker.parents('.input-group').find('input').css('background-color', e.value);
  }).on('create', function (e) {
    var val = $(this).val();
    $(this).css({
      backgroundColor: $(this).val()
    });
  }).on('change', function (e) {
    var val = $(this).val();
    $(this).css({
      backgroundColor: $(this).val()
    });
  });
});

function aparecercolumna() {
  let id_columna = document.getElementById('contenido_tipo').value;
  if (id_columna == '5' || id_columna == '6') {
    $(".no-colum").attr("style", "display:block!important")

  } else {

    $(".no-colum").attr("style", "display:none!important")

  }
}
aparecercolumna();

function eliminarImagen(campo, ruta) {
  var csrf = $("#csrf").val();
  var csrf_section = $("#csrf_section").val();
  var id = $("#id").val();
  if (confirm("¿Esta seguro de borrar esta imagen?") == true) {
    $.post(ruta, {
      "id": id,
      "csrf": csrf,
      "csrf_section": csrf_section,
      "campo": campo
    }, function (data) {
      if (parseInt(data.elimino) == 1) {
        $("#imagen_" + campo).hide();
      }
    });

  }
  return false;
}

function eliminararchivo(campo, ruta) {
  var csrf = $("#csrf").val();
  var csrf_section = $("#csrf_section").val();
  var id = $("#id").val();
  if (confirm("���Esta seguro de borrar este Archivo?") == true) {
    $.post(ruta, {
      "id": id,
      "csrf": csrf,
      "csrf_section": csrf_section,
      "campo": campo
    }, function (data) {
      if (parseInt(data.elimino) == 1) {
        $("#archivo_" + campo).hide();
      }
    });

  }
  return false;
}