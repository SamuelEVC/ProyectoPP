$(document).ready(function(){
    
   

    // dragula([left, right]).on('drag', function (el) {

    //    //el.className = el.className.replace(' animazing', '');

    //    console.log("lOOL");
    //   }).on('drop', function (el) {

    //     // setTimeout(function () {
    //     //   el.className += ' animazing';

    //     // }, 0);
    //     console.log("XD");
    //   });   


});



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
           
            

            //console.log($(this.querySelectorAll("#ColumPro")).text());

            var columna =$(this.querySelectorAll("#ColumPro")).text();

            if(columna == "En proceso"){

                console.log(" 2 Proceso")
                $(draggedItem.querySelectorAll(".badge")).css("background-color", "#ffcd02");
                $(draggedItem.querySelectorAll(".badge")).text( "Proceso");
                
            } else if(columna == "Finalizado") {
                
                $(draggedItem.querySelectorAll(".badge")).css("background-color", "#2dcc70");
                $(draggedItem.querySelectorAll(".badge")).text( "Finalizado");
                console.log(" 3 Finalizado ")

            }else if(columna == "Pendiente"){
                
                $(draggedItem.querySelectorAll(".badge")).css("background-color", "#e84c3d");
                $(draggedItem.querySelectorAll(".badge")).text( "Pendiente");
                console.log(" 1 Pendientes ")
                
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


