$(document).ready(function(){

    //opci para todos
    opci =0
    //id vacio para que no rompa el alta
    id=""
    //
    id_userselect=0
    $("li").click(function() {
        $("li").removeClass("active");
        $(this).addClass("active");
      });

      //Abrir modal Agregar Empleados

    $("#btnNuevoEmpleado").click(function(){
        $("#modalEMP").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nuevo Empleado");   
        $("#contraseña").attr("placeholder", "");          
        $("#modalEMP").modal("show");
        $("#check").toggle(false);
        $("#nombreEMP").val("");
        $("#usuarioEMP").val("");
        $("#cuadrillaSELECT").val(0);

        id=null;
        opci = 1; //alta
    }); 

    
    
    //aceptar Modal Empleados
$("#modalEMP").submit(function(e){
        e.preventDefault(); 
        
        nombre = $.trim($("#nombreUser").val());   
        usuario = $.trim($("#usuario").val());   
        contraseña = $.trim($("#contraseña").val());    
        cuadrilla = $.trim($("#cuadrillaSELECT").val());
        
        if($('#chkhabilitado').is(':checked')){
            chk = 1
        }else{
            chk = 2            
        }
    
        if(opci == 1){
            if(cuadrilla != 0 && nombre != "" && usuario != "" && contraseña != ""){//isNumber(cuadrilla)
                $.ajax({
                    url: "bd/BDEmpleados.php",
                    type: "POST",
                    dataType: "json",
                    data: {"nombre":nombre,"usuario":usuario, "contraseña":contraseña, "cuadrilla":cuadrilla, "opci":opci},
                    
                    success: function(data){  
                        console.log(data);
                        window.location.reload();          
                    },
                    error: function (jqXHR, exception) {
                        var msg = '';
                        if (jqXHR.status === 0) {
                            msg = 'Not connect.\n Verify Network.';
                        } else if (jqXHR.status == 404) {
                            msg = 'Requested page not found. [404]';
                        } else if (jqXHR.status == 500) {
                            msg = 'Internal Server Error [500].';
                        } else if (exception === 'parsererror') {
                            msg = 'Requested JSON parse failed.';
                        } else if (exception === 'timeout') {
                            msg = 'Time out error.';
                        } else if (exception === 'abort') {
                            msg = 'Ajax request aborted.';
                        } else {
                            msg = 'Uncaught Error.\n' + jqXHR.responseText;
                        }
                        console.log(msg);
                    },   
                });
                $("#modalEMP").modal("hide");  
            }else{
                Swal.fire(
                    '¡Faltan datos!',
                    'Seleccione un tipo o una cuadrilla o escriba una descripción para enviar formulario',
                    'warning',
                );
            }
        }else if(opci==2){

            if(cuadrilla != 0 && nombre != "" && usuario != ""){          

                $.ajax({
                    url: "bd/BDEmpleados.php",
                    type: "POST",
                    dataType: "json",
                    data: {"nombre":nombre,"usuario":usuario,"id_user":id_userselect,"contraseña":contraseña,"cuadrilla":cuadrilla,"check":chk, "opci":opci},
                    
                    success: function(data){  
                        console.log(data);
                        window.location.reload();          
                    },
                    error: function (jqXHR, exception) {
                        var msg = '';
                        if (jqXHR.status === 0) {
                            msg = 'Not connect.\n Verify Network.';
                        } else if (jqXHR.status == 404) {
                            msg = 'Requested page not found. [404]';
                        } else if (jqXHR.status == 500) {
                            msg = 'Internal Server Error [500].';
                        } else if (exception === 'parsererror') {
                            msg = 'Requested JSON parse failed.';
                        } else if (exception === 'timeout') {
                            msg = 'Time out error.';
                        } else if (exception === 'abort') {
                            msg = 'Ajax request aborted.';
                        } else {
                            msg = 'Uncaught Error.\n' + jqXHR.responseText;
                        }
                        console.log(msg);
                    },   
                    });
                        $("#modalEMP").modal("hide");
                
            }
            else{
                Swal.fire(
                    '¡Faltan datos!',
                    'Seleccione un tipo o una cuadrilla, escriba un Nombre y Usuario para enviar formulario',
                    'warning',
                );
            }
        }
          
});    


        // Abrir modal para editar empleados
    $(document).on("click", "#btnEditarEmpleado", function(){
        
            $("#modalEMP").trigger("reset");
            $(".modal-header").css("background-color", "#4e73df");
            $(".modal-header").css("color", "white");
            $(".modal-title").text("Editar Empleado"); 
            $("#contraseña").attr("placeholder", "Para conservar contraseña deje este campo vacio");               
            $("#modalEMP").modal("show");
            $("#check").show();//este es el div del check

            $("#userDiv").hide();//asdeste es el div del check

            

            id=$(this).val();
            // console.log(id);
            opci = 3; //Consulta

            $.ajax({
                url: "bd/BDEmpleados.php",
                type: "POST",
                dataType: "json",
                data: {"id":id,"opci":opci},

                success:function(data){
                    console.log(data);

                    nombre = data[0].nombre;    
                    usuario = data[0].usuario;    
                    cuadrilla = data[0].id_cuadrilla;
                    habilitado = data[0].habilitado;
                    id_userselect=data[0].id_usuario;
                    
                    $("#nombreUser").val(nombre);
                    $("#usuario").val(usuario);
                    $("#cuadrillaSELECT").val(cuadrilla);

                    if(habilitado == 1){
                    $("#chkhabilitado").prop('checked', true);
                    }
                    else{
                        $("#chkhabilitado").prop('checked', false);
                    }
                    
                },
                error: function (jqXHR, exception) {
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    console.log(msg);
                },
            })

            opci=2//Editar;


    }); 
        



        //Abrir modal agregar Cuadrilla
    $("#btnNuevaCuadrilla").click(function(){
        $("#modalCUAD").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nueva Cuadrilla");            
        $("#modalCUAD").modal("show");        
        id=null;
        opci = 1; //alta
    }); 


    
    //aceptar Modal Cuadrilla
    $("#modalCUAD").submit(function(e){
        e.preventDefault(); 
        
        nombreCuadrilla = $.trim($("#nombreCuadrilla").val());
        idcuadrilla = id;  
        
        
        //nombreUsuario = $.trim($("#nombreUsuario").text()); 
    
        //console.log("nombre Cuadrilla: " +nombreCuadrilla + " id: " + idcuadrilla + " opcion: " + opci);
        
    
    
        if(nombreCuadrilla != ""){
            $.ajax({
                url: "bd/BDCuadrillas.php",
                type: "POST",
                dataType: "json",
                data: {"nombreCuadrilla":nombreCuadrilla,"idcuadrilla":idcuadrilla, "opci":opci},
                
                success: function(data){  
                    console.log(data);
                    window.location.reload();          
                },
                error: function (jqXHR, exception) {
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    console.log(msg);
                },   
            });
             $("#modalCUAD").modal("hide");  
        }else{
            Swal.fire(
                '¡Faltan datos!',
                'Escriba un nombre de Cuadrilla descriptivo',
                'warning',
            );
    
        }
    
          
        
    });    
    
    //Abrir modal Editar Cuadrilla
    $(document).on("click", "#btnEditarCuadrilla", function(){
        $("#modalCUAD").trigger("reset");
        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Cuadrilla");            
        $("#modalCUAD").modal("show");        
        id=null;
        opci = 2; 


        var cuadrilla =$.trim($(this).closest("li").clone().children().remove().end().text());
        id = $(this).val();
        
        

        $("#nombreCuadrilla").val(cuadrilla);

        //console.log("id: " + id + "  Cuadrilla: " + cuadrilla)

    }); 
    
    function UserNameExist(userName){//capas lo podamos usar, pero hay que buscarle otra vuelta

        $.ajax({
            url: "bd/BDCuadrillas.php",
            type: "POST",
            dataType: "json",
            data: {"userName":userName, "opci":4},
            
            success: function(data){  
                console.log(data);
                if(data != null){
                    return false;    
                }else{
                    return true;  
                }
                    
            },

        });

        
    }


    function isNumber(num){
        var x;
        var e = parseInt(num);
        if(!isNaN(e)){
        x= true;
        }else{
        x= false;
        }
     return x;
    }
});