
function llenarLista(data){
    var lista=[];

     ko.utils.arrayForEach(data, function(row) {

        var listaProd=[];

        ko.utils.arrayForEach(row.productos, function(row) {
            listaProd.push({
            id:ko.observable(row.id),
            categoria:ko.observable(row.categoria), 
            unidadmedida:ko.observable(row.unidad),
            nombre:ko.observable(row.nombre),
            descripcion:ko.observable(row.descripcion),
            precio:ko.observable(row.precio),
            cantidad:ko.observable(1),
            });
         });  

        lista.push({id_categoria:row.id_categoria,categoria:row.categoria,listaProd:listaProd});

      });

    return lista;
}

function productoProveedor(){

	
    var self=this;

    self.listaProductos=ko.observableArray([]);

    var idcategoria=$('#idcategoria').val();

    if (idcategoria === '0') {
		$.ajax({
            type: "POST", 
            url: 'productoproveedor/obtenerinicio',      
            //data:self.personaVO,
            dataType: 'json',   
            beforeSend:function(){
             
            },
            success: function (data) {  

            	self.listaProductos(llenarLista(data));                
            },
            complete:function(){
              //alert('lkdjflksdf');
            }
        });

  }else{

    $.ajax({
            type: "POST", 
            url: '../productoproveedor/obtenerporcategoria',      
            data:{id_categoria: idcategoria},
            dataType: 'json',   
            beforeSend:function(){
             
            },
            success: function (data) {  

                self.listaProductos(llenarLista(data));                
            },
            complete:function(){
              //alert('lkdjflksdf');
            }
        });

  }

      

}

ko.applyBindings(new productoProveedor);