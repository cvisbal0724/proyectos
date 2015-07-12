<div class="col-lg-12">
 <div class="form-panel">  
   <h4 class="mb"><i class="fa fa-angle-right"></i> 
   Exportar PDF
   </h4>

       <div class="panel-body">
      	<div class="col-lg-6">

        <div class="panel panel-default">
       <div class="panel-heading">
          Filtros
       </div>  

       <div class="panel-body"> 

         
        <div class="form-group">
        <label>Lider</label>
        <select class="form-control"></select>
        </div>  


         <div class="form-group">
        <label>Concejal</label>
        <select class="form-control"></select>
        </div>   

       </div>     
            

      	</div>


        <div class="col-lg-12">
          
           <div class="alert alert-{{result.alert}} alert-dismissable" ng-show='result.show'>
                                <button type="button" class="close" aria-hidden="true" ng-click='result.show=false'>&times;</button>
                               {{result.msg}}
             </div>
            
       <button type="button" class="btn btn-warning">Exportar PDF</button> 
       
        </div>
      </div>

 </div>
</div>

