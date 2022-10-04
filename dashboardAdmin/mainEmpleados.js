$(document).ready(function(){
    

    //console.log("Hello word");


    $("li").click(function() {
        $("li").removeClass("active");
        $(this).addClass("active");
      });

    $("#btnNuevoEmpleado").click(function(){
        $("#formTareas").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nuevo Empleado");            
        $("#modalCRUD").modal("show");        
        id=null;
        opci = 1; //alta
    }); 



    $("#btnNuevaCuadrilla").click(function(){
        $("#formTareas").trigger("reset");
        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nueva Cuadrilla");            
        $("#modalCRUD").modal("show");        
        id=null;
        opci = 1; //alta
    }); 
});