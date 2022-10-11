$(document).ready(function(){
    
});

function update(tareaID, tipo){
    
    opcion = tipo //borrar
        
            $.ajax({
            url: "bd/kanban.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, tareaID:tareaID},

            success: function(){
                //tablaPersonas.row(fila.parents('tr')).remove().draw();
                //console.log("ENTRO");
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
            
            var tareaID =$(draggedItem.querySelectorAll("#idtarea")).text();

            // cambios de texto y color y actualiza BBDD
            var columna =$(this.querySelectorAll("#ColumPro")).text();

            if(columna == "En proceso"){

                console.log(" 2 Proceso")
                $(draggedItem.querySelectorAll(".badge")).css("background-color", "#ffcd02");
                $(draggedItem.querySelectorAll(".badge")).text( "Proceso");


                update(tareaID, 2);
                
            } else if(columna == "Finalizado") {
                
                $(draggedItem.querySelectorAll(".badge")).css("background-color", "#2dcc70");
                $(draggedItem.querySelectorAll(".badge")).text( "Finalizado");
                console.log(" 3 Finalizado ");

                update(tareaID, 3);

            }else if(columna == "Pendiente"){
                
                $(draggedItem.querySelectorAll(".badge")).css("background-color", "#e84c3d");
                $(draggedItem.querySelectorAll(".badge")).text( "Pendiente");
                console.log(" 1 Pendientes ");

                update(tareaID, 1);
                
            }else{
                
                console.log("ERROR ")
                
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


