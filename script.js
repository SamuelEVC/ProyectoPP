$('#formLogin').submit(function(e){
   e.preventDefault();
   var usuario = $.trim($("#usuario").val());    
   var password =$.trim($("#password").val());    
    
   if(usuario.length == "" || password == ""){
      Swal.fire({
          type:'warning',
          title:'Debe ingresar un usuario y/o password',
      });
      return false; 
    }else{
        $.ajax({
           url:"bd/login.php",
           type:"POST",
           datatype: "json",
           data: {usuario:usuario, password:password}, 
           success:function(data){  
               //console.log(data);             
               if(data == "null"){
                   Swal.fire({
                       type:'error',
                       title:'Usuario y/o password incorrecta',
                    });
                }else{
                    window.location.href = "dashboardAdmin/index.php";//AQUI SE HACE LA REDIRECCION  
               }
           }    
        });
    }  
    
});

$("#exampleLogin").click(function(){
    let isChecked = $('#exampleLogin')[0].checked
    if(isChecked) {
        $("#password").attr('type', 'text');  
    }else{
        $("#password").attr('type', 'password');      
    }
}); 

