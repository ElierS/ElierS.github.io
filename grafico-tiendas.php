<?php
$con=mysql_connect("localhost","root","root") or die("Failed to connect with database!!!!");
mysql_select_db("concurso", $con); 

$sth = mysql_query("SELECT COUNT( id_tienda ) AS cantidad, nombre_tienda\n"
    . "FROM tb_usuarios, tb_tienda\n"
    . "WHERE tb_usuarios.id_tienda = tb_tienda.id\n"
    . "GROUP BY nombre_tienda LIMIT 0, 30 ");

$rows = array();
$flag = true;
$table = array();
$table['cols'] = array(

    array('label' => 'nombre_tienda', 'type' => 'string'),
    array('label' => 'cantidad', 'type' => 'number')

);

$rows = array();
while($r = mysql_fetch_assoc($sth)) {
    $temp = array();
    $temp[] = array('v' => (string) $r['nombre_tienda']); 

    $temp[] = array('v' => (int) $r['cantidad']); 
    $rows[] = array('c' => $temp);
}

$table['rows'] = $rows;
$jsonTable = json_encode($table);
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript">

    google.load('visualization', '1', {'packages':['corechart']});

    google.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable(<?=$jsonTable?>);
      var options = {
           title: 'Cantidad de usuarios por tienda',
          is3D: 'true',
          width: 800,
          height: 400
        };

      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
    </script>
  </head>
  <body class="mantenimiento">
    <div id="base">
      <?php include 'menu.php'; ?>
      <br/>
      <br/>
      <div id="chart_div"></div>
      <br/>
      <p><button type="button" onclick="history.back()">Regresar</button></p>
    </div>
  </body>
</html>