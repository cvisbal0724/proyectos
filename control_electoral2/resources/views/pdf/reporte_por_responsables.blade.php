
   
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
    .nom{width: 60px; text-align: center; }
    .ced{width: 50px; text-align: center; }
    .dir{width: 50px; text-align: center; }
    .tel{width: 50px; text-align: center; }
    .pvot{width: 50px; text-align: center; }
    .lider{width: 50px; text-align: center; }

    </style>
  

   
     
      <table border="1" cellspacing="0" cellpadding="0" width="100%">
        <thead>
        <tr>
          <th colspan="5" style="padding:15px;font-size:25px;">VOTOS POR RESPONSABLES</th>
        </tr>
          <tr>          
            <th class="no">No</th>
            <th class="nom">RESPONSABLE</th>
            <th class="ced">TOTAL VOTOS</th>
            <th class="dir">POR VOTAR</th>
            <th class="tel">VOTOS RESGISTRADOS</th>                  
          </tr>
        </thead>
        <tbody>
       
       <?php for ($i=0; $i < count($lista); $i++) { ?>

       
         <tr>
            <td class="no">[[ $i+1 ]]</td>
            <td class="nom">[[ $lista[$i]->responsable ]]</td>
            <td class="ced">[[ $lista[$i]->total_votos ]]</td>
            <td class="dir">[[ $lista[$i]->por_votar ]] </td>
            <td class="tel">[[ $lista[$i]->votos_registrados ]]</td>                     
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



     