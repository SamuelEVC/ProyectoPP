$('#formLogin').submit(function(e){
   e.preventDefault();
   var usuario = $.trim($("#usuario").val());    
   var password = $.trim($("#password").val());    
    
   if(usuario.length == "" || password == ""){
      Swal.fire({
          type:'warning',
          title:'Debe ingresar un usuario y/o contraseña',
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
                
                //console.log("El usuario tiene: "+ obj[0].Habilitado); 
                          
                if(data == "null"){
                   Swal.fire({
                       type:'error',
                       title:'Usuario y/o contraseña incorrecta',
                    });

                }else{
                    var obj = JSON.parse(data);

                    UsuHabili = obj[0].Habilitado;
                    nombreUsu = obj[0].nombreUsuario;
                    if(UsuHabili == 1){
                        window.location.href = "dashboardAdmin/index.php";//AQUI SE HACE LA REDIRECCION  

                    }else if(UsuHabili == 2){
                        //alert("este usuario se encuantra deshabilitado");

                        Swal.fire({
                            type:'error',
                            title:'Usuario deshabilitado',
                            text:
                                'El usuario ' +nombreUsu+ ', ' +
                                'se encuentra deshabilitado, ' +
                                'contacte con el superior.',
                        }).then(() => {
                            $.ajax({
                                url:"bd/logout.php",
                                type:"POST",
                                datatype: "json",
                                data: {}, 
                            });
                        });

                        
                    }
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

