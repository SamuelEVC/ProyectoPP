$(function(){

$("p").css({"background-color":"black"});
$("p").css({"color":"white"});

$("#btn-color").click(function(){

    $("p").css({"background-color":"white"});
    $("p").css({"color":"black"});
})

$("#btn-hideShow").click(function(){

    $("p").slideUp();
    $("#btn-hideShow").text("Mostrar")

})

$("#btn-hideShow").dblclick(function(){

    $("p").slideDown();
    $("#btn-hideShow").text("Esconder")

})

$("#btn-newP").click(function(){

    $("#Primero").after("<p> Hola <strong> Programadores</strong></p>");

})

})
