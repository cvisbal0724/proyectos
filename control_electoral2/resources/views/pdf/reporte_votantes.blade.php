
   
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css">
    
    .page-break {
        page-break-after: always;
    }

    body{
      font-family: arial;
    }

    table{
      border: 1px solid;

    }

    table thead th{
      font-size: 15px;
       font-family: arial;
    }

    table tbody td{
      font-size: 15px;
      font-family: 'arial';
    }

    .no{width: 10px; text-align: center; }
    .nom{width: 50px; text-align: center; }
    .ced{width: 10px; text-align: center; }
    .dir{width: 10px; text-align: center; }
    .tel{width: 10px; text-align: center; }
    .pvot{width: 10px; text-align: center; }
    .lider{width: 10px; text-align: center; }

    </style>
  

   
     
      <table border="1" cellspacing="0" cellpadding="0" width="100%">
        <thead>
        <tr>
          <th colspan="7" style="padding:15px;font-size:25px;">LISTA DE VOTANTES</th>
        </tr>
          <tr>          
            <th class="no">No</th>
            <th class="nom">NOMBRES Y APELLIDOS</th>
            <th class="ced">CEDULA</th>
            <th class="dir">DIRECCION</th>
            <th class="tel">TELEFONO</th>
            <th class="pvot">PTO VOTACION</th>
            <th class="lider">LIDER</th>          
          </tr>
        </thead>
        <tbody>
       
       <?php for ($i=0; $i < 30; $i++) { ?>

       
         <tr>
            <td class="no">[[ $i+1 ]]</td>
            <td class="nom">[[ $data['description'] ]]</td>
            <td class="ced">[[ $data['price'] ]]</td>
            <td class="dir">[[ $data['total'] ]] </td>
            <td class="tel">1</td>
            <td class="pvot">1</td> 
            <td class="lider">1</td>           
          </tr>
         
      <?php } ?>
         

        </tbody>
        <!--<tfoot>
          <tr>
            <td colspan="2"></td>
            <td >TOTAL</td>
            <td>$6,500.00</td>           
          </tr>
        </tfoot>-->
      </table>


 <div class="page-break"></div>



     