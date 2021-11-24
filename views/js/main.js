$(document).ready(function(){
    $("#txtNroDoc").focus();
    $("#frmConsultaSISdoc").submit(function(e){
        e.preventDefault();
        console.log("enviado...");
        $.ajax({
          method: "POST",
          url: "../controllers/_consultaSIS.php",
          data: $("#frmConsultaSISdoc").serialize(),
          beforeSend:function(){
              $("#resultado").html("<div class='spinner-border' role='status'><span class='visually-hidden'>Loading...</span></div> Consultando...");	
              $("#txtTipoDoc").prop("disabled",true);
              $("#txtNroDoc").prop("disabled",true);
              $("button").prop("disabled",true);
          }
        })
      .done(function( msg ) {
        var obj = jQuery.parseJSON(msg);
      // var tdi=obj.afiliadoDetalle.tipoDocumento;
        $("#resultado").html(msg);
        if(obj.afiliadoDetalle.tipoDocumento=="1")
        {
            $("#tdi-paciente").val(2),
            $("#nhc-paciente").val(obj.afiliadoDetalle.nroDocumento);
        }
        else{
            $("#tdi-paciente").val(obj.afiliadoDetalle.tipoDocumento);
            $("#nhc-paciente").val(obj.afiliadoDetalle.nroDocumento);
        }

        if(obj.afiliadoDetalle.genero=="1")
        {
            $("#genero-paciente").val("Masculino");
        }
        else
        {
            $("#genero-paciente").val("Femenino");
        }

        var str=(obj.afiliadoDetalle.fecNacimiento);
        var anio = str.substr(0, 4);
        var mes = str.substr(4, 2);
        var dia = str.substr(6, 2);
        var fec= anio+'-'+mes+'-'+dia;
        var fecha = new Date(fec);
        var contar=(obj.afiliadoDetalle.nombres.indexOf(" "));
        if(contar>=1){
            var cadena=(obj.afiliadoDetalle.nombres);
            var nom1=cadena.substr(0, contar);
            var nom2=cadena.substr(contar + 1, 50);
        }
        else{
            var cadena=(obj.afiliadoDetalle.nombres);
            var nom1=cadena;
        }
        //var final=(obj.afiliadoDetalle.nombres.length(""));
       
        
        

           
            $("#dni-paciente").val(obj.afiliadoDetalle.nroDocumento),
            
            $("#nac-paciente").val(fec);
            $("#apMaterno").val(obj.afiliadoDetalle.apeMaterno),
            $("#apPaterno").val(obj.afiliadoDetalle.apePaterno),
            $("#nombre1").val(nom1),
            $("#nombres").val(nom2),
            $("#diresa").val(obj.afiliadoDetalle.disa),
            $("#tipoformato").val(obj.afiliadoDetalle.tipoFormato),
            $("#numerosis").val(obj.afiliadoDetalle.nroContrato),
            
            

           
            $("#txtNroDoc").prop("disabled",false);
            $("button").prop("disabled",false);
            $("#txtNroDoc").select();
            console.log("finalizado.");
      });
    });
    $(document).on("click","#btnMostrar",function(){
        $("#contenidoAdicional").toggle("slow");
    });
})
$(document).ready(function(){
	$('.etnia').select2(); 
});
$(document).ready(function(){
	$('.js-busqueda-basic-single').select2(); 
});

$(document).ready(function(){
	$('.js-ubigeo-basic-single').select2();
    listar_departamento();  
});
$(document).ready(function(){
	$('.js-ubigeoc-basic-single').select2();
    listar_departamentoc();  
});
$(document).ready(function(){
	$('.js-fua-basic-single').select2();
    listar_personal_plataforma();  
    listar_lugar_atencion();
    listar_tipo_atencion();
    listar_concepto_prestacion();
    listar_doctores_iren();
    listar_destino_asegurado();
    listar_tipo_fua();
});
$(document).ready(function(){
   
    //aqui cargar todo de  ubigeo de referido  
    $("#sel_departamento").change(function(){
        var iddepartamento =$("#sel_departamento").val();
               listar_provincia(iddepartamento);
    })
    $("#sel_provincia").change(function(){
        var idprovincia=$("#sel_provincia").val();
        listar_distrito(idprovincia);
    }) 
    
    $("#sel_distrito").change(function(){
        var iddistrito=$("#sel_distrito").val();
        listar_ipress(iddistrito);
    })   

     //aqui cargar todo de  ubigeo a donde se refiere  
     $("#sel_departamentoc").change(function(){
        var iddepartamento =$("#sel_departamentoc").val();
               listar_provinciac(iddepartamento);
    })
    $("#sel_provinciac").change(function(){
        var idprovincia=$("#sel_provinciac").val();
        listar_distritoc(idprovincia);
    }) 
    
    $("#sel_distritoc").change(function(){
        var iddistrito=$("#sel_distritoc").val();
        listar_ipressc(iddistrito);
    })
    
    
    //aqui cargar tablas maestras del fua
    

    
    //aqui cargar todo primera lectura
    //
    $('#buscar').on('click',function(){
		var bdni = $('#bdni').val();
		if (bdni !='')
		{
			$.ajax({
				url:'http://localhost/iren2020/vistas/contenidos/buscar.php',
				method:'POST',
				data:{bdni:bdni},
				dataType: "JSON",
            	 success:function(data){
						$('#dni-pacientes').text(data.DNI);
						$("#dni-paciente").val(data.DNI);
											
            	}
        	});

		}else
		{
			swal({
				title:'Error!',
				text:"Ingrese DNI",
				type:'error'
				})
		}

     
    });
    //dddd
   
   
    //eee

	$('.btn-sideBar-SubMenu').on('click', function(e){
		e.preventDefault();
		var SubMenu=$(this).next('ul');
		var iconBtn=$(this).children('.zmdi-caret-down');
		if(SubMenu.hasClass('show-sideBar-SubMenu')){
			iconBtn.removeClass('zmdi-hc-rotate-180');
			SubMenu.removeClass('show-sideBar-SubMenu');
		}else{
			iconBtn.addClass('zmdi-hc-rotate-180');
			SubMenu.addClass('show-sideBar-SubMenu');
		}
	});
	
	$('.btn-menu-dashboard').on('click', function(e){
		e.preventDefault();
		var body=$('.dashboard-contentPage');
		var sidebar=$('.dashboard-sideBar');
		if(sidebar.css('pointer-events')=='none'){
			body.removeClass('no-paddin-left');
			sidebar.removeClass('hide-sidebar').addClass('show-sidebar');
		}else{
			body.addClass('no-paddin-left');
			sidebar.addClass('hide-sidebar').removeClass('show-sidebar');
		}
	});
	$('.FormularioAjax').submit(function(e){
        e.preventDefault();

        var form=$(this);

        var tipo=form.attr('data-form');
        var accion=form.attr('action');
        var metodo=form.attr('method');
        var respuesta=form.children('.RespuestaAjax');

        var msjError="<script>swal('Ocurrió un error inesperado','Por favor recargue la página','error');</script>";
        var formdata = new FormData(this);
 

        var textoAlerta;
        if(tipo==="save"){
            textoAlerta="Los datos que enviaras quedaran almacenados en el sistema";
        }else if(tipo==="delete"){
            textoAlerta="Los datos serán eliminados completamente del sistema";
        }else if(tipo==="update"){
        	textoAlerta="Los datos del sistema serán actualizados";
        }else{
            textoAlerta="Quieres realizar la operación solicitada";
        }


        swal({
            title: "¿Estás seguro?",   
            text: textoAlerta,   
            type: "question",   
            showCancelButton: true,     
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar"
        }).then(function () {
            $.ajax({
                type: metodo,
                url: accion,
                data: formdata ? formdata : form.serialize(),
                cache: false,
                contentType: false,
                processData: false,
                xhr: function(){
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        if(percentComplete<100){
                        	respuesta.html('<p class="text-center">Procesado... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
                      	}else{
                      		respuesta.html('<p class="text-center"></p>');
                      	}
                      }
                    }, false);
                    return xhr;
                },
                success: function (data) {
                    respuesta.html(data);
                },
                error: function() {
                    respuesta.html(msjError);
                }
            });
            return false;
        });
    });
	
});


(function($){
    $(window).on("load",function(){
        $(".dashboard-sideBar-ct").mCustomScrollbar({
        	theme:"light-thin",
        	scrollbarPosition: "inside",
        	autoHideScrollbar: true,
        	scrollButtons: {enable: true}
        });
        $(".dashboard-contentPage, .Notifications-body").mCustomScrollbar({
        	theme:"dark-thin",
        	scrollbarPosition: "inside",
        	autoHideScrollbar: true,
        	scrollButtons: {enable: true}
        });
    });
})(jQuery);
