<?php
include('koneksi.php');
$label=
["India","S. Korea","Turkey","Vietnam","Japan","Iran","Indonesia","Malaysia","Thailand","Israel"];

for($id=1; $id<13; $id++)
{
    $query=mysqli_query($koneksi,"select sum(total_deaths) as total_deaths from datacovid where 
    id='$id'");
    $row = $query->fetch_array();
    $total_deaths[]=$row['total_deaths'];
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Membuat Grafik Menggunakan Chart JS</title>
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
                    label: 'Grafik Bar Covid Total Deaths',
                    data:<?php echo json_encode($total_deaths);?>,
            
                    backgroundColor: 'rgba(102, 51, 153,0.2)',
                    borderColor:'rgba(102, 51, 153,1)',
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