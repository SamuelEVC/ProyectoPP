$(document).ready(function(){
    
    //////////////////////////////////
    //--Script de PAGINA PRINCIPAL--//
    tablaTareasDiarias = $("#tablaTareasDiarias").DataTable({
        "createdRow":function(row,data,index){
            var num = data[7]

            switch(num){
                case '1':
                    $('td', row).eq(8).css({
                        'background-color':'#e84c3d',//rojo
                        'color':'white'
                    });
                break;
                case '2':
                    $('td', row).eq(8).css({
                        'background-color':'#ffcd02',//naranja
                        'color':'white'
                    });
                break;
                case '3':
                    $('td', row).eq(8).css({
                        'background-color':'#2dcc70',//verde  #4df50e  <--viejo
                        'color':'white'
                    });
                break;

            }
        },


        "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group' id='btnAbsolutes'><button class='btn btn-primary btnEditarTarea' title='Editar tarea de la fila'><i class='material-icons'>edit</i></button><button type='button' class='btn btn-danger btnBorrarTarea' title='Borrar fila'><i class='fa fa-trash' aria-hidden='true'></i></button> </div>"  
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
        },
        //para usar los botones   
        responsive: "true",
        dom: 'Bfrtilp',       
        buttons:[ 
            {
                text:      '<i class="fa fa-plus-square" aria-hidden="true"></i> Tarea Nueva',
                titleAttr: 'Tarea Nueva',
                className: 'btn btn-success btnNuevaTarea'
                
            }
        ]	        
        
    });

        
    var fila; //capturar la fila para editar o borrar el registro

        

    $(".btnNuevaTarea").click(function(){
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


        //setea el valor
        $("#tipoloDrop").val(tipologia);
        $("#descTarea").val(descripcion);
        $("#cuadrillaDrop").val(cuadrilla);
        

        opci = 2; //editar
        
        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Tarea");      
        $("#modalCRUD").modal("show");  
        
    });


    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger mr-2'
        },
        buttonsStyling: false
    });

    var tareaID;

    //BOTON BORRAR
    $(document).on("click", ".btnBorrarTarea", function(){    
        fila = $(this);
        tareaID = parseInt($(this).closest("tr").find('td:eq(0)').text());
        filaa = $(this).closest("tr");
        descripcion = filaa.find('td:eq(5)').text();

        opci = 3 //borrar

        swalWithBootstrapButtons.fire({
            title: '¿Estás Seguro?',
            text: "Se eliminará la tarea: " + tareaID +  "\n" + "¡NO PODRÁS DEHACER ESTE CAMBIO!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Borralo',
            cancelButtonText: 'Cancelar',
            reverseButtons: true

        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "bd/crudTareaDiaria.php",
                    type: "POST",
                    dataType: "json",
                    data: {opci:opci, tareaID:tareaID},
        
                    success: function(data){
                        console.log(data);
                        swalWithBootstrapButtons.fire(
                            '¡Eliminado!',
                            'La tarea fue eliminada',
                            'success'
                        ).then(() => {

                            window.location.reload();
                        });

                    }
                });

            } else if (
            
            result.dismiss === Swal.DismissReason.cancel
            ) {
            swalWithBootstrapButtons.fire(
                '¡Cancelado!',
                'La tarea está a salvo del olvido',
                'error'
            )
            }
        })

        $("#modalCRUD").modal("hide");  
    });


    $("#formTareas").submit(function(e){
        e.preventDefault(); 
        
        tipologia = $.trim($("#tipoloDrop").val());   
        descripcion = $.trim($("#descTarea").val());   
        cuadrilla = $.trim($("#cuadrillaDrop").val());   

        if(isNumber(tipologia) && isNumber(cuadrilla)&& descripcion != ""){
            $.ajax({
                url: "bd/crudTareaDiaria.php",
                type: "POST",
                dataType: "json",
                data: {tipologia:tipologia, descripcion:descripcion, cuadrilla:cuadrilla, opci:opci, tareaID:tareaID},
                
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
            $("#modalCRUD").modal("hide");  
        }else{
        
            Swal.fire(
                '¡Faltan datos!',
                'Seleccione una tipología y/o una cuadrilla y/o escriba una descripción para enviar el formulario.',
                'warning',
            );
        }

        
        
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


    //Editar datos del perfil//


    $(".btnEditarUsuario").click(function(){
        $("#formEditarUsuario").trigger("reset");
        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Usuario");     
        $("#modalEditarUsuario").modal("show");    
    }); 

    
$("#exampleCheck").click(function(){
    let isChecked = $('#exampleCheck')[0].checked

    if(isChecked) {
        $("#OldPassword").attr('type', 'text');  
        $("#NewPassword").attr('type', 'text'); 
        $("#NewPasswordrepeated").attr('type', 'text'); 
    }else{
        $("#OldPassword").attr('type', 'password');    
        $("#NewPassword").attr('type', 'password');   
        $("#NewPasswordrepeated").attr('type', 'password');   
    }
}); 


$("#formEditarUsuario").submit(function(e){
    e.preventDefault(); 
     
    OldPassword = $.trim($("#OldPassword").val());   
    NewPassword = $.trim($("#NewPassword").val());   
    NewPasswordrepeated = $.trim($("#NewPasswordrepeated").val());   
    
    if ( NewPassword == NewPasswordrepeated) {
        if( OldPassword == "" || NewPassword == "" || NewPasswordrepeated == ""){
            
            Swal.fire(
                '¡Cuidado!',
                'Faltan campos por completar',
                'warning',
            );
        }else{
            
            $.ajax({
                url: "bd/editarUsuario.php",
                type: "POST",
                dataType: "json",
                data: { OldPassword:OldPassword, NewPassword:NewPassword},
                
                success: function(data){  
                    //console.log(data);
                    //window.location.reload();      
                    
                    if(data != null){
                        Swal.fire(
                            '¡Exito!',
                            'Se guardaron los cambios',
                            'success',
                            );
                        $("#modalEditarUsuario").modal("hide");      
                    }else{ 
                        Swal.fire(
                            '¡Error!',
                            'La contraseña actual es incorrecta',
                            'error',
                        );
                    }
                },
            });           
        }          
    }else{
        Swal.fire(
            '¡Cuidado!',
            'No reescribió la nueva contraseña correctamente',
            'warning',
            ).then(() => {
                return;
            });;
    }
    
});    



});