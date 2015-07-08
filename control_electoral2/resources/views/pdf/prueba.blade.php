<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Example 2</title>
    <style type="text/css">

    body{
      font-family: arial;
    }

    table{
      border: 1px solid;

    }

    table th{
      font-size: 15px;
    }

    table td{
      font-size: 11px;
    }

    
    </style>
  </head>
  <body>

    <main>
      <div id="details" class="clearfix">
        <div id="invoice">
          <h1>INVOICE [[ $invoice ]]</h1>
          <div class="date">Date of Invoice: [[ $date ]]</div>
        </div>
      </div>
      <table border="1" cellspacing="0" cellpadding="0" >
        <thead>
        <tr>
          <th colspan="7" style="padding:10px;">LISTA DE VOTANTES</th>
        </tr>
          <tr>          
            <th class="no">No</th>
            <th class="desc" style="20%;">NOMBRES Y APELLIDOS COMPLETOS</th>
            <th class="unit">CEDULA</th>
            <th class="total">DIRECCION</th>
            <th class="total">PTO VOTACION</th>
            <th class="total">LIDER</th>          
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="no">[[ $data['quantity'] ]]</td>
            <td class="desc">[[ $data['description'] ]]</td>
            <td class="unit">[[ $data['price'] ]]</td>
            <td class="total">[[ $data['total'] ]] </td>
            <td>1</td>
            <td>1</td>           
          </tr>

        </tbody>
        <!--<tfoot>
          <tr>
            <td colspan="2"></td>
            <td >TOTAL</td>
            <td>$6,500.00</td>           
          </tr>
        </tfoot>-->
      </table>
  </body>
</html>