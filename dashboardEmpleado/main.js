
//variables globales
var tareaID;
var opcion;

//metodo de modal al aniadir a "Finalizada"
function ResolucionF(){
    $("#form").trigger("reset");
    $("#resTarea").attr("placeholder", "Escriba una breve resolucion! (max 300 caracteres)");  
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Resolucion");            
    $("#modalCRUD").modal("show");      
    opcion = 3; //Finalizada 
};   


//boton de edicion 
$(document).on("click", ".btnEditarResolucion", function(){

    //console.log( fila);
    tareaID = $(this).attr('id');
    
    descripcion = $.trim($('.ResoluClass[id='+tareaID+']').text());

    //console.log(descripcion + tareaID);

    //setea el valor
    $("#resTarea").val(descripcion);

    opcion = 4; //editar 

    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Resolucion");      
    $("#resTarea").attr("placeholder", "Edite la resolucion! (max 300 caracteres)");
    $("#modalCRUD").modal("show");  
    
});

$("#form").submit(function(e){
    e.preventDefault(); 
     
    Resolucion = $.trim($("#resTarea").val());  
    console.log(Resolucion);

    if(Resolucion == ""){
        Swal.fire(
            'Cuidado!',
            'faltan campos por completar!',
            'warning',
        );
    }else{
        update(tareaID, opcion ,Resolucion);
        $("#modalCRUD").modal("hide"); 
    }
});


$(document).on("click", ".btnCancelar", function(){    
    if(opcion == 3){
        $("#modalCRUD").modal("hide");  
        window.location.reload();
    }
    $("#modalCRUD").modal("hide");  
});

function update(tareaID, opcion, Resolucion){
    
   
        
    console.log("Reso: "+Resolucion +"| Opcion: "+ opcion +"| Tarea ID: "+ tareaID);

            $.ajax({
            url: "bd/kanban.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, tareaID:tareaID, Resolucion:Resolucion},

            success: function(){
                //tablaPersonas.row(fila.parents('tr')).remove().draw();
                //console.log("ENTRO");
                //location.reload();
                //window.location.reload();
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
        window.location.reload();
};





const listCards = document.querySelectorAll('.card');
const lists = document.querySelectorAll('.tasks');

let draggedItem = null;

for (let i = 0; i < listCards.length ; i++){

    const item = listCards[i];

    item.addEventListener('dragstart', function(){
        //console.log('dragstart');
        draggedItem = item;
        setTimeout(function(){
            item.style.display = 'none';
        },0);

    });

    item.addEventListener('dragend', function(){
        //console.log('dragend');

        setTimeout(function(){
            draggedItem.style.display = 'block';
            draggedItem = null;
        },0);
    });

    for( let j  = 0; j< lists.length; j++){
        const list = lists[j];
        list.addEventListener('dragover', function(e){
            e.preventDefault();
        });    
        list.addEventListener('dragenter', function(e){
            e.preventDefault();
        });    
        list.addEventListener('drop', function(e){
            this.append(draggedItem);

            // console.log($(draggedItem.querySelectorAll("#idtarea")).text())

            //console.log($(this.querySelectorAll("#ColumPro")).text());
            
            tareaID =$(draggedItem.querySelectorAll("#idtarea")).text();

            // cambios de texto y color y actualiza BBDD
            var columna =$(this.querySelectorAll("#ColumPro")).text();

            if(columna == "En proceso"){

                console.log(" 2 Proceso")
                $(draggedItem.querySelectorAll(".badge")).css("background-color", "#ffcd02");
                //$(draggedItem.querySelectorAll(".card")).css("border", "#ffcd02");//border: 2px solid red
                $(draggedItem.querySelectorAll(".badge")).text( "Proceso");


                update(tareaID, 2,"");
                
            } else if(columna == "Finalizado") {

                ResolucionF();
                
                $(draggedItem.querySelectorAll(".badge")).css("background-color", "#2dcc70");
                //$(draggedItem.querySelectorAll(".card")).css("border", "#2dcc70");
                $(draggedItem.querySelectorAll(".badge")).text( "Finalizado");
                console.log(" 3 Finalizado ");

                

            }else if(columna == "Pendiente"){
                
                $(draggedItem.querySelectorAll(".badge")).css("background-color", "#e84c3d");
                //$(draggedItem.querySelectorAll(".card")).css("border", "#e84c3d");
                $(draggedItem.querySelectorAll(".badge")).text( "Pendiente");
                console.log(" 1 Pendientes ");

                update(tareaID, 1,"");
                
            }else{
                
                console.log("ERROR en detectar la tabla")
                
            }
            // console.log( $( "#ColumPro" )
            // .contents()
            // .filter(function(){
            //   return this.nodeType !== 1;
            // })
            // .wrap( "<b></b>" ));
            // console.log( $("#ColumPro").text($("h5").text()));

            
            


        });


    }


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
    
    //UserName = $.trim($("#UserName").val());   
    OldPassword = $.trim($("#OldPassword").val());   
    NewPassword = $.trim($("#NewPassword").val());   
    NewPasswordrepeated = $.trim($("#NewPasswordrepeated").val());   
    
    if ( NewPassword == NewPasswordrepeated) {
        if( OldPassword == "" || NewPassword == "" || NewPasswordrepeated == ""){
            
            Swal.fire(
                'Cuidado!',
                'faltan campos por completar!',
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
                            'Exito!',
                            'Se guardaron los cambios!',
                            'success',
                            );
                        $("#modalEditarUsuario").modal("hide");      
                    }else{ 
                        Swal.fire(
                            'Error!',
                            'La contraseña actual es incorrecta!',
                            'error',
                        );
                    }
                },
            });           
        }          
    }else{
        console.log("cuidado")
        Swal.fire(
            'Cuidado!',
            'No reescribio la nueva contraseña correctamente!',
            'warning',
            ).then(() => {
                return;
            });;
    }
    
});  

