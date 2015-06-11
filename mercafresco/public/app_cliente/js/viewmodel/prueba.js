$(document).ready(function(){

	$.ajax({
            type: "POST", 
            url: 'usuario/obtenertodos',      
            //data:self.personaVO,
            dataType: 'json',   
            beforeSend:function(){
             
            },
            success: function (data) {     
            	
            },
            complete:function(){
              
            }
             }).done(function(msg) {
                
                if (msg==='true') {
                  alert('Registro guardado satisfactoriamnete.');
                self.nuevo();
                self.obtener();
          }else{
            alert('error');
          }
                
          }); 	

});