<?php
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_TIME, 'pt_BR','pt_BR.utf-8','pt_BR.utf-8','portuguese');
include ("conecta.php");
include ("banco-produto.php"); 
?>
<!DOCTYPE html>
<html>
<?php 
$datacontador = date('m');
//Contadores periferico
$contMouse1 = mysqli_query($conexao, "SELECT SUM(quantidade) FROM relatorio WHERE (month(dataregistro) = '".$datacontador."') AND item = 'Mouse USB'");
$contMouse = mysqli_fetch_assoc($contMouse1);

$contTeclado1 = mysqli_query($conexao, "SELECT SUM(quantidade) FROM relatorio WHERE (month(dataregistro) = '".$datacontador."') AND item = 'Teclado USB'");
$contTeclado = mysqli_fetch_assoc($contTeclado1);

$contHead111 = mysqli_query($conexao, "SELECT SUM(quantidade) FROM relatorio WHERE (month(dataregistro) = '".$datacontador."') AND item = 'Headset RJ11'");
$contHead11 = mysqli_fetch_assoc($contHead111);

$contHeadUSB1 = mysqli_query($conexao, "SELECT SUM(quantidade) FROM relatorio WHERE (month(dataregistro) = '".$datacontador."') AND item = 'Headset USB'");
$contHeadUSB = mysqli_fetch_assoc($contHeadUSB1);

$contMonitor1 = mysqli_query($conexao, "SELECT SUM(quantidade) FROM relatorio WHERE (month(dataregistro) = '".$datacontador."') AND item LIKE 'Monitor'");
$contMonitor = mysqli_fetch_assoc($contMonitor1);

//Contadores local
$contPredioo1 = mysqli_query($conexao, "SELECT SUM(quantidade) FROM relatorio WHERE (month(dataregistro) = '".$datacontador."') AND local = 'Predio 1'");
$contPredio1 = mysqli_fetch_assoc($contPredioo1);

$contPredioo2 = mysqli_query($conexao, "SELECT SUM(quantidade) FROM relatorio WHERE (month(dataregistro) = '".$datacontador."') AND local = 'Predio 2'");
$contPredio2 = mysqli_fetch_assoc($contPredioo2);

$contPredioo3 = mysqli_query($conexao, "SELECT SUM(quantidade) FROM relatorio WHERE (month(dataregistro) = '".$datacontador."') AND local = 'Predio 3'");
$contPredio3 = mysqli_fetch_assoc($contPredioo3);

$contPredioo4 = mysqli_query($conexao, "SELECT SUM(quantidade) FROM relatorio WHERE (month(dataregistro) = '".$datacontador."') AND local = 'Predio 4'");
$contPredio4 = mysqli_fetch_assoc($contPredioo4);

$contPredioo5 = mysqli_query($conexao, "SELECT SUM(quantidade) FROM relatorio WHERE (month(dataregistro) = '".$datacontador."') AND local = 'Predio 5'");
$contPredio5 = mysqli_fetch_assoc($contPredioo5);

$contPredioo6 = mysqli_query($conexao, "SELECT SUM(quantidade) FROM relatorio WHERE (month(dataregistro) = '".$datacontador."') AND local = 'Predio 6'");
$contPredio6 = mysqli_fetch_assoc($contPredioo6);

$i=0;
$j=0;

$relatorios10 = listaRelatorios10ultimos($conexao);
$relatorios10E = listaRelatorios10ultimosEntrada($conexao);
$produtos = listaProdutos($conexao); 
$now = new DateTime();
$datetime = $now->format("Y-m-d H:i:s"); 
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sistema Estoque</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <link href="css/style.min.css" rel="stylesheet">
    <link rel="sortcut icon" href="img/icone.ico" type="image/x-icon" />
</head>

<body class="grey lighten-3">

    <header>

        <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
            <div class="container-fluid">

                <a class="navbar-brand waves-effect" href="">
                    <strong class="blue-text">Sistema Estoque</strong>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link waves-effect" href="#">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <!--<li class="nav-item">
                            <a class="nav-link waves-effect" href="https://mdbootstrap.com/material-design-for-bootstrap/" target="_blank">About MDB</a>
                        </li>-->
                        <button type="hidden" id="sucesso" name="sucesso" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#centralModalSuccess" style="visibility: hidden"></button>
                        <button type="hidden" id="erro" name="erro" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#centralModalDanger" style="visibility: hidden"></button>
                    </ul>
                    
                </div>

            </div>
        </nav>

        <div class="sidebar-fixed position-fixed">

            <a class="waves-effect mt-5 mb-3">
                <img src="img/almavivalogo.png" class="img-fluid" alt="" width="100%">
            </a>

            <div class="list-group list-group-flush">
                <a href="estoque.php" class="list-group-item active waves-effect">
                    <i class="fa fa-pie-chart mr-3"></i>Estoque
                </a>
                    <button type="button" class="list-group-item list-group-item-action waves-effect" data-toggle="modal" data-target="#modalLoginAvatarDemo">
                    <i class="fa fa-sign-out mr-3"></i>Registrar Saida</button>
                    <a href="relatorio.php" class="list-group-item list-group-item-action waves-effect">
                    <i class="fa fa-area-chart mr-3"></i>Relatorios</a>
                    <!--<a href="#" class="list-group-item list-group-item-action waves-effect">
                    <i class="fa fa-map mr-3"></i>Maps</a>
                    <a href="#" class="list-group-item list-group-item-action waves-effect">
                    <i class="fa fa-money mr-3"></i>Orders</a>-->                
            </div>
            <div class="text-center" style="position : fixed; bottom:0;">
                <a data-toggle="modal" data-target="#centralModalInfo"><h5 style="font-size: 12px;">Sistema Versão V_1.3.7</h5></a>
            </div>
        </div>
    
    </header>

    <main class="pt-5 mx-lg-5">
        <div class="container-fluid mt-5">

            <div class="card mb-4 wow fadeIn">

                <div class="card-body d-sm-flex justify-content-between">

                    <h4 class="mb-2 mb-sm-0 pt-1">
                        <a href="">Home Page</a>
                        <!--<span>/</span>
                        <span>Dashboard</span>-->
                    </h4>

                </div>

            </div>

            <div class="row wow fadeIn">

                <div class="col-md-9 mb-4">

                    <div class="card">

                        <div class="card-body">
                            <canvas id="myChart"></canvas>
                        </div>

                    </div>

                </div>

                <div class="col-md-3 mb-4">

                    <div class="card mb-1 list-group-item active waves-effect">

                        <div class="text-center">
                            <h5 class="mt-1 mb-0" style="text-transform: capitalize">
                                <?php echo strftime ('%B'); ?>
                            </h5>
                        </div>

                    </div>

                    <div class="card mb-3">

                        <div class="card-body">
                            <h5 class="text-center">Trocados</h5>
                   
                            <div class="list-group list-group-flush">
                                <a class="list-group-item list-group-item-action waves-effect">Mouse USB
                                    <span class="badge badge-primary badge-pill pull-right"><?php echo implode(';',$contMouse); ?></span>
                                </a>
                                <a class="list-group-item list-group-item-action waves-effect">Teclado USB
                                    <span class="badge badge-primary badge-pill pull-right"><?php echo implode(';',$contTeclado); ?></span>
                                </a>
                                <a class="list-group-item list-group-item-action waves-effect">HeadSet RJ11
                                    <span class="badge badge-primary badge-pill pull-right"><?php echo implode(';',$contHead11); ?></span>
                                </a>
                                <a class="list-group-item list-group-item-action waves-effect">HeadSet USB
                                    <span class="badge badge-primary badge-pill pull-right"><?php echo implode(';',$contHeadUSB); ?></span>
                                </a>
                                <a class="list-group-item list-group-item-action waves-effect">Monitor
                                    <span class="badge badge-primary badge-pill pull-right"><?php echo implode(';',$contMonitor); ?></span>
                                </a>
                            </div>

                        </div>
                        
                    </div>

                </div>

            </div>

            <div class="card mb-4 wow fadeIn">

                <div class="card-body d-sm-flex justify-content-between">

                    <h4 class="mb-2 mb-sm-0 pt-1">
                        <a href="">Ultimos Resgistros</a>
                        <!--<span>/</span>
                        <span>Dashboard</span>-->
                    </h4>

                </div>

            </div>

            <div class="row wow fadeIn">

                <div class="col-md-12 mb-12">

                    <div class="card">

                        <div class="card-body">

                            <table class="table table-hover">
                      
                                <thead class="blue-grey lighten-4">
                                    <tr>
                                        <th>#</th>
                                        <th>Item Retirado</th>
                                        <th>Qtd</th>
                                        <th>Motivo</th>
                                        <th>Local</th>
                                        <th>Tecnico</th>
                                        <th>Data Registro</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($relatorios10 as $relatorio) { $i++; 
                                        $datacorreta = date_create($relatorio['dataregistro']);
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $i ?></th>
                                            <td><?= $relatorio['item'] ?></td>
                                            <td>- <?= $relatorio['quantidade'] ?></td>
                                            <td><?= $relatorio['motivo'] ?></td>
                                            <td><?= $relatorio['local'] ?></td>
                                            <td><?= $relatorio['tecnico'] ?></td>
                                            <td><?php echo date_format($datacorreta, 'd/m/Y H:i:s'); ?></td>
                                        </tr>
                                    <?php }?>
                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>
                
            </div>

            <div class="row wow fadeIn mt-3">

                <div class="col-md-12 mb-12">

                    <div class="card">

                        <div class="card-body">

                            <table class="table table-hover">
                    
                                <thead class="blue lighten-4">
                                    <tr>
                                        <th>#</th>
                                        <th>Item Adicionado</th>
                                        <th>Qtd</th>
                                        <th>Motivo</th>
                                        <th>Tecnico</th>
                                        <th>Data Registro</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($relatorios10E as $relatorioE) { $j++; 
                                        $datacorreta = date_create($relatorioE['dataregistro']);
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $j ?></th>
                                            <td><?= $relatorioE['item'] ?></td>
                                            <td>+ <?= $relatorioE['quantidade'] ?></td>
                                            <td><?= $relatorioE['motivo'] ?></td>
                                            <td><?= $relatorioE['tecnico'] ?></td>
                                            <td><?php echo date_format($datacorreta, 'd/m/Y H:i:s'); ?></td>
                                        </tr>
                                    <?php }?>
                                </tbody>
                         
                            </table>

                        </div>

                    </div>

                </div>
                
            </div>

        </div>
        
        <!--Modal Form Login-->
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="modal fade" id="modalLoginAvatarDemo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="mt-5 modal-dialog cascading-modal modal-avatar modal-sm" role="document">
             
                    <div class="modal-content">

                        <div class="modal-body text-center mb-1">

                            <h5 style="font-weight: bold" class="mt-0 mb-2">Registrar Saida</h5>

                            <div class="md-form ml-0 mr-0">
                                <select name="nome" class="form-control ml-0" required>
                                    <option value="" selected>Selecione Item</option>
                                    <?php foreach ($produtos as $produto) { ?>
                                    <option value="<?= $produto['id'] ?>"><?= $produto['nome'] ?></option> 
                                    <?php }?>    
                                </select>
                            </div>

                            <div class="md-form ml-0 mr-0">
                                <input type="number" type="text" name="quantidade" class="form-control ml-0" required>
                                <label for="form1" class="ml-0">Quantidade</label>
                            </div>

                            <div class="md-form ml-0 mr-0">
                                <select name="motivo" class="form-control ml-0" required>
                                    <option value="" selected>Selecione Motivo</option>
                                    <option value="Defeito">Defeito</option>
                                    <option value="Quebrado">Quebrado</option>
                                    <option value="Extravio">Extravio</option>
                                    <option value="Instalação de Novo Item">Instalação de Novo Item</option>    
                                </select>
                            </div>

                            <div class="md-form ml-0 mr-0">
                                <select name="local" class="form-control ml-0" required>
                                    <option value="" selected>Selecione Local</option>
                                    <option value="Predio 1">Predio 1</option>
                                    <option value="Predio 2">Predio 2</option>
                                    <option value="Predio 3">Predio 3</option>
                                    <option value="Predio 4">Predio 4</option>
                                    <option value="Predio 5">Predio 5</option>
                                    <option value="Predio 6">Predio 6</option>
                                    <option value="Predio 7">Predio 7</option>
                                    <option value="Predio 8">Predio 8</option>    
                                </select>
                            </div>

                            <div class="md-form ml-0 mr-0">
                                <select name="tecnico" class="form-control ml-0" required>
                                    <option value="" selected>Selecione Tecnico</option>
                                    <option value="Tecnico 1">Tecnico 1</option>
                                    <option value="Tecnico 2">Tecnico 2</option>
                                    <option value="Tecnico 3">Tecnico 3</option>
                                    <option value="Tecnico 4">Tecnico 4</option>
                                    <option value="Tecnico 5">Tecnico 5</option>
                                    <option value="Tecnico 6">Tecnico 6</option>    
                                </select>
                            </div>

                            <div class="md-form ml-0 mr-0">
                                <input type="number" type="text" name="chamado" class="form-control ml-0" required>
                                <label for="form1" class="ml-0">Chamado</label>
                            </div>

                            <div class="md-form ml-0 mr-0">
                                <input type="text" type="text" name="solicitante" class="form-control ml-0" required>
                                <label for="form1" class="ml-0">Solicitante</label>
                            </div>

                            <tr>
                                <td>
                                    <input type="hidden" name="data" value="<?= $datetime ?>">
                                </td>
                            </tr>

                            <div class="text-center mt-4">
                                <button class="btn btn-cyan" name="enviar" data-toggle="modal" data-target="#myModal">Registrar
                                    <i class="fa fa-sign-in ml-1"></i>
                                </button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <!--Modal Form Login-->
            <!--Modal Success -->
            <div class="modal fade" id="centralModalSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
              aria-hidden="true">
              <div class="modal-dialog modal-notify modal-success" role="document">
              
                <div class="modal-content">
                
                  <div class="modal-header">
                    <p class="heading lead"></p>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <div class="text-center">
                      <i class="fa fa-check fa-4x mb-3 animated rotateIn"></i>
                      <p><h2>Saida Registrada</h2></p>
                    </div>
                  </div>
                </div>

              </div>

            </div>
            <!--Modal Success-->
            <!--Modal Danger-->
            <div class="modal fade" id="centralModalDanger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-notify modal-danger" role="document">
    
                <div class="modal-content">
             
                    <div class="modal-header">
                        <p class="heading lead"></p>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="white-text">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="text-center">
                            <i class="fa fa-close fa-4x mb-3 animated rotateIn"></i>
                        <p><h2>Quantidade não disponivel no Estoque</h2></p>
                        </div>
                    </div>

                </div>
            </div>
            </div>
            <!--Central Modal Danger-->

        </form>        

        <!--Modal Info-->
        <div class="modal fade left show" id="centralModalInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-full-height modal-left modal-notify modal-info" role="document">
            
            <div class="modal-content">
            
            <div class="modal-header">
                <p class="heading lead">Notas de Atualizações</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                <i class="fa fa-edit fa-4x"></i></br></br>
                
                <p> <div style="font-weight: bold;">V_1.3.7</div>
                    Descrição da Atualização.
                </p>
                <p> <div style="font-weight: bold;">V_1.3.6</div>
                    Descrição da Atualização.
                </p>
                <p> <div style="font-weight: bold;">V_1.3.5</div>
                    Descrição da Atualização.
                </p>
                <p> <div style="font-weight: bold;">V_1.2.5</div>
                    Descrição da Atualização.
                </p>
                <p> <div style="font-weight: bold;">V_1.2.4</div>
                    Descrição da Atualização.
                </p>
                <p> <div style="font-weight: bold;">V_1.1.4</div>
                    Descrição da Atualização.
                </p>
                <p> <div style="font-weight: bold;">V_1.1.3</div>
                    Descrição da Atualização.
                </p>
                <p> <div style="font-weight: bold;">V_1.0.3</div>
                    Descrição da Atualização.
                </p>
                <p> <div style="font-weight: bold;">V_1.0.2</div>
                    Descrição da Atualização. 
                </p>
                <p> <div style="font-weight: bold;">V_1.0.1</div>
                    Descrição da Atualização.
                </p>
                <p> <div style="font-weight: bold;">V_1.0.0</div>
                    Versão de Implantação.
                </p>

                </div>
            </div>

            </div>

        </div>
        </div>
        <!--Central Modal Info-->
    </main>

    <footer class="page-footer text-center font-small primary-color-dark darken-2 mt-4 wow fadeIn">

        <hr class="my-4">

        <div class="footer-copyright py-3">
            © 2020 Copyright
            <a href="" target="_blank"> </a>
        </div>

    </footer>

    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Initializations -->
    <script type="text/javascript">
        // Animations initialization
        new WOW().init();
    </script>

    <!-- Charts -->
    <script>

        $('#centralModalSuccess').on('hidden.bs.modal', function(){
                location.href = 'index.php?action=ok';
        });
        
        // Line
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Predio 1", "Predio 2", "Predio 3", "Predio 4", "Predio 5", "Predio 6"],
                datasets: [{
                    label: 'Perifericos Trocados',
                    data: [<?php echo implode(';',$contPredio1); ?>, 
                           <?php echo implode(';',$contPredio2); ?>, 
                           <?php echo implode(';',$contPredio3); ?>, 
                           <?php echo implode(';',$contPredio4); ?>, 
                           <?php echo implode(';',$contPredio5); ?>, 
                           <?php echo implode(';',$contPredio6); ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        //pie
        var ctxP = document.getElementById("pieChart").getContext('2d');
        var myPieChart = new Chart(ctxP, {
            type: 'pie',
            data: {
                datasets: [
                    {
                        data: [300, 50, 100, 40, 120],
                        backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                        hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
                    }
                ]
            },
            options: {
                responsive: true
            }
        });

        //line
        var ctxL = document.getElementById("lineChart").getContext('2d');
        var myLineChart = new Chart(ctxL, {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "My First dataset",
                        fillColor: "rgba(220,220,220,0.2)",
                        strokeColor: "rgba(220,220,220,1)",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [65, 59, 80, 81, 56, 55, 40]
                    },
                    {
                        label: "My Second dataset",
                        fillColor: "rgba(151,187,205,0.2)",
                        strokeColor: "rgba(151,187,205,1)",
                        pointColor: "rgba(151,187,205,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(151,187,205,1)",
                        data: [28, 48, 40, 19, 86, 27, 90]
                    }
                ]
            },
            options: {
                responsive: true
            }
        });

        //radar
        var ctxR = document.getElementById("radarChart").getContext('2d');
        var myRadarChart = new Chart(ctxR, {
            type: 'radar',
            data: {
                labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
                datasets: [
                    {
                        label: "My First dataset",
                        fillColor: "rgba(220,220,220,0.2)",
                        strokeColor: "rgba(220,220,220,1)",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [65, 59, 90, 81, 56, 55, 40]
                    },
                    {
                        label: "My Second dataset",
                        fillColor: "rgba(151,187,205,0.2)",
                        strokeColor: "rgba(151,187,205,1)",
                        pointColor: "rgba(151,187,205,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(151,187,205,1)",
                        data: [28, 48, 40, 19, 96, 27, 100]
                    }
                ]
            },
            options: {
                responsive: true
            }
        });

        //doughnut
        var ctxD = document.getElementById("doughnutChart").getContext('2d');
        var myLineChart = new Chart(ctxD, {
            type: 'doughnut',
            data: {
                labels: ["Red", "Green", "Yellow", "Grey", "Dark Grey"],
                datasets: [
                    {
                        data: [300, 50, 100, 40, 120],
                        backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                        hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
                    }
                ]
            },
            options: {
                responsive: true
            }
        });

    </script>

<?php
if(isset($_POST['enviar'])){
    
    $id = $_POST["nome"];
    $motivo = $_POST["motivo"];
    $chamado = $_POST["chamado"];
    $local = $_POST["local"];
    $solicitante = $_POST["solicitante"];
    $tecnico = $_POST["tecnico"];
    $data = $_POST["data"];
    $quantidader = $_POST["quantidade"];

    $busca = mysqli_query($conexao, "SELECT * FROM produtos WHERE id = $id"); 
    $row = mysqli_fetch_array($busca);

    $unidades = $row['quantidade'];

    $nome = $row['nome'];
    
    if($unidades > 0 and $quantidader <= $unidades and $quantidader > 0){
        if (insereProduto($conexao, $nome, $motivo, $chamado, $local, $solicitante, $tecnico, $data, $quantidader)){
            $atualizado = $unidades - $quantidader;

            $up = "UPDATE produtos SET quantidade= '$atualizado' WHERE id= $id";
            $resultadoAlteracao = mysqli_query($conexao, $up);

            if(mysqli_affected_rows($conexao) > 0){
              "Sucesso: Atualizado corretamente!";
            }else{
              "Aviso: Não foi atualizado!";
            }
            ?>
            <script>
                $('#sucesso').click();
            </script>

        <?php } else{ ?>
            <script>
                $('#erro').click();
            </script>
        <?php }
    }
    else{ ?>
        <script>
            $('#erro').click();
        </script>
    <?php }
    
}
?>
</body>

</html>