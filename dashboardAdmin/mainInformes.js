$(document).ready(function(){

//////////////////////////////////
//--Script de PAGINA PRINCIPAL--//

    tablaInformeGeneral = $("#tablaInformeGeneral").DataTable({
        "createdRow":function(row,data,index){
            var num = data[7]

            switch(num){
                case 'Pendiente':
                    $('td', row).eq(7).css({
                        'background-color':'#e84c3d',//rojo
                        'color':'white'
                    });
                break;
                case 'Proceso':
                    $('td', row).eq(7).css({
                        'background-color':'#ffcd02',//naranja
                        'color':'white'
                    });
                break;
                case 'Finalizada':
                    $('td', row).eq(7).css({
                        'background-color':'#2dcc70',//verde
                        'color':'white'
                    });
                break;

            }
        },


        "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='d-flex justify-content-center'><button class='btn btn-primary btnDetalles' title='Mostrar mas detalles de la tarea'><i class='fa fa-info-circle' aria-hidden='true'> Info</i></button></div>"  
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
                extend:    'excelHtml5',
                text:      '<i class="fas fa-file-excel"></i> ',
                titleAttr: 'Exportar a Excel',
                className: 'btn btn-success'
                
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fas fa-file-pdf"></i> ',
                titleAttr: 'Exportar a PDF',
                className: 'btn btn-danger'
            },
            {
                extend:    'print',
                text:      '<i class="fa fa-print"></i> ',
                titleAttr: 'Imprimir',
                className: 'btn btn-info'
            },
        ]	        
        
    });

    //copiar en portapapeles

   
    $(document).on("click", ".btnCopiador", function(){

        
          
        var tipologia = document.getElementById('tipologia').innerHTML;
        var estado = document.getElementById('estado').innerHTML;
        var cuadrilla = document.getElementById('cuadrilla').innerHTML;
        var descripcion = document.getElementById('descripcion').innerHTML;
        var resolucion = document.getElementById('resolucion').innerHTML;
        var FechaIni = document.getElementById('FechaIni').innerHTML;
        var FechaFin = document.getElementById('FechaFin').innerHTML;
        var area = document.getElementById('area').innerHTML;
        var jefe = document.getElementById('jefe').innerHTML;
    
        var empleado = document.getElementById('list').innerHTML;
    
        while(empleado.includes("</li>")){
            empleado = empleado.replace('<li>','');
            empleado = empleado.replace('</li>','-');
        };
    
    
        navigator.clipboard.writeText
        (
        "Tipología: "+ tipologia + "\n"+
        "Estado: " +estado + "\n"+
        "Cuadrilla: "+ cuadrilla + "\n"+
        "Empleado/s: " + empleado + "\n"+
        "Descripción: "+ descripcion + "\n"+
        "Resolución: "+ resolucion + "\n"+
        "Fecha inicio: "+ FechaIni + "\n"+
        "Fecha Final: "+ FechaFin + "\n"+
        "Área: " + area + "\n"+
        "Jefe: " + jefe
        )
            .then(() => {
            $("#confCopy").text("Copiado!"); 
        })
            .catch(err => {
            alert("Ocurrio un error al intentar copiar los datos:\n" + err);

        })
        
    
        
    });
   

    //Variables globales 
    var tareaID;
    var minDate, maxDate;
    
    //botón Detalles    
    
    $(document).on("click", ".btnDetalles", function(){
        //$("#formTareas").trigger("reset");
        $("#confCopy").text(""); 

        fila = $(this).closest("tr");
        tareaID = parseInt($(this).closest("tr").find('td:eq(0)').text());
        //Debo Tomar el ID_Tarea
        opci=1;
        //consulta de Ajax
        $.ajax({
            url: "bd/crudInformes.php",
            type: "POST",
            dataType: "json",
            data: {tareaID:tareaID, opci:opci},

            success: function(data){
                //console.log(data);

                tipologia = data[0].Tipologia;            
                estado = data[0].Estados;
                cuadrilla = data[0].Cuadrilla;
                descripcion = data[0].Descripcion;
                resolucion = data[0].Resolucion;
                FechaIni = data[0].Fecha_Ini;
                FechaFin = data[0].Fecha_Fin;
                area = data[0].Area;
                jefe = data[0].Nombre_Jefe;


                switch(estado){
                    case 'Pendiente':
                        $(".modal-header").css("background-color", "#e84c3d");

                        $("#estado").text(estado);
                        $("#estado").css("background-color", "#e84c3d");                       
                        $("#estado").css("color", "white");
                    break;
                    case 'Proceso':
                        $(".modal-header").css("background-color", "#ffcd02");

                        $("#estado").text(estado); 

                        $("#estado").css("background-color", "#ffcd02");
                        $("#estado").css("color", "white");
                    break;
                    case 'Finalizada':
                        $(".modal-header").css("background-color", "#2dcc70");

                        $("#estado").text(estado);  

                        $("#estado").css("background-color", "#2dcc70");
                        $("#estado").css("color", "white");
                    break;
                }   
                
                
                
                if(FechaFin ==null){
                    $("#FechaFin").text("Sin finalizar");
                    $("#FechaFin").addClass("font-weight-bold");
                    $("#FechaFin").css("color", "red");
                }else{
                    $("#FechaFin").text(FechaFin); 
                    $("#FechaFin").removeClass("font-weight-bold");
                    $("#FechaFin").css("color", "#858796");
                }


                if(resolucion == null || resolucion ==''){
                    $("#resolucion").text("No se dió una resolución"); 
                    $("#resolucion").addClass("font-weight-bold");
                    $("#resolucion").css("color", "red");
                }else{
                    $("#resolucion").text(resolucion); 
                    $("#resolucion").removeClass("font-weight-bold");
                    $("#resolucion").css("color", "#858796");
                }

                $("#tipologia").text(tipologia); 
                $("#cuadrilla").text(cuadrilla); 
                $("#descripcion").text(descripcion); 
                $("#FechaIni").text(FechaIni); 
                $("#area").text(area); 
                $("#jefe").text(jefe); 
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
        
        
        
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Detalles");      
        $("#modalCRUD").modal("show");  
        loadNames();
    });

    
    
    //botón Detalles de Cuadrilla  
    //$('#modalCRUD').on('shown.bs.modal', function () {
        
    function loadNames(){
      
    //$(document).on("click", "#btnDetallesCuadrilla", function(){

        $("#list").empty();

        opci=2;     
        $.ajax({
            url: "bd/crudInformes.php",
            type: "POST",
            dataType: "json",
            data: {tareaID:tareaID, opci:opci},

            success: function(data){
                //console.log(data);
                //console.log(data.length);

                
                for (var i = 0; i < data.length; i++) {
                    var ul = document.getElementById("list");
                    var li = document.createElement("li");
                    li.appendChild(document.createTextNode(data[i].nombre));
                    ul.appendChild(li); 
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
        });
    };


    //eventos para mostrar criterios de Busqueda

    $(document).on('change', '#DropDownTipologia', function(){
        Columna = 1;
        var inputValue = $(this).val();

        if(inputValue != '0'){
            tablaInformeGeneral.column(Columna).search(inputValue).draw();
        }
    });

    $(document).on('change', '#DropDownCuadrilla', function(){
        
        Columna = 2;
        var inputValue = $(this).val();
       
        if(inputValue != '0'){
            tablaInformeGeneral.column(Columna).search(inputValue).draw();
        }

    });

    $(document).on('change', '#DropDownEstado', function(){
        
        Columna = 7;
        var inputValue = $(this).val();
       
        if(inputValue != '0'){
            tablaInformeGeneral.column(Columna).search(inputValue).draw();
        }

    });

    

    // Create date inputs
    minDate = new DateTime($('#min'), {
        format: 'MMMM Do YYYY'
    });
    maxDate = new DateTime($('#max'), {
        format: 'MMMM Do YYYY'
    });


    $('#min, #max').on('change', function () {
        tablaInformeGeneral.draw();
    });    

    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            var min = minDate.val();
            var max = maxDate.val();
            var date = new Date( data[5] );
     
            if (
                ( min === null && max === null ) ||
                ( min === null && date <= max ) ||
                ( min <= date   && max === null ) ||
                ( min <= date   && date <= max )
            ) {
                return true;
            }
            return false;
        }
    );

        
    $("#btnLimpiarBusqueda").on("click",function(){

        $("#iptTipologias").val('');
        $("#iptCuadrilla").val('');
        $("#iptEstado").val('');
        $("#iptFechaIni").val('');
        $("#iptFechaFina").val('');

        $("#min").val('');
        $("#max").val('');

        minDate.val('');
        maxDate.val('');


        $("#DropDownTipologia").val(0);
        $("#DropDownCuadrilla").val(0);
        $("#DropDownEstado").val(0);

        tablaInformeGeneral.search('').columns().search('').draw();

    });

});