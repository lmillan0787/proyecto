<?php require_once './controllers/deportistaControlador.php'; 

$insDeportista = new deportistaControlador();
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Graficos</title>
    <script type="text/javascript" src='<?php echo SERVERURL ?>/views/assets/js/Chart.min.js'></script>
</head>

    <body>
        <canvas id="myChart" width="400" height="200"></canvas>
        <script>
              var ctx = document.getElementById("myChart");
              var myChart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                      labels: [<?php $insDeportista->consultarRegion();?>
                      <?php foreach ($row as $r): 
                      ?>,
                      "<?php echo $r->des_reg; ?>",
                  <?php endforeach; ?>
                      ],
                      datasets: [{
                          label: 'Groups',
                          data: [12, 19, 3]
                      }]
                  }
              });
        </script>
    </body>
</html>