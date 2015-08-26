
   
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

    .no{width: 10px; text-align: center;height: 50px; }
    .nom{width: 60px; text-align: center; height: 50px;}
    .ced{width: 50px; text-align: center; height: 50px;}
    .dir{width: 50px; text-align: center; height: 50px;}
    .tel{width: 50px; text-align: center; height: 50px;}
    .pvot{width: 50px; text-align: center; height: 50px;}
    .lider{width: 50px; text-align: center; height: 50px;}

    </style>
  

   
     
      <table border="1" cellspacing="0" cellpadding="0" width="100%">
        <thead>
        <tr>
          <th colspan="6" style="padding:15px;font-size:25px;">VOTOS POR PARTIDOS</th>
        </tr>
          <tr>          
            <th class="no">No</th>
            <th>LOGO</th>
            <th class="nom">PARTIDO</th>
            <th class="ced">TOTAL VOTOS</th>
            <th class="dir">POR VOTAR</th>
            <th class="tel">VOTOS RESGISTRADOS</th>                  
          </tr>
        </thead>
        <tbody>
       
       <?php for ($i=0; $i < count($lista); $i++) { ?>

       
         <tr>
            <td class="no">[[ $i+1 ]]</td>
            <td class="no"><img width="30" src="app_cliente/logos_partido/[[ $lista[$i]->logo ]]"></td>
            <td class="nom">[[ $lista[$i]->partido ]]</td>
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



     