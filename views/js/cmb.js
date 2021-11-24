//tablas maestras fuas
function listar_personal_plataforma(){
    $.ajax({
        url:'../controllers/staffController.php',
        type:'POST',
    }).done(function(resp)
    {
        //alert(resp);
        var data =JSON.parse(resp);
        var cadena="";
        if(data.length>0){
           for (var i = 0; i < data.length; i++) {
               cadena +="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
               
           }
           $("#sel_atiende").html(cadena);
        
           var idplatform =  $("#sel_atiende").val();
           
           
           
        }else{
            cadena +="<option value=''>'No existe'</option>";
            $("#sel_atiende").html(cadena);
        }

    })
}
function listar_lugar_atencion(){
    $.ajax({
        url:'../controllers/attentionController.php',
        type:'POST',
    }).done(function(resp)
    {
        //alert(resp);
        var data =JSON.parse(resp);
        var cadena="";
        if(data.length>0){
           for (var i = 0; i < data.length; i++) {
               cadena +="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
               
           }
           $("#sel_lugar").html(cadena);
        
           var idplatform =  $("#sel_lugar").val();
           
           
           
        }else{
            cadena +="<option value=''>'No existe'</option>";
            $("#sel_lugar").html(cadena);
        }

    })
}

function listar_tipo_atencion(){
    $.ajax({
        url:'../controllers/typeattentionController.php',
        type:'POST',
    }).done(function(resp)
    {
        //alert(resp);
        var data =JSON.parse(resp);
        var cadena="";
        if(data.length>0){
           for (var i = 0; i < data.length; i++) {
               cadena +="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
               
           }
           $("#sel_tipoatencion").html(cadena);
        
           var idattentions=  $("#sel_tipoatencion").val();
           
           
           
        }else{
            cadena +="<option value=''>'No existe'</option>";
            $("#sel_tipoatencion").html(cadena);
        }

    })
}
function listar_concepto_prestacion(){
    $.ajax({
        url:'../controllers/conceptController.php',
        type:'POST',
    }).done(function(resp)
    {
        //alert(resp);
        var data =JSON.parse(resp);
        var cadena="";
        if(data.length>0){
           for (var i = 0; i < data.length; i++) {
               cadena +="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
               
           }
           $("#sel_concepto").html(cadena);
        
           var idbconcept =  $("#sel_concepto").val();
           
        }else{
            cadena +="<option value=''>'No existe'</option>";
            $("#sel_concepto").html(cadena);
        }

    })
}
function listar_destino_asegurado(){
    $.ajax({
        url:'../controllers/destinationController.php',
        type:'POST',
    }).done(function(resp)
    {
        //alert(resp);
        var data =JSON.parse(resp);
        var cadena="";
        if(data.length>0){
           for (var i = 0; i < data.length; i++) {
               cadena +="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
               
           }
           $("#sel_destino").html(cadena);
        
           var iddestination =  $("#sel_destino").val();
           
           
           
        }else{
            cadena +="<option value=''>'No existe'</option>";
            $("#sel_destino").html(cadena);
        }

    })
}
function listar_doctores_iren(){
    $.ajax({
        url:'../controllers/doctorsController.php',
        type:'POST',
    }).done(function(resp)
    {
        //alert(resp);
        var data =JSON.parse(resp);
        var cadena="";
        if(data.length>0){
           for (var i = 0; i < data.length; i++) {
               cadena +="<option value='"+data[i][0]+"'>"  +data[i][3] +" " +data[i][2]+ "</option>";
               
           }
           $("#sel_doctores").html(cadena);
        
           var iddoctor =  $("#sel_doctores").val();
           
           
           
        }else{
            cadena +="<option value=''>'No existe'</option>";
            $("#sel_doctores").html(cadena);
        }

    })
}

function listar_tipo_fua(){
    $.ajax({
        url:'../controllers/typefuaController.php',
        type:'POST',
    }).done(function(resp)
    {
        //alert(resp);
        var data =JSON.parse(resp);
        var cadena="";
        if(data.length>0){
           for (var i = 0; i < data.length; i++) {
               cadena +="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
               
           }
           $("#sel_tipofua").html(cadena);
        
           var idtypefua =  $("#sel_tipofua").val();
           
           
           
        }else{
            cadena +="<option value=''>'No existe'</option>";
            $("#sel_tipofua").html(cadena);
        }

    })
}

//fin de maestros
function listar_departamento(){
    $.ajax({
        url:'../controllers/departamentController.php',
        type:'POST',
    }).done(function(resp)
    {
        //alert(resp);
        var data =JSON.parse(resp);
        var cadena="";
        if(data.length>0){
           for (var i = 0; i < data.length; i++) {
               cadena +="<option value='"+data[i][0]+"'>" +data[i][1]+"</option>";
               
           }
           $("#sel_departamento").html(cadena);
        
           var iddepartamento =  $("#sel_departamento").val();
           listar_provincia(iddepartamento);
           
           
        }else{
            cadena +="<option value=''>'No existe'</option>";
            $("#sel_departamento").html(cadena);
        }

    })
}
function listar_provincia(iddepartamento){
    $.ajax({
        url:'../controllers/provinceController.php',
        type:'POST',
        data:{
            iddepartamento:iddepartamento 
        }
    }).done(function(resp)
    {
       // alert(resp);
        var data =JSON.parse(resp);
        var cadena="";
        if(data.length>0){
           for (var i = 0; i < data.length; i++) {
               cadena +="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
               
           }
           $("#sel_provincia").html(cadena);
        
           var idprovincia =  $("#sel_provincia").val();
           listar_distrito(idprovincia);
           
        }else{
            cadena +="<option value=''>'No existe'</option>";
            $("#sel_provincia").html(cadena);
        }

    })
}
function listar_distrito(idprovincia){
    $.ajax({
        url:'../controllers/districtController.php',
        type:'POST',
        data:{
            idprovincia:idprovincia 
        }
    }).done(function(resp)
    {
        //alert(resp);
        var data =JSON.parse(resp);
        var cadena="";
        if(data.length>0){
           for (var i = 0; i < data.length; i++) {
               cadena +="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
               
           }
           $("#sel_distrito").html(cadena);
        
           var iddistrito =  $("#sel_distrito").val();
           listar_ipress(iddistrito)
           
           
        }else{
            cadena +="<option value=''>'No existe'</option>";
            $("#sel_distrito").html(cadena);
        }

    })
}
function listar_ipress(iddistrito){
    $.ajax({
        url:'../controllers/ipressController.php',
        type:'POST',
        data:{
            iddistrito:iddistrito 
        }
    }).done(function(resp)
    {
        //alert(resp);
        var data =JSON.parse(resp);
        var cadena="";
        if(data.length>0){
           for (var i = 0; i < data.length; i++) {
               cadena +="<option value='"+data[i][0]+"'>"+data[i][2]+ " " +data[i][1]+"</option>";
               
           }
           $("#sel_ipress").html(cadena);
        
           var idipress =  $("#sel_ipress").val();
           
           
        }else{
            cadena +="<option value=''>'No existe'</option>";
            $("#sel_ipress").html(cadena);
        }

    })
}

//ubicacion refcon

function listar_departamentoc(){
    $.ajax({
        url:'../controllers/departamentController.php',
        type:'POST',
    }).done(function(resp)
    {
        //alert(resp);
        var data =JSON.parse(resp);
        var cadena="";
        if(data.length>0){
           for (var i = 0; i < data.length; i++) {
               cadena +="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
               
           }
           $("#sel_departamentoc").html(cadena);
        
           var iddepartamento =  $("#sel_departamentoc").val();
           listar_provinciac(iddepartamento);
           
           
        }else{
            cadena +="<option value=''>'No existe'</option>";
            $("#sel_departamentoc").html(cadena);
        }

    })
}
function listar_provinciac(iddepartamento){
    $.ajax({
        url:'../controllers/provinceController.php',
        type:'POST',
        data:{
            iddepartamento:iddepartamento 
        }
    }).done(function(resp)
    {
       // alert(resp);
        var data =JSON.parse(resp);
        var cadena="";
        if(data.length>0){
           for (var i = 0; i < data.length; i++) {
               cadena +="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
               
           }
           $("#sel_provinciac").html(cadena);
        
           var idprovincia =  $("#sel_provinciac").val();
           listar_distritoc(idprovincia);
           
        }else{
            cadena +="<option value=''>'No existe'</option>";
            $("#sel_provinciac").html(cadena);
        }

    })
}
function listar_distritoc(idprovincia){
    $.ajax({
        url:'../controllers/districtController.php',
        type:'POST',
        data:{
            idprovincia:idprovincia 
        }
    }).done(function(resp)
    {
        //alert(resp);
        var data =JSON.parse(resp);
        var cadena="";
        if(data.length>0){
           for (var i = 0; i < data.length; i++) {
               cadena +="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
               
           }
           $("#sel_distritoc").html(cadena);
        
           var iddistrito =  $("#sel_distritoc").val();
           listar_ipressc(iddistrito)
           
           
        }else{
            cadena +="<option value=''>'No existe'</option>";
            $("#sel_distritoc").html(cadena);
        }

    })
}
function listar_ipressc(iddistrito){
    $.ajax({
        url:'../controllers/ipressController.php',
        type:'POST',
        data:{
            iddistrito:iddistrito 
        }
    }).done(function(resp)
    {
        //alert(resp);
        var data =JSON.parse(resp);
        var cadena="";
        if(data.length>0){
           for (var i = 0; i < data.length; i++) {
               cadena +="<option value='"+data[i][0]+"'>"+data[i][2]+ " "+data[i][1]+"</option>";
               
           }
           $("#sel_ipressc").html(cadena);
        
           var idipress =  $("#sel_ipressc").val();
           
           
        }else{
            cadena +="<option value=''>'No existe'</option>";
            $("#sel_ipressc").html(cadena);
        }

    })
}