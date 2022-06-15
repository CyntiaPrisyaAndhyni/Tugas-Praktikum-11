<?php
include('koneksi.php');
$label=
["India","S. Korea","Turkey","Vietnam","Japan","Iran","Indonesia","Malaysia","Thailand","Israel"];

for($id=1; $id<13; $id++)
{
    $query=mysqli_query($koneksi,"select sum(total_recovered) as total_recovered from datacovid where 
    id='$id'");
    $row = $query->fetch_array();
    $total_recovered[]=$row['total_recovered'];

}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>total  recovered</title>
        <script type="text/javascript" src="Chart.js"></script>
    </head>
    <body>
    <a href="menu1.html">kembali</a>

        <div style="width:800px ; height:800px">
            <canvas id="myChart"></canvas>
    </div>
    
    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels:<?php echo json_encode($label);?>,
                datasets: [{
                    label: 'Grafik Bar Covid',
                    data:<?php echo json_encode($total_recovered);?>,
            
                    backgroundColor: 'rgba(255,99,135,0.2)',
                    borderColor: 1,
                    borderWidth:1
                }]
            },
            options:{
                scales:{
                    yAxes:[{
                        ticks:{
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    </script>
</body>
</html>