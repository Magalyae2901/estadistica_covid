<?php include  'dataCovid.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Reto Programacion</title>
    <script src="js/chartjs/Chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
</head>
<body>
    <section class="container pt-5 bg-light">
        <div class="row justify-content-center">
            <div class="col-md-10 shadow-sm p-3 bg-white">
                <code class="text-right d-block">Magaly Ancalle Enriquez</code>
                <h3 id="title" class=" p-2 bg-primary text-white mb-4"> </h3>
                <canvas id="line-chart" width="300" height="150">
                </canvas>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-md-10">
                <table class="table table-striped" id="tableCovid">
                        <thead>
                            <tr>
                            <th scope="col">Fecha</th>
                            <th scope="col">Confirmados</th>
                            <th scope="col">Muertes</th>
                            <th scope="col">Recuperados</th>
                            <th scope="col">Activos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                // Data en arrays para el Chart
                                $confirmed = [];
                                $death = [];
                                $recovered = [];
                                $active = [];
                                $dateCovid = [];
                                
                                foreach($dataCovid as $row){
                                    $lastDate = "";
                                    array_push($confirmed, $row['Confirmed']);
                                    array_push($death, $row['Deaths']);
                                    array_push($recovered, $row['Recovered']);
                                    array_push($active, $row['Active']);
                                    array_push($dateCovid, date("m/d/Y", strtotime($row['Date'])));
                                    $lastDate = date("Y/m/d", strtotime($row['Date']));
                                    echo '<tr>
                                    <td scope="row">'.date("Y/m/d", strtotime($row['Date'])).'</td>
                                    <td>'.$row['Confirmed'].'</td>
                                    <td>'.$row['Deaths'].'</td>
                                    <td>'.$row['Recovered'].'</td>
                                    <td>'.$row['Active'].'</td>
                                    </tr>';
                                }
                            ?>
                        </tbody>
                    </table>
            </div>        
        </div>        

    </section>
    <script type="text/javascript">
        var dateArray = <?php  echo json_encode($dateCovid); ?>;
        var confirmedArray = <?php  echo json_encode($confirmed); ?>;
        var deathArray = <?php  echo json_encode($death); ?>;
        var recoveredArray = <?php  echo json_encode($recovered); ?>;
        var activeArray = <?php  echo json_encode($active); ?>;
        var lastDate =  <?php  echo json_encode($lastDate); ?>
        
        $(document).ready(function() {
            // DataTable para la paginación
            $('#tableCovid').DataTable( {
                "order": [[ 0, "desc" ]],
                "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 d-flex justify-content-end 'f>>" +
                       "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 d-flex justify-content-end'p>>",
                "language": {
                "lengthMenu": "Mostrar registros _MENU_",
                "zeroRecords":"Nothing found - sorry",
                "info":       "Página _PAGE_ de _PAGES_",
                "infoEmpty":  "No records available",
                "infoFiltered": "(filtrado desde _MAX_ total registros)",
                "search":     "Buscar:",
                "paginate": {
                    "first":      "Premier",
                    "previous":   "Anterior",
                    "next":       "Siguiente",
                    "last":       "Dernier"
                },
        }
            } );

            $('#title').text("Casos COVID-19 en Perú al "+lastDate)
        });
        
        // Gráfico estadístico
        new Chart(document.getElementById("line-chart"), {
            type: 'line',
            data: {
                labels: dateArray,
                datasets: [{ 
                    data: confirmedArray,
                    label: "Confirmados",
                    borderColor: "#3e95cd",
                    borderWidth: 0,
                    fill: false
                }, { 
                    data: deathArray,
                    label: "Muertos",
                    borderColor: "#ff0066",
                    fill: false
                }, { 
                    data: recoveredArray,
                    label: "Recuperados",
                    borderColor: "#3cba9f",
                    fill: false
                }, { 
                    data: activeArray,
                    label: "Activos",
                    borderColor: "#ffd11a",
                    fill: false
                }
                ]
            },
            options: {
                responsive: true,
                title: {
                display: false,
                text: ''
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    
</body>
</html>

