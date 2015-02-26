$(document).ready(function(){
  // To test the @id toggling on password inputs in browsers that don’t support changing an input’s @type dynamically (e.g. Firefox 3.6 or IE), uncomment this:
  // $.fn.hide = function() { return this; }
  // Then uncomment the last rule in the <style> element (in the <head>).
  // Invoke the plugin placeholder ie olds
  $('input, textarea').placeholder();
  // That’s it, really.


     //flexslider para publicidad
   $('.flexslider').flexslider({
        animation: "fade",
        start: function(slider){
          $('body').removeClass('loading');
        }
    });

    $('.flexslideraside').flexslider({
        animation: "slide",
        start: function(slider){
          $('body').removeClass('loading');
        }
    });

    //valida solo numeros en el campo de texto
    $('#telefono').numeric();
   
  

  //contador de caracteres textarea 
   $("#description").each(function(){
        var longitud = $(this).val().length;
            $(this).parent().find('#longitud_textarea').html('<b>'+longitud+'</b> / 256 Caracteres');
            $(this).keyup(function(){ 
              var nueva_longitud = $(this).val().length;
              $(this).parent().find('#longitud_textarea').html('<b>'+nueva_longitud+'</b> / 256 Caracteres');
              if (nueva_longitud == "256") {
                $('#longitud_textarea').css('color', '#ff0000');
              }
            });
    });


  //evento tipo anunciante muestra-oculta input text empresa
  $("#comboAnunciante").change(function(){
    // 1 - Particular
    // 2 - Agencia Inmobiliaria (activar campo de texto empresa)
    // 3 - Broker (activar campo de texto empresa)
    if($("#comboAnunciante").find(':selected').val()==2 || $("#comboAnunciante").find(':selected').val()==3 || $("#comboAnunciante").find(':selected').val()==4){
      $(".divOculto").show("slow");
    }else{
      $(".divOculto").hide("slow");
    }
  });

 

  //evento para el combo dependiente estados-delegaciones
  $("#selectEstados").change(function(){
    var idEstado = $("#selectEstados").find(':selected').val();
     $.ajax({
          url:"http://todoweb.in/gotcha/index/delegaciones",
          async:true,
          data:"idEstado="+idEstado,
          beforeSend: function(datos){
             $('#selectDelegaciones').append('<option value="" selected="selected">Cargando...</option>');
          },
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $("#selectDelegaciones").html(datos); 
          },
          type:"POST",
          timeout:10000,
        });
  });

  //evento para el combo dependiente delegaciones-colonias
  $("#selectDelegaciones").change(function(){
    var idEstado = $("#selectEstados").find(':selected').val();
    var idDelegacion = $("#selectDelegaciones").find(':selected').val();
     $.ajax({
          url:"http://todoweb.in/gotcha/index/colonias",
          async:true,
          data:"idEstado="+idEstado+"&idDelegacion="+idDelegacion,
          beforeSend: function(datos){
            $('#selectColonias').append('<option value="" selected="selected">Cargando...</option>');
          },
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $("#selectColonias").html(datos); 
          },
          type:"POST",
          timeout:10000,
        });
    //$("#selectColonias").load('http://todoweb.in/gotcha/index/colonias?idDelegacion='+idDelegacion+'&tipoPropiedad='+tipoPropiedad+'&operacion='+operacion+'&idEstado='+idEstado);
  });

  
  //EVENTOS LLENADO SELECTS DEPENDIENTES DELEGACIONES-COLONIAS PARA BACKEND PUBLICAR ANUNCIO

  $("#selectEstadosPublicar").change(function(){
    $.ajax({
          url:"http://todoweb.in/gotcha/index/delegaciones_publicar_anuncio",
          async:true,
          data:"idEstado="+$("#selectEstadosPublicar").find(':selected').val(),
          beforeSend: function(datos){
            $('#selectDelegacionesPublicar').append('<option value="" selected="selected">Cargando...</option>');
          },
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $("#selectDelegacionesPublicar").html(datos); 
          },
          type:"POST",
          timeout:10000,
        });
    //$("#selectDelegacionesPublicar").load('http://todoweb.in/gotcha/index/delegaciones_publicar_anuncio?idEstado='+idEstado);
  });

  $("#selectDelegacionesPublicar").change(function(){
     $.ajax({
          url:"http://todoweb.in/gotcha/index/colonias_publicar_anuncio",
          async:true,
          data:"idDelegacion="+$("#selectDelegacionesPublicar").find(':selected').val(),
          beforeSend: function(datos){
            $('#selectColoniasPublicar').append('<option value="" selected="selected">Cargando...</option>');
          },
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $("#selectColoniasPublicar").html(datos); 
          },
          type:"POST",
          timeout:10000,
        });
    //$("#selectColoniasPublicar").load('http://todoweb.in/gotcha/index/colonias_publicar_anuncio?idDelegacion='+idDelegacion);
  });

  //////////////////////////////////////////////////////////////////////////////////////////////////// 

  //evento tipo anunciante muestra-oculta input text empresa
  $("#tipo-anunciante").change(function(){
    alert($("#tipo-anunciante").find(':selected').val());
    // 1 - Particular
    // 2 - Agencia Inmobiliaria (activar campo de texto empresa)
    // 3 - Broker (activar campo de texto empresa)
    // 4 - Constructora (activar campo de texto empresa)
    if($("#tipo-anunciante").find(':selected').val()==2 || $("#tipo-anunciante").find(':selected').val()==3 || $("#tipo-anunciante").find(':selected').val()==4 ){
      $(".divOculto").show("slow");
    }else{
      $(".divOculto").hide("slow");
    }
  });

  //apertura popup para registro de anunciantes
  $('#open-registro').click(function(){
    $("#oscurecer").show("fast");
    $('#popup-registro').fadeIn('slow');
    $('.popup-overlay').fadeIn('slow');
    $('.popup-overlay').height($(window).height());
    return false;
  });
    
    $('#close').click(function(){
        $('#popup-registro').fadeOut('slow');
        $('.popup-overlay').fadeOut('slow');
        return false;
    });

    //apertura popup para login de usuarios
  $('#open-login').click(function(){
        $('#popup-login').fadeIn('slow');
        $('.popup-overlay').fadeIn('slow');
        $('.popup-overlay').height($(window).height());
        return false;
    });
    
    $('#close-login').click(function(){
        $('#popup-login').fadeOut('slow');
        $('.popup-overlay').fadeOut('slow');
        return false;
    });

     //apertura popup avatar
  $('#open-avatar').click(function(){
        $('#popup-avatar').fadeIn('slow');
        $('.popup-overlay').fadeIn('slow');
        $('.popup-overlay').height($(window).height());
        return false;
    });
    
    $('#close-avatar').click(function(){
        $('#popup-avatar').fadeOut('slow');
        $('.popup-overlay').fadeOut('slow');
        return false;
    });

    //apertura popup cerrar sesion usuario
  $('#cerrar-sesion').click(function(){
        $('#popup-cerrar-sesion').fadeIn('slow');
        $('.popup-overlay').fadeIn('slow');
        $('.popup-overlay').height($(window).height());
        return false;
    });
    
    $('#close-cerrar-sesion').click(function(){
        $('#popup-cerrar-sesion').fadeOut('slow');
        $('.popup-overlay').fadeOut('slow');
        return false;
    });

    $('#boton-cancela').click(function(){
        $('#popup-cerrar-sesion').fadeOut('slow');
        $('.popup-overlay').fadeOut('slow');
        return false;
    });


    //muestra-oculta formulario recuperar password
    $('#botonPassword').click(function(event){

      event.preventDefault();
      

      //ocultamos el div de login
      $("#divLogin").toggle("slow");
      //luego mostramos el div de recuperar password
      $("#divRecuperaPassword").toggle("slow");

    });

     //muestra-oculta formulario login
     $('#botonLogin').click(function(event){

      event.preventDefault();
      

      //ocultamos el div de Recuperar Password
      $("#divRecuperaPassword").toggle("slow");
      //luego mostramos el div de Login
      $("#divLogin").toggle("slow");

    });

    //oculto estacionamientos, baños, antiguedad y metros totales en la parte de filtros
    $("#ulAutos").hide("fast");
    $("#ulBanos").hide("fast");
    $("#ulAntiguedad").hide("fast");
    $("#ulMetros").hide("fast");



    $("#selectBuscar").change(function(){

      if($("#selectBuscar").find(':selected').val()=="Nombre" ){
         $("#busquedaNombre").show("slow");
         $("#busquedaPropiedad").hide("slow");
         $("#busquedaNombrePropiedad").hide("slow");
         $("#busquedaFecha").hide("slow");
         $("#busquedaFechaSolicitud").hide("slow");
         $("#busquedaFechaPago").hide("slow");
         $("#busquedaIdPropiedad").hide("slow");
         $("#busquedaEstado").hide("slow");
         $("#busquedaAnunciante").hide("slow");
         $("#busquedaSolicitante").hide("slow");
         $("#busquedaTitulo").hide("slow");
         $("#busquedaDelegacion").hide("slow");
         $("#busquedaColonia").hide("slow");
      }else
          if($("#selectBuscar").find(':selected').val()=="Anunciante" ) {
           $("#busquedaAnunciante").show("slow");
           $("#busquedaPropiedad").hide("slow");
           $("#busquedaFecha").hide("slow");
           $("#busquedaNombre").hide("slow");
           $("#busquedaSolicitante").hide("slow");
      }else
          if($("#selectBuscar").find(':selected').val()=="Solicitante" ) {
           $("#busquedaSolicitante").show("slow");
           $("#busquedaIdPropiedad").hide("slow");
           $("#busquedaFechaSolicitud").hide("slow");
           $("#busquedaFechaPago").hide("slow");
           $("#busquedaNombre").hide("slow");
      }else
          if($("#selectBuscar").find(':selected').val()=="Estado" ) {
           $("#busquedaEstado").show("slow");
           $("#busquedaPropiedad").hide("slow");
           $("#busquedaFecha").hide("slow");
           $("#busquedaFechaSolicitud").hide("slow");
           $("#busquedaFechaPago").hide("slow");
           $("#busquedaIdPropiedad").hide("slow");
            $("#busquedaTitulo").hide("slow");
            $("#busquedaNombre").hide("slow");
            $("#busquedaDelegacion").hide("slow");
            $("#busquedaColonia").hide("slow");
      }else
          if($("#selectBuscar").find(':selected').val()=="Propiedad" ){
             $("#busquedaPropiedad").show("slow");
             $("#busquedaNombre").hide("slow");
             $("#busquedaNombrePropiedad").hide("slow");
             $("#busquedaFecha").hide("slow");
             $("#busquedaFechaSolicitud").hide("slow");
             $("#busquedaFechaPago").hide("slow");
             $("#busquedaIdPropiedad").hide("slow");
             $("#busquedaEstado").hide("slow");
             $("#busquedaDelegacion").hide("slow");
             $("#busquedaColonia").hide("slow");
             $("#busquedaAnunciante").hide("slow");
             $("#busquedaTitulo").hide("slow");
      }else
          if($("#selectBuscar").find(':selected').val()=="NombrePropiedad"){
             $("#busquedaNombrePropiedad").show("slow");
             $("#busquedaPropiedad").hide("slow");
             $("#busquedaNombre").hide("slow");
             $("#busquedaFecha").hide("slow");           
      }
      else
          if($("#selectBuscar").find(':selected').val()=="Fecha" ){
            $("#busquedaFecha").show("slow");
             $("#busquedaNombre").hide("slow");
             $("#busquedaPropiedad").hide("slow");
             $("#busquedaNombrePropiedad").hide("slow");
             $("#busquedaFechaSolicitud").hide("slow");
             $("#busquedaFechaPago").hide("slow");
             $("#busquedaIdPropiedad").hide("slow");
             $("#busquedaEstado").hide("slow");
             $("#busquedaDelegacion").hide("slow");
             $("#busquedaAnunciante").hide("slow");
             $("#busquedaTitulo").hide("slow");
             $("#busquedaColonia").hide("slow");
      }else
          if($("#selectBuscar").find(':selected').val()=="FechaSolicitud" ){
             $("#busquedaFechaSolicitud").show("slow");
             $("#busquedaNombre").hide("slow");
             $("#busquedaPropiedad").hide("slow");
             $("#busquedaFecha").hide("slow");
             $("#busquedaFechaPago").hide("slow");
             $("#busquedaIdPropiedad").hide("slow");
             $("#busquedaSolicitante").hide("slow");
      }else
          if($("#selectBuscar").find(':selected').val()=="FechaPago" ){
             $("#busquedaFechaPago").show("slow");
             $("#busquedaNombre").hide("slow");
             $("#busquedaPropiedad").hide("slow");
             $("#busquedaFecha").hide("slow");
             $("#busquedaFechaSolicitud").hide("slow");
             $("#busquedaIdPropiedad").hide("slow");
             $("#busquedaSolicitante").hide("slow");
      }else
          if($("#selectBuscar").find(':selected').val()=="IdPropiedad" ){
             $("#busquedaIdPropiedad").show("slow");
             $("#busquedaNombre").hide("slow");
             $("#busquedaPropiedad").hide("slow");
             $("#busquedaFecha").hide("slow");
             $("#busquedaFechaSolicitud").hide("slow");
             $("#busquedaFechaPago").hide("slow");
             $("#busquedaSolicitante").hide("slow");
      }else
          if($("#selectBuscar").find(':selected').val()=="Titulo"){
            $("#busquedaTitulo").show("slow");
            $("#busquedaNombre").hide("slow");
            $("#busquedaPropiedad").hide("slow");
            $("#busquedaFecha").hide("slow");
            $("#busquedaEstado").hide("slow");
            $("#busquedaDelegacion").hide("slow");
            $("#busquedaColonia").hide("slow");
      }else
          if($("#selectBuscar").find(':selected').val()=="Delegacion"){
            $("#busquedaDelegacion").show("slow");
            $("#busquedaEstado").hide("slow");
            $("#busquedaTitulo").hide("slow");
            $("#busquedaNombre").hide("slow");
            $("#busquedaPropiedad").hide("slow");
            $("#busquedaFecha").hide("slow");
            $("#busquedaColonia").hide("slow");
      }else
          if($("#selectBuscar").find(':selected').val()=="Colonia"){
            $("#busquedaColonia").show("slow");
            $("#busquedaEstado").hide("slow");
            $("#busquedaTitulo").hide("slow");
            $("#busquedaNombre").hide("slow");
            $("#busquedaPropiedad").hide("slow");
            $("#busquedaFecha").hide("slow");
            $("#busquedaDelegacion").hide("slow");
      }

  });

  $("#submitAvatar").click(function(){
    $("#divUploadAvatar").show("fast");
  });

   $("#submitUploadFotos").click(function(){
    $("#divUploadFotos").show("fast");
  });

   //para ingresar con enter en el login de anunciantes
   $("#u-pass").bind('keypress', function(event){
      if (event.keyCode == '13'){
         login('http://todoweb.in/gotcha/login');
      }
   });  


   $("#selectFormaPago").change(function(){
      //valores desde la tabla de base de datos
      //Paypal = 1
      //Scotia Bank = 2
      if($("#selectFormaPago").find(':selected').val()==2){
        $("#divFormaPagoScotiaBank").show("fast");
        $("#divFormaPagoPaypal").hide("fast");
        //pasamos el metodo de pago al input hidden para guardar la orden de compra
        $("#metodo_de_pago").val("2");
      }else
          if($("#selectFormaPago").find(':selected').val()==1){
            $("#divFormaPagoPaypal").show("fast");
            $("#divFormaPagoScotiaBank").hide("fast");
      }
   })
  

});//end carga de load jquery




function buscar(){
  
    //realizo las validaciones correspondientes
  
    if( $("#selectEstados").val()=="" ){
         $(".error").fadeIn("slow");
        $(".error").html("Upss, Selecciona una Ciudad ó Estado");
        $("#selectEstados").focus();
        close_alert_box('.error');
        return false;
    }else
      if( $("#selectDelegaciones").val()=="" ){
         $(".error").fadeIn("slow");
        $(".error").html("Upss, Selecciona una Delegación ó Municipio");
        $("#selectDelegaciones").focus();
        close_alert_box('.error');
        return false;
    }
    //si todo fue bien entonces mandamos los parametros de busqueda por ajax a los modelos
    
    
    var url="http://todoweb.in/gotcha/index/busquedas?";
    var data="estados="+document.getElementById('selectEstados').value+"&delegaciones="+document.getElementById('selectDelegaciones').value+"&colonias="+document.getElementById('selectColonias').value;
  
    window.location=url+data;
}



function close_alert_box(clase){
  $(clase).delay(4000)
  $(clase).fadeOut('slow'); 
}

  //apertura popup para registro desde una funcion
  function open_registro(){
    $("#oscurecer").show("fast");
    $('#popup-registro').fadeIn('slow');
    $('.popup-overlay').fadeIn('slow');
    $('.popup-overlay').height($(window).height());
  }

function cambia_foto_grande(ruta){
    $("#fotoActual").attr("src",ruta);
    //$("#"+id).addClass("ultimos_trabajos_images_tumbs_hover");

    /*
    for(i = 0;  i < $("#article_fotos_tumbs img").length;  i ++ ){
      if(id != "foto_tumb_"+i ){
        $("#foto_tumb_"+i).removeClass("ultimos_trabajos_images_tumbs_hover");
        $("#foto_tumb_"+i).addClass("ultimos_trabajos_images_tumbs");
        
      }
    }
    */
}

function registro(ruta){
  $('#divResultAjax').fadeIn('slow');
  //valido si el checkbox de boletin esta checked
  var boletin;
  if($("#checkBoletinAnunciante").is(':checked')) {  
    boletin=true;
  }else{
    boletin=false;
  }
   $.ajax({
          url:ruta,
          async:true,
          beforeSend: function(datos){
            $("#divResultAjax").html("Procesando...");
          },
          data:"nombre="+$("#nombre").val()+"&apellidos="+$("#apellidos").val()+"&correo="+$("#correo").val()+"&telefono="+$("#telefono").val()+"&celular="+$("#celular").val()+"&pass="+$("#pass").val()+"&c-pass="+$("#c-pass").val()+"&comboAnunciante="+$("#comboAnunciante").find(':selected').val()+"&comboEstado="+$("#comboEstado").find(':selected').val()+"&empresa="+$("#empresa").val()+"&boletin="+boletin,
          dataType:"html",
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $("#divResultAjax").html(datos);
            if(datos=="Se agrego el anunciante correctamente"){
              $("#divResultAjax").removeClass("ajaxFail").addClass("ajaxSucess");
              $('#formuAnunciante').each (function(){
                this.reset();
              });
            }else{
              $("#divResultAjax").removeClass("ajaxSucess").addClass("ajaxFail");
            }
            if(datos=="Tu registro fue exitoso ya puedes ingresar a Interhabita"){
              $("#divResultAjax").removeClass("ajaxFail").addClass("ajaxSucess");
              $('#formuRegistro').each (function(){
                this.reset();
              });
            }
          },
          type:"POST",
          timeout:10000,
        });
    
    close_alert_box('#divResultAjax');

}

function login(ruta){
  $('#divResultAjaxLogin').fadeIn('slow');
   $.ajax({
          url:ruta,
          async:true,
          beforeSend: function(datos){
            $("#divResultAjaxLogin").html("Validando...");
          },
          data:"login="+$("#u-login").val()+"&pass="+$("#u-pass").val(),
          dataType:"html",
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $("#divResultAjaxLogin").html(datos); 
            if(datos=="Success"){
              window.location='http://todoweb.in/gotcha/miperfil';
              $("#popup-login").hide("slow");
            }else{
              $("#divResultAjaxLogin").addClass("ajaxFail");
            }      
          },
          type:"POST",
          timeout:10000,
        });

   close_alert_box('#divResultAjaxLogin');

}

function update_user(ruta){
  $('#divResultAjaxUser').fadeIn("slow");
   $.ajax({
          url:ruta,
          async:true,
          beforeSend: function(datos){
            $("#divResultAjaxUser").html("Procesando...");
          },
          data:"nombre="+$("#u-nombre").val()+"&apellidos="+$("#u-apellidos").val()+"&correo="+$("#u-correo").val()+"&telefono="+$("#u-telefono").val()+"&celular="+$("#u-celular").val()+"&empresa="+$("#u-empresa").val()+"&inmobiliaria="+$("#u-inmobiliaria").val()+"&direccionEmpresa="+$("#u-empresa-direccion").val()+"&estado="+$("#u-selectEstados").find(':selected').val(),
          dataType:"html",
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron 
            if(datos=="Tus datos se actualizaron correctamente"){
              $('#divResultAjaxUser').removeClass("ajaxFail").addClass("ajaxSucess");
            }else{
              $('#divResultAjaxUser').removeClass("ajaxSucess").addClass("ajaxFail");
            }
            $("#divResultAjaxUser").html(datos); 
          },
          type:"POST",
          timeout:10000,
        });

   close_alert_box('#divResultAjaxUser');
}

function update_user_pass(ruta){
  $('#divResultAjaxUserPass').fadeIn("slow");
   $.ajax({
          url:ruta,
          async:true,
          beforeSend: function(datos){
            $("#divResultAjaxUserPass").html("Procesando...");
          },
          data:"passActual="+$("#passActual").val()+"&passNuevo="+$("#passNuevo").val()+"&passNuevoConfirm="+$("#passNuevoConfirm").val(),
          dataType:"html",
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $("#divResultAjaxUserPass").html(datos); 
            if(datos=="Ingresa los datos que se te piden"){
              $('#divResultAjaxUserPass').removeClass("ajaxSucess").addClass("ajaxFail");
            }
            if(datos=="La Contrasñea se actualizo correctamente"){
              $('#divResultAjaxUserPass').removeClass("ajaxFail").addClass("ajaxSucess");
              $('#formuPassword').each (function(){
              this.reset();
            });
            }
          },
          type:"POST",
          timeout:10000,
        });
   close_alert_box('#divResultAjaxUserPass');
}

function publicar_anuncio(ruta){
     $("#divResultAjaxAnunciar").show("fast");
     $("#divResultAjaxAnunciar").removeClass('ajaxFail').addClass('ajaxSucess');
     $.ajax({
            url:ruta,
            async:true,
            beforeSend: function(datos){
              $("#divResultAjaxAnunciar").html("Procesando...");
            },
            data:"title="+$("#title").val()+"&precio="+$("#precio").val()+"&selectOperacion="+$("#selectOperacion").find(':selected').val()+"&selectTipoPropiedad="+$("#selectTipoPropiedad").find(':selected').val()+"&terreno="+$("#terreno").val()+"&construido="+$("#construido").val()+"&antiguedad="+$("#antiguedad").val()+"&recamaras="+$("#recamaras").val()+"&banos="+$("#banos").val()+"&autos="+$("#autos").val()+"&description="+$("#description").val()+"&selectEstados="+$("#selectEstadosPublicar").find(':selected').val()+"&selectDelegaciones="+$("#selectDelegacionesPublicar").find(':selected').val()+"&selectColonias="+$("#selectColoniasPublicar").find(':selected').val()+"&direccion="+$("#direccion").val(),
            contentType:"application/x-www-form-urlencoded",
            error:function(){
                alert("ha ocurrido un error");
            },
            ifModified:false,
            processData:true,
            success:function(datos){//recibe los datos que fueron llamados
              if(datos!=""){
                $("#divResultAjaxAnunciar").removeClass('ajaxSucess').addClass('ajaxFail');
              }
              $("#divResultAjaxAnunciar").html(datos);
            },
            type:"POST",
            timeout:10000,
          });

   var focalizar = $("div#divContentPanel").position().top;
   $('html,body').animate({scrollTop: focalizar}, 1000);
   close_alert_box('#divResultAjaxAnunciar');
  
  
}

function valida_form_anunciar(){
  if($("#title").val()==""){
    $("#divResultAjaxAnunciar").show("slow");
    $("#divResultAjaxAnunciar").html("Ingresa el Titulo de tu Anuncio");  
    var focalizar = $("div#divContentPanel").position().top;
    $('html,body').animate({scrollTop: focalizar}, 1000);
    return false;
  }
}



function contacto(ruta){
   $("#divAjaxContacto").fadeIn("slow");
   $.ajax({
          url:ruta,
          async:true,
          beforeSend: function(datos){
            $("#divAjaxContacto").html("Procesando...");
          },
          data:"nombre="+$("#c-nombre").val()+"&correo="+$("#c-correo").val()+"&telefono="+$("#c-telefono").val()+"&mensaje="+$("#c-mensaje").val()+"&mensaje_original="+$("#c-mensaje-vacio").val()+"&id_propiedad="+$("#c-id_propiedad").val(),
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            if(datos=="Gracias por tu mensaje pronto recibiras respuesta"){
              $("#divAjaxContacto").removeClass("ajaxFail").addClass("ajaxSucess");
               $('#formContacto').each (function(){
                  this.reset();
               });
            }else{
              $("#divAjaxContacto").removeClass("ajaxSucess").addClass("ajaxFail");
            }
            $("#divAjaxContacto").html(datos);
          },
          type:"POST",
          timeout:10000,
        });
    
    close_alert_box('#divAjaxContacto');
    
}

function envia_contacto_logeado(ruta){
   $.ajax({
          url:ruta,
          async:true,
          beforeSend: function(datos){
            $("#divAjaxContacto").html("Procesando...");
          },
          data:"id_propiedad="+$("#c-id_propiedad").val()+"&mensaje="+$("#c-mensaje").val(),
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $("#divAjaxContacto").html(datos); 
          },
          type:"POST",
          timeout:10000,
        });
}

function imagen_principal(ruta){
  //funcion para establecer la imagen principal de las fotos de propiedades

        $.ajax({
          url:ruta,
          async:true,
          beforeSend: function(datos){
            $("#divResultAjaxFotos").html("Procesando <img src='http://todoweb.in/gotcha/public/images/loading-barra.gif'>");
          },
          data:"idFotoPrincipal="+$('input:radio[name=imgPrincipal]:checked').val()+"&idPropiedad="+$("#lastInsertId").val(),
          dataType:"html",
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $("#divResultAjaxFotos").html(datos); 
          },
          type:"POST",
          timeout:10000,
        });
}


function actualiza_anuncio(ruta){
  
  $('#divResultAjaxActualizaAnuncio').show("slow");
   $.ajax({
          url:ruta,
          async:true,
          beforeSend: function(datos){
            $("#divResultAjaxActualizaAnuncio").html("Procesando...");
          },
          data:"titulo="+$("#title").val()+"&precio="+$("#precio").val()+"&operacion="+$("#selectOperacion").find(':selected').val()+"&selectTipoPropiedad="+$("#selectTipoPropiedad").find(':selected').val()+"&terreno="+$("#terreno").val()+"&construido="+$("#construido").val()+"&antiguedad="+$("#antiguedad").val()+"&recamaras="+$("#recamaras").val()+"&banos="+$("#banos").val()+"&autos="+$("#autos").val()+"&description="+$("#description").val()+"&selectEstados="+$("#selectEstadosPublicar").find(':selected').val()+"&selectDelegaciones="+$("#selectDelegacionesPublicar").find(':selected').val()+"&selectColonias="+$("#selectColoniasPublicar").find(':selected').val()+"&direccion="+$("#direccion").val()+"&id_propiedad="+$("#idPropiedad").val(),
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            if(datos=="Se Actualizaron los Datos de la Propiedad Correctamente!!!"){
              $('#divResultAjaxActualizaAnuncio').removeClass("ajaxFail").addClass("ajaxSucess");
              $("#divResultAjaxActualizaAnuncio").html(datos);
            }else{
              $('#divResultAjaxActualizaAnuncio').removeClass("ajaxSucess").addClass("ajaxFail");
              $("#divResultAjaxActualizaAnuncio").html(datos);
            }
          },
          type:"POST",
          timeout:10000,
        });

   var focalizar = $("div#divContentPanel").position().top;
   $('html,body').animate({scrollTop: focalizar}, 1000);

   close_alert_box('#divResultAjaxActualizaAnuncio');

}


function recupera_password(ruta){
  
   $("#divResultAjaxPassword").show("slow");
   $.ajax({
          url:ruta,
          async:true,
          beforeSend: function(datos){
            $("#divResultAjaxPassword").html("Procesando...");
          },
          data:"correoUsuario="+$("#correoUsuario").val(),
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            if(datos=="Ingresa a tu Cuenta de Correo para Restablecer tu Password"){
              $("#divResultAjaxPassword").removeClass("ajaxFail").addClass("ajaxSucess");
            }else{
              $("#divResultAjaxPassword").removeClass("ajaxSucess").addClass("ajaxFail");
            }
            $("#divResultAjaxPassword").html(datos);
          },
          type:"POST",
          timeout:10000,
        });

   $('#formPassword').each (function(){
      this.reset();
   });

   close_alert_box('#divResultAjaxPassword');

}

function actualiza_password(ruta){
  
   $("#divAjaxRestablecerPassword").show("slow");
   $.ajax({
          url:ruta,
          async:true,
          beforeSend: function(datos){
            $("#divAjaxRestablecerPassword").html("Procesando...");
          },
          data:"passNuevo="+$("#passNuevo").val()+"&passNuevoConfirm="+$("#passNuevoConfirm").val()+"&sha1IdUsuario="+$("#sha1IdUsuario").val()+"&sha1Correo="+$("#sha1Correo").val(),
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $("#divAjaxRestablecerPassword").html(datos);
            if(datos=="Success"){
              $("#divRestablecerPassword").hide("slow");
              $("#divSuccess").show("slow");
            }
          },
          type:"POST",
          timeout:10000,
        });

}

function add_favorito(ruta, idPropiedad, idUser){
  
   $.ajax({
          url:ruta,
          async:true,
          data:"id_propiedad="+idPropiedad+"&id_usuario="+idUser,
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          type:"POST",
          timeout:10000,
        });

}

function ajax_propiedades(ruta, campoValor, pag, opcion){

  if(opcion=="anunciante"){
    var data="pag="+pag+"&anunciante="+campoValor;
  }else
    if(opcion=="propiedad"){
     var data="pag="+pag+"&propiedad="+campoValor;
  }else
    if(opcion=="id_propiedad"){
     var data="pag="+pag+"&id_propiedad="+campoValor;
  }else
    if(opcion=="titulo"){
     var data="pag="+pag+"&titulo="+campoValor;
  }else
    if(opcion=="estado"){
     var data="pag="+pag+"&estado="+campoValor;
  }else
    if(opcion=="delegacion"){
     var data="pag="+pag+"&delegacion="+campoValor;
  }else
    if(opcion=="colonia"){
     var data="pag="+pag+"&colonia="+campoValor;
  }
  $.ajax({
         url:ruta,
          async:true,
          data:data,
          beforeSend: function(datos){
            $("#divResultAjaxPropiedades").html("<img src='http://todoweb.in/gotcha/public/images/icono-loading.gif'> Cargando...");
          },
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $("#divResultAjaxPropiedades").html(datos);
          },
          timeout:10000,
          type:"POST",
        });

}

function ajax_propiedades_fechas(ruta, pag, fechaDe, fechaA){

  $.ajax({
         url:ruta,
          async:true,
          data:"pag="+pag+"&fechaA="+fechaA+"&fechaDe="+fechaDe,
          beforeSend: function(datos){
            $("#divResultAjaxPropiedades").html("<img src='http://todoweb.in/gotcha/public/images/icono-loading.gif'> Cargando...");
          },
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $("#divResultAjaxPropiedades").html(datos);
          },
          timeout:10000,
          type:"POST",
        });

}


function ajax_interesados(ruta, campoValor, pag, opcion){

  if(opcion=="nombre"){
    var data="pag="+pag+"&nombre="+campoValor;
  }else
    if(opcion=="propiedad"){
     var data="pag="+pag+"&propiedad="+campoValor;
  }else
    if(opcion=="id_propiedad"){
     var data="pag="+pag+"&id_propiedad="+campoValor;
  }
  $.ajax({
         url:ruta,
          async:true,
          data:data,
          beforeSend: function(datos){
            $("#divResultAjaxInteresados").html("<img src='http://todoweb.in/gotcha/public/images/icono-loading.gif'> Cargando...");
          },
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $("#divResultAjaxInteresados").html(datos);
          },
          timeout:10000,
          type:"POST",
        });

}



function ajax_interesados_fecha(ruta, fechaDe, fechaA, pag){

  $.ajax({
         url:ruta,
          async:true,
          data:"fechaDe="+fechaDe+"&fechaA="+fechaA+"&pag="+pag,
          beforeSend: function(datos){
            $("#divResultAjaxInteresados").html("<img src='http://todoweb.in/gotcha/public/images/icono-loading.gif'> Cargando...");
          },
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $("#divResultAjaxInteresados").html(datos);
          },
          timeout:10000,
          type:"POST",
        });

}

function ajax_anunciantes(ruta, pag, anunciante){
  $.ajax({
         url:ruta,
          async:true,
          data:"pag="+pag+"&nombre="+anunciante,
          beforeSend: function(datos){
            $("#divResultAjaxAnunciantes").html("<img src='http://todoweb.in/gotcha/public/images/icono-loading.gif'> Cargando...");
          },
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $("#divResultAjaxAnunciantes").html(datos);
          },
          timeout:10000,
          type:"POST",
        });
  $("#divLoading").html("");

}

function ajax_anunciantes_fecha(ruta, pag, fechaDe, fechaA){
  $.ajax({
         url:ruta,
          async:true,
          data:"pag="+pag+"&fechaDe="+fechaDe+"&fechaA="+fechaA,
          beforeSend: function(datos){
            $("#divResultAjaxAnunciantes").html("<img src='http://todoweb.in/gotcha/public/images/icono-loading.gif'> Cargando...");
          },
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $("#divResultAjaxAnunciantes").html(datos);
          },
          timeout:10000,
          type:"POST",
        });

}

function ajax_anunciantes_estado(ruta, pag, estado){
  $.ajax({
         url:ruta,
          async:true,
          data:"pag="+pag+"&estado="+estado,
          beforeSend: function(datos){
            $("#divResultAjaxAnunciantes").html("<img src='http://todoweb.in/gotcha/public/images/icono-loading.gif'> Cargando...");
          },
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $("#divResultAjaxAnunciantes").html(datos);
          },
          timeout:10000,
          type:"POST",
        });

}


function filtros_interesados(ruta){
   $.ajax({
         url:ruta,
          async:true,
          beforeSend: function(datos){
            $("#divResultAjaxInteresados").html("<img src='http://todoweb.in/gotcha/public/images/icono-loading.gif'> Cargando...");
          },
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $("#divResultAjaxInteresados").html(datos);
          },
          timeout:10000,
        });
}

function busquedas_backend(ruta, opcion){

  var data="";
  var div="";

  switch(opcion){
    case "nombreAnunciante":
      data="nombre="+$("#nombreAnunciante").val();
      div="#divResultAjaxAnunciantes";
    break
    case "fechaAnunciante":
      data="fechaDe="+$("#fechaAnuncianteDe").val()+"&fechaA="+$("#fechaAnuncianteA").val();
      div="#divResultAjaxAnunciantes";
    break
    case "estadoAnunciante":
      data="estado="+$("#estadoAnunciante").val();
      div="#divResultAjaxAnunciantes";
    break
    case "nombreInteresado":
      data="nombre="+$("#nombreInteresado").val();
      div="#divResultAjaxInteresados";
    break
    case "nombreAnuncianteDeposito":
      data="nombre="+$("#nombreAnuncianteDeposito").val();
      div="#divResultAjaxInteresados";
    break
    case "propiedadInteresado":
      data="propiedad="+$("#propiedad").val();
      div="#divResultAjaxInteresados";
    break 
    case "IdPropiedadInteresado":
      data="id_propiedad="+$("#id_propiedad").val();
      div="#divResultAjaxInteresados";
    break 
    case "fechaInteresado":
      data="fechaDe="+$("#fechaInteresadosDe").val()+"&fechaA="+$("#fechaInteresadosA").val();
      div="#divResultAjaxInteresados";
    break
    case "paypalNombreAnunciante":
      data="anunciante="+$("#nombreAnunciante").val()+"&statusPago="+$("input[name=statusPago]:checked").val();
      div="#divResultAjaxReportePaypal";
    break
    case "paypalNombreSolicitante":
      data="solicitante="+$("#nombreSolicitante").val()+"&statusPago="+$("input[name=statusPago]:checked").val();
      div="#divResultAjaxReportePaypal";
    break
    case "paypalFechaSolicitud":
      data="fechaDe="+$("#fechaSolicitudDe").val()+"&fechaA="+$("#fechaSolicitudA").val()+"&fechaComparar=fecha_registro&statusPago="+$("input[name=statusPago]:checked").val();
      div="#divResultAjaxReportePaypal";
    break
    case "paypalFechaPago":
      data="fechaDe="+$("#fechaPagoDe").val()+"&fechaA="+$("#fechaPagoA").val()+"&fechaComparar=fecha_pago_paypal&statusPago="+$("input[name=statusPago]:checked").val();
      div="#divResultAjaxReportePaypal";
    break
    case "paypalIdPropiedad":
      data="idPropiedad="+$("#idPropiedad").val()+"&statusPago="+$("input[name=statusPago]:checked").val();
      div="#divResultAjaxReportePaypal";
    break
    case "idOrdenNumero":
      data="idOrdenCompra="+$("#idOrdenNumero").val();
      div="#divResultAjaxOrden";
    break
    case "nombreAnuncianteOrden":
      data="anunciante="+$("#nombreAnuncianteOrden").val();
      div="#divResultAjaxOrden";
    break
    case "fechaOrden":
      data="fechaDe="+$("#fechaOrdenDe").val()+"&fechaA="+$("#fechaOrdenA").val();
      div="#divResultAjaxOrden";
    break
    case "idPropiedad":
      data="id_propiedad="+$("#id_propiedad").val();
      div="#divResultAjaxPropiedades";
    break
    case "nombreAnuncianteP":
      data="anunciante="+$("#nombreAnunciante").val();
      div="#divResultAjaxPropiedades";
    break
    case "tituloPropiedad":
      data="titulo="+$("#tpropiedad").val();
      div="#divResultAjaxPropiedades";
    break 
    case "estadoPropiedad":
      data="estado="+$("#estado").val();
      div="#divResultAjaxPropiedades";
    break 
    case "delegacionPropiedad":
      data="delegacion="+$("#delegacion").val();
      div="#divResultAjaxPropiedades";
    break 
    case "coloniaPropiedad":
      data="colonia="+$("#colonia").val();
      div="#divResultAjaxPropiedades";
    break 
    case "fechaPropiedad":
      data="fechaDe="+$("#fechaPropiedadesDe").val()+"&fechaA="+$("#fechaPropiedadesA").val();
      div="#divResultAjaxPropiedades";
    break 
  }
 
  $.ajax({
          url:ruta,
          async:true,
          data:data,
          beforeSend: function(datos){
            $(div).html("<img src='http://todoweb.in/gotcha/public/images/icono-loading.gif'> Cargando...");
          },
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $(div).html(datos);
          },
          type:"POST",
          timeout:10000,
        });
}

function editar_costo_transaccion(ruta){

  $.ajax({
          url:ruta,
          async:true,
          beforeSend: function(datos){
            $("#divResultAjaxCostoTransaccionPaypal").html("<img src='http://todoweb.in/gotcha/public/images/icono-loading.gif'> Cargando...");
          },
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $("#divResultAjaxCostoTransaccionPaypal").html(datos);
          },
          timeout:10000,
        });

}

function actualiza_costo_transaccion(ruta){
  $('#divAjaxEditaCostoTransaccion').show('slow');
  $.ajax({
          url:ruta,
          async:true,
          data:"costo="+$("#costo").val()+"&idTipoPropiedad="+$("#idTipoPropiedad").val(),
          beforeSend: function(datos){
            $("#divAjaxEditaCostoTransaccion").html("<img src='http://todoweb.in/gotcha/public/images/loading-barra.gif'>");
          },
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            if(datos=="Ingresa el Costo de la Transacción"){
              $("#divAjaxEditaCostoTransaccion").removeClass("ajaxSucess").addClass("ajaxFail");
            }else
              if(datos=="Se actualizo el Costo de Transacción Correctamente"){
                $("#divAjaxEditaCostoTransaccion").removeClass("ajaxFail").addClass("ajaxSucess");
            }
            $("#divAjaxEditaCostoTransaccion").html(datos);
          },
          type:"POST",
          timeout:10000,
        });

   close_alert_box('#divAjaxEditaCostoTransaccion');
  
}

function solicitantes_paginacion_ajax(ruta, pag, div){

  $.ajax({
          url:ruta,
          async:true,
          data:"pag="+pag,
          beforeSend: function(datos){
            $("#divSolicitantes").html("<img src='http://todoweb.in/gotcha/public/images/icono-loading.gif'> Cargando...");
          },
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $("#divSolicitantes").html(datos);
          },
          type:"POST",
          timeout:10000,
        });

  
}


function paypal_paginacion_ajax(ruta, anunciante_o_id_propiedad, statusPago, pag){

  $.ajax({
          url:ruta,
          async:true,
          data:"anunciante="+anunciante_o_id_propiedad+"&statusPago="+statusPago+"&pag="+pag+"&idPropiedad="+anunciante_o_id_propiedad,
          beforeSend: function(datos){
            $("#divResultAjaxReportePaypal").html("<img src='http://todoweb.in/gotcha/public/images/icono-loading.gif'> Cargando...");
          },
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $("#divResultAjaxReportePaypal").html(datos);
          },
          type:"POST",
          timeout:10000,
        });
  
}

function paypal_paginacion_ajax_solicitante(ruta, solicitante, statusPago, pag){

  $.ajax({
          url:ruta,
          async:true,
          data:"solicitante="+solicitante+"&statusPago="+statusPago+"&pag="+pag,
          beforeSend: function(datos){
            $("#divResultAjaxReportePaypal").html("<img src='http://todoweb.in/gotcha/public/images/icono-loading.gif'> Cargando...");
          },
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $("#divResultAjaxReportePaypal").html(datos);
          },
          type:"POST",
          timeout:10000,
        });
  
}

function paypal_paginacion_ajax_fecha(ruta, fechaDe, fechaA, fechaComparar, statusPago, pag){

  $.ajax({
          url:ruta,
          async:true,
          data:"fechaDe="+fechaDe+"&fechaA="+fechaA+"&statusPago="+statusPago+"&fechaComparar="+fechaComparar+"&pag="+pag,
          beforeSend: function(datos){
            $("#divResultAjaxReportePaypal").html("<img src='http://todoweb.in/gotcha/public/images/icono-loading.gif'> Cargando...");
          },
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $("#divResultAjaxReportePaypal").html(datos);
          },
          type:"POST",
          timeout:10000,
        });
  
}

function actualiza_password(ruta){
  
   $("#divAjaxRestablecerPassword").show("slow");
   $.ajax({
          url:ruta,
          async:true,
          beforeSend: function(datos){
            $("#divAjaxRestablecerPassword").html("Procesando...");
          },
          data:"passNuevo="+$("#passNuevo").val()+"&passNuevoConfirm="+$("#passNuevoConfirm").val()+"&sha1IdUsuario="+$("#sha1IdUsuario").val()+"&sha1Correo="+$("#sha1Correo").val(),
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $("#divAjaxRestablecerPassword").html(datos);
            if(datos=="Success"){
              $("#divRestablecerPassword").hide("slow");
              $("#divSuccess").show("slow");
            }
          },
          type:"POST",
          timeout:10000,
        });

}

function add_deposito(ruta, id){
  $.ajax({
          url:ruta,
          async:true,
          beforeSend: function(datos){
            $("#divResultAjaxPagoDeposito").html("Procesando...");
          },
          data:"fechaPagoDeposito="+$("#fechaPagoDeposito").val()+"&id="+id+"&idFormaPago="+$("#comboFichaDeposito").find(":selected").val(),
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            if(datos=="Debes de Ingresar un método de pago"){
              $("#divResultAjaxPagoDeposito").removeClass('ajaxSucess').addClass("ajaxFail");
            }else{
              $("#divResultAjaxPagoDeposito").removeClass('ajaxFail').addClass("ajaxSucess");
              $('#btnAddDeposito').attr("disabled", true);
              $('#fechaPagoDeposito').attr("disabled", true);
              $('#comboFichaDeposito').attr("disabled", true);
            }
            $("#divResultAjaxPagoDeposito").html(datos);
          },
          type:"POST",
          timeout:10000,
        });
}


//carrito de compra de clientes
function add_item_carrito(ruta, idCLiente, propiedad, costoTransaccion, cliente){

  $.ajax({
          url:ruta,
          async:true,
          beforeSend: function(datos){
            $("#divAjaxCarritoCompra").html("<img src='http://todoweb.in/gotcha/public/images/icono-loading.gif'>");
          },
          data:"idCLiente="+idCLiente+"&propiedad="+propiedad+"&costoTransaccion="+costoTransaccion+"&cliente="+cliente,
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $("#divAjaxCarritoCompra").html(datos);
          },
          type:"POST",
          timeout:10000,
        });

}

function delete_item_carrito(ruta, item){
  $.ajax({
          url:ruta,
          async:true,
          beforeSend: function(datos){
            $("#divAjaxCarritoCompra").html("<img src='http://todoweb.in/gotcha/public/images/icono-loading.gif'>");
          },
          data:"item="+item,
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $("#divAjaxCarritoCompra").html(datos);
          },
          type:"POST",
          timeout:10000,
        });
}

function contactanos(ruta){

  $("#divResultAjaxContacto").show("slow");
  $.ajax({
          url:ruta,
          async:true,
          beforeSend: function(datos){
            $("#divResultAjaxContacto").html("<img src='http://todoweb.in/gotcha/public/images/icono-loading.gif'>");
          },
          data:"nombre="+$("#nombreContact").val()+"&correo="+$("#emailContact").val()+"&comentario="+$("#commentContact").val(),
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            if(datos=="Gracias! Tu mensaje se envió Satisfactoriamente"){
              $("#divResultAjaxContacto").removeClass('ajaxFail').addClass('ajaxSucess');
            }else{
              $("#divResultAjaxContacto").removeClass('ajaxSucess').addClass('ajaxFail');
            }
            $("#divResultAjaxContacto").html(datos);
          },
          type:"POST",
          timeout:10000,
        });
     //limpio el form
    $('#formContact').each (function(){
        this.reset();
    });
    close_alert_box('#divResultAjaxContacto');

}

function paginacion_orden_compra(ruta, opcion, valor, pag){

  var data="";
  if(opcion=="anunciante"){
    datos="anunciante="+valor+"&pag="+pag;
  }else
      if (opcion=="idOrdenCompra") {
        datos="idOrdenCompra="+valor+"&pag="+pag;
  }

  $.ajax({
          url:ruta,
          async:true,
          data:datos,
          beforeSend: function(datos){
            $("#divResultAjaxOrden").html("<img src='http://todoweb.in/gotcha/public/images/icono-loading.gif'> Cargando...");
          },
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $("#divResultAjaxOrden").html(datos);
          },
          type:"POST",
          timeout:10000,
        });
  
}

function paginacion_orden_compra_fecha(ruta, fechaDe, fechaA, pag){

  $.ajax({
          url:ruta,
          async:true,
          data:"fechaDe="+fechaDe+"&fechaA="+fechaA+"&pag="+pag,
          beforeSend: function(datos){
            $("#divResultAjaxOrden").html("<img src='http://todoweb.in/gotcha/public/images/icono-loading.gif'> Cargando...");
          },
          contentType:"application/x-www-form-urlencoded",
          error:function(){
              alert("ha ocurrido un error");
          },
          ifModified:false,
          processData:true,
          success:function(datos){//recibe los datos que fueron llamados
            $("#divResultAjaxOrden").html(datos);
          },
          type:"POST",
          timeout:10000,
        });
  
}

function elimina_anunciante(url, idUser){
   if(confirm('Estas seguro de Eliminar este Anunciante y todas sus propiedades?')){
     window.location=url+"/"+idUser;
    }else{
      return false;
    }
}

function elimina_anuncio(url, idPropiedad){
   if(confirm('Estas seguro de Eliminar este Anuncio y a todos los solicitantes?')){
     window.location=url+"/"+idPropiedad;
    }else{
      return false;
    }
}


function confirmActivaPagoDeposito(url){

  if(confirm('Estas seguro de Activar este Pago?')){
     window.location=url;
  }else{
    return false;
  }
  
}

function redirect_orden_de_compra(url){

  //obtenemos el valor del id_metodo_de_pago
  window.location=url+"?id="+$("#metodo_de_pago").val();

}


function redirect(ruta){

  window.location=ruta;
  
}


function elimina_imagen_propiedad(ruta){

  if(confirm("Realmente Deseas Eliminar la Imagen?")){
    window.location=ruta;
  }

}


//funcion para validar el correo
function valida_correo(id, divResult){

    if($("#"+id).val().indexOf('@', 0) == -1 || $("#"+id).val().indexOf('.', 0) == -1) {
        $(divResult).show("slow");
        $(divResult).addClass('ajaxFail');
        $(divResult).html("El formato del correo es incorrecto, reintentar!!!");
        $("#"+id).focus();
        close_alert_box(divResult);
        return false;

    }
    
}

function cerrar_sesion(ruta){

  window.location=ruta;

}

function goBack() {
    history.back()
}

function solo_numeros(){
   if ((event.keyCode < 48) || (event.keyCode > 57) ) 
    event.returnValue = false;
}


function show_hide_filtro(ulId){

  $("#"+ulId).toggle("fast");

}

function filtro_precio(ruta){

  if($("#precioMin").val()!="" && $("#precioMax").val()!=""){
     window.location=ruta+"&precio="+$("#precioMin").val()+"-"+$("#precioMax").val();
  }

}

function cerrarAlert(clase){
  $(clase).hide("slow");
} 

/*
function recargarTextoHeaderAdmin(){    
     // Limita el contador a solo 5 elementos
    if (actualAdmin<=8) {
        actualAdmin=actualAdmin+1;
    } else {
        actualAdmin=1;
    }
     // Setea la variable que vamos a enviar a php
    var variable_post=actualAdmin;
    // Enviamos los valores a miscript.php
    $.post("http://todoweb.in/gotcha/index/texto_cambiante_admin", { variable: variable_post }, function(data){ 
        // Actualizamos el div divTextoRecargar
        $("#divTextoRecargarAnunciantes").fadeIn("slow").html(data);
    });         
}

function recargarTextoHeader(){    
     // Limita el contador a solo 5 elementos
    if (actual<=5) {
        actual=actual+1;
    } else {
        actual=1;
    }
     // Setea la variable que vamos a enviar a php
    var variable_post=actual;
    // Enviamos los valores a miscript.php
    $.post("http://todoweb.in/gotcha/index/texto_cambiante", { variable: variable_post }, function(data){ 
        // Actualizamos el div divTextoRecargar
        $("#divTextoRecargar").fadeIn("slow").html(data);
    });         
}

actual=0;
actualAdmin=0;
timer = setInterval("recargarTextoHeader()", 4000);
timer = setInterval("recargarTextoHeaderAdmin()", 5000);
*/

