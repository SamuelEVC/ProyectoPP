$(document).ready(function(){
    tablaPersonas = $("#tablaPersonas").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
       }],
        
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    
$("#btnNuevo").click(function(){
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Persona");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    nombre = fila.find('td:eq(1)').text();
    pais = fila.find('td:eq(2)').text();
    edad = parseInt(fila.find('td:eq(3)').text());
    
    $("#nombre").val(nombre);
    $("#pais").val(pais);
    $("#edad").val(edad);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Persona");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaPersonas.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});
    
$("#formPersonas").submit(function(e){
    e.preventDefault();    
    nombre = $.trim($("#nombre").val());
    pais = $.trim($("#pais").val());
    edad = $.trim($("#edad").val());    
    $.ajax({
        url: "bd/crud.php",
        type: "POST",
        dataType: "json",
        data: {nombre:nombre, pais:pais, edad:edad, id:id, opcion:opcion},
        success: function(data){  
            console.log(data);
            id = data[0].id;            
            nombre = data[0].nombre;
            pais = data[0].pais;
            edad = data[0].edad;
            if(opcion == 1){tablaPersonas.row.add([id,nombre,pais,edad]).draw();}
            else{tablaPersonas.row(fila).data([id,nombre,pais,edad]).draw();}            
        }        
    });
    $("#modalCRUD").modal("hide");    
    
});    
    




//////////////////////////////////
//--Script de PAGINA PRINCIPAL--//

tablaTareasDiarias = $("#tablaTareasDiarias").DataTable({
    "createdRow":function(row,data,index){
        var num = data[7]

        switch(num){
            case '1':
                $('td', row).eq(8).css({
                    'background-color':'#F13D24',//rojo
                    'color':'white'
                });
            break;
            case '2':
                $('td', row).eq(8).css({
                    'background-color':'#FF932E',//naranja
                    'color':'white'
                });
            break;
            case '3':
                $('td', row).eq(8).css({
                    'background-color':'#4df50e',//verde
                    'color':'white'
                });
            break;

        }
    },


    "columnDefs":[{
     "targets": -1,
     "data":null,
     "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarTarea'><i class='material-icons'>edit</i></button><button type='button' class='btn btn-danger btnBorrarTarea'><i class='fa fa-trash' aria-hidden='true'></i></button> </div>"  
    }],
     
 "language": {
         "lengthMenu": "Mostrar _MENU_ registros",
         "zeroRecords": "No se encontraron resultados",
         "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
         "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
         "infoFiltered": "(filtrado de un total de _MAX_ registros)",
         "sSearch": "Buscar:",
         "oPaginate": {
             "sFirst": "Primero",
             "sLast":"Último",
             "sNext":"Siguiente",
             "sPrevious": "Anterior"
          },
          "sProcessing":"Procesando...",
     }
 });


$("#btnNuevaTarea").click(function(){
    $("#formTareas").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Tarea");            
    $("#modalCRUD").modal("show");        
    id=null;
    opci = 1; //alta
});    

//botón EDITAR    
$(document).on("click", ".btnEditarTarea", function(){
    fila = $(this).closest("tr");
    tareaID = parseInt($(this).closest("tr").find('td:eq(0)').text());

    tipologia = fila.find('td:eq(1)').text();
    cuadrilla = fila.find('td:eq(3)').text();
    descripcion = fila.find('td:eq(5)').text();
    //estado = fila.find('td:eq(7)').text();
    /*
    switch (estado) {
        case '1':
            $("#estadoT").css("color", "red");
        break;
        case '2':
            $("#estadoT").css("color", "yellow");
        break;

    }*/
    

    console.log( fila);

    $("#tipoloDrop").val(tipologia);//setea el valor
    $("#descTarea").val(descripcion);
    $("#cuadrillaDrop").val(cuadrilla);
    
    //console.log($("#tipoloDrop").val());

    opci = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Tarea");    
    //$(".modal-footer").html("<button type='button' class='btn btn-light' data-dismiss='modal' id='cancelar'>Cancelar</button> <button type='button' class='btn btn-danger btnBorrarTarea'>Borrar</button>  <button type='submit' id='btnGuardar' class='btn btn-dark'>Enviar</button>");      
    $("#modalCRUD").modal("show");  
    
});


//metodo para quitar el boton de Borrar NO SE USA
$("#formTareas").on("click", "#cancelar", function(){
    $("#modalCRUD").modal("hide"); 
    if(opci == 2){
        $(".modal-footer").html("<button type='button' class='btn btn-light' data-dismiss='modal' id='cancelar'>Cancelar</button>  <button type='submit' id='btnGuardar' class='btn btn-dark'>Enviar</button>");  
    }
});

var tareaID;

//BOTON BORRAR
$(document).on("click", ".btnBorrarTarea", function(){    
    fila = $(this);
    tareaID = parseInt($(this).closest("tr").find('td:eq(0)').text());
    filaa = $(this).closest("tr");
    descripcion = filaa.find('td:eq(5)').text();

    opci = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+tareaID + "  "+ descripcion + "?");
    
    if(respuesta){
        $.ajax({
            url: "bd/crudTareaDiaria.php",
            type: "POST",
            dataType: "json",
            data: {opci:opci, tareaID:tareaID},

            success: function(){
                //tablaPersonas.row(fila.parents('tr')).remove().draw();
                console.log("ENTRO");
                window.location.reload()
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
    }  
    $("#modalCRUD").modal("hide");  
});


$("#formTareas").submit(function(e){
    e.preventDefault(); 
    
    tipologia = $.trim($("#tipoloDrop").val());   
    descripcion = $.trim($("#descTarea").val());   
    cuadrilla = $.trim($("#cuadrillaDrop").val());   
    nombreUsuario = $.trim($("#nombreUsuario").text()); 

    console.log("tipologia: " +tipologia + " | descripcion: " + descripcion + " | cuadrilla: " + cuadrilla + " | opcion: " + opci + " | tareaID: " + tareaID + " | nombreUsuario: " + nombreUsuario);

    
    $.ajax({
        url: "bd/crudTareaDiaria.php",
        type: "POST",
        dataType: "json",
        data: {tipologia:tipologia, descripcion:descripcion, cuadrilla:cuadrilla, opci:opci, tareaID:tareaID, nombreUsuario:nombreUsuario },
        
        success: function(data){  
            console.log(data);
            window.location.reload()
            /*
            Tarea_ID = data[0].tarea_ID; 
            Tipologia_ID = data[0].tipologia_ID; 
            Tipologia = data[0].tipologia; 
            Cuadrilla_ID = data[0].cuadrilla_ID;
            Cuadrilla = data[0].cuadrilla;
            Descripcion = data[0].descripcion;      
            FechaInicio = data[0].fecha_Ini;
            Estado_ID = data[0].estado_id;
            Estado = data[0].estado;
            if(opci == 2){
                $(".modal-footer").html("<button type='button' class='btn btn-light' data-dismiss='modal' id='cancelar'>Cancelar</button>  <button type='submit' id='btnGuardar' class='btn btn-dark'>Enviar</button>");  
            }
            */ 

               
                
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

    $("#modalCRUD").modal("hide");    
    
});    


});