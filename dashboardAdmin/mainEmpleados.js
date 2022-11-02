$(document).ready(function(){
    
    //opci para todos
    opci =0
    //id vacio para que no rompa el alta
    id=""
    

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
        $("#modalEMP").modal("show");        
        id=null;
        opci = 1; //alta
    }); 

    
    
    //aceptar Modal Agregar Empleados
    $("#modalEMP").submit(function(e){
        e.preventDefault(); 
        
        nombre = $.trim($("#nombreUser").val());   
        usuario = $.trim($("#usuario").val());   
        contraseña = $.trim($("#contraseña").val());    
        cuadrilla = $.trim($("#cuadrillaDrop").val());
           
        //nombreUsuario = $.trim($("#nombreUsuario").text()); 
    
        console.log("nombre: " +nombre + " | usuario: " + usuario + " | cuadrilla: " + cuadrilla + " | opcion: " + opci + " | contraseña: " + contraseña );
        
        console.log(isNumber(cuadrilla));
    
    
        if(isNumber(cuadrilla) && nombre != "" && usuario != "" && contraseña != ""){
            $.ajax({
                url: "bd/BDEmpleados.php",
                type: "POST",
                dataType: "json",
                data: {"nombre":nombre,"usuario":usuario, "contraseña":contraseña, "cuadrilla":cuadrilla},
                
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
                'Faltan datos!',
                'Seleccione un tipo o una cuadrilla o escriba una descripcion para enviar formulario',
                'warning',
                );
            }
            
            
            
    });    
        // Abrir modal para editar empleados
    $(document).on("click", "#btnEditarEmpleado", function(){
        
            $("#modalEMP").trigger("reset");
            $(".modal-header").css("background-color", "#4e73df");
            $(".modal-header").css("color", "white");
            $(".modal-title").text("Editar Empleado");            
            $("#modalEMP").modal("show");        
            id=null;
            opci = 0; //alta
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
    
        console.log("nombre Cuadrilla: " +nombreCuadrilla + " id: " + idcuadrilla + " opcion: " + opci);
        
    
    
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
             console.log("Se escondio?");
        }else{
            Swal.fire(
                'Faltan datos!',
                'escriba un nombre de Cuadrilla descriptivo',
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
        opci = 2; //NO VA A FUNCIONAR WE 


        var cuadrilla =$.trim($(this).closest("li").clone().children().remove().end().text());
        id = $(this).val();
        
        

        $("#nombreCuadrilla").val(cuadrilla);

        console.log("id: " + id + "  Cuadrilla: " + cuadrilla)

    }); 
    
    
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