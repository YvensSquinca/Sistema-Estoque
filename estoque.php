<?php
date_default_timezone_set('America/Sao_Paulo');
include ("conecta.php");
include ("banco-produto.php"); 
?>
<!DOCTYPE html>
<html>
<?php
$produtos = listaProdutos($conexao); 
$now = new DateTime();
$datetime = $now->format("Y-m-d H:i:s");  
 
$vtecladousb = mysqli_query($conexao, "select quantidade from produtos where id=1");
$vmouseusb = mysqli_query($conexao, "select quantidade from produtos where id=2");
$vheadsetusb = mysqli_query($conexao, "select quantidade from produtos where id=3");
$vheadsetrj = mysqli_query($conexao, "select quantidade from produtos where id=4");
    
$tecladousb = mysqli_fetch_array($vtecladousb);
$mouseusb = mysqli_fetch_array($vmouseusb);
$headsetusb = mysqli_fetch_array($vheadsetusb);
$headsetrj = mysqli_fetch_array($vheadsetrj);
    
$quantidadetecladousb = $tecladousb["quantidade"];
$quantidademouseusb = $mouseusb["quantidade"];
$quantidadeheadsetusb = $headsetusb["quantidade"];
$quantidadeheadsetrj = $headsetrj["quantidade"];
    
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

                <a class="navbar-brand waves-effect" href="index.php">
                    <strong class="blue-text">Sistema Estoque</strong>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link waves-effect" href="index.php">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <button type="hidden" id="sucesso" name="sucesso" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#centralModalSuccess" style="visibility: hidden"></button>
                        <button type="hidden" id="erro" name="erro" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#centralModalDanger" style="visibility: hidden"></button>
                        <button type="hidden" id="sucesso1" name="sucesso1" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#centralModalSuccess1" style="visibility: hidden"></button>
                        <button type="hidden" id="erro1" name="erro1" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#centralModalDanger1" style="visibility: hidden"></button>
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
                    <div class="text-center" style="position : fixed; bottom:0;">
                    <a data-toggle="modal" data-target="#centralModalInfo"><h5 style="font-size: 12px;">Sistema Versão V_1.3.7</h5></a>
                    </div>
            </div>

        </div>

    </header>

    <main class="pt-5 mx-lg-5">
        <div class="container-fluid mt-5">

            <div class="card mb-4 wow fadeIn">

                <div class="card-body d-sm-flex justify-content-between">

                    <h4 class="mb-2 mb-sm-0 pt-1">
                        <a href="">Estoque</a>
                    </h4>
                    <a class="mt-2 text-center" style="font-size: 15px;" data-toggle="modal" data-target="#modalLoginAvatarDemo1">
                        + Adicionar no Estoque
                    </a>
                </div>

            </div>

            <div class="row wow fadeIn">

                <div class="col-md-12 mb-4">

                    <div class="card">

                        <div class="card-body">

                            <canvas id="pieChart"></canvas>

                        </div>

                    </div>

                </div>

            </div>

            <div class="row wow fadeIn">

                <div class="col-md-12 mb-4">

                    <div class="card">

                        <div class="card-body">

                            <table class="table table-hover">
                                
                                <thead class="blue-grey lighten-4">
                                    <tr>
                                        <th class="text-center">Itens</th>
                                        <th class="text-center">Quantidade</th>
                                    </tr>
                                </thead>
                                
                                <?php foreach ($produtos as $produto) { ?>
                                
                                <tbody>
                                    <tr>
                                        <td class="text-center"><?= $produto['nome'] ?></td>
                                        <td class="text-center"><?= $produto['quantidade'] ?></td>
                                    </tr>
                                </tbody>
                                <?php }?>    
                                
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
            <!-- Modal Success -->
            <div class="modal fade" id="centralModalSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
              aria-hidden="true">
              <div class="modal-dialog modal-notify modal-success" role="document">
                
                <div class="modal-content">
                  
                  <div class="modal-header">
                    <p class="heading lead">Modal Success</p>

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
            
        </form>

    <!--Modal Form Login-->
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="modal fade" id="modalLoginAvatarDemo1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="mt-5 modal-dialog cascading-modal modal-avatar modal-sm" role="document">
                    
                    <div class="modal-content">

                        <div class="modal-body text-center mb-1">

                            <h5 style="font-weight: bold" class="mt-0 mb-2">Adicionar Item</h5>

                            <div class="md-form ml-0 mr-0">
                                <select name="nome1" class="form-control ml-0" required>
                                    <option value="" selected>Selecione Item</option>
                                    <?php foreach ($produtos as $produto) { ?>
                                    <option value="<?= $produto['id'] ?>"><?= $produto['nome'] ?></option> 
                                    <?php }?>    
                                </select>
                            </div>

                            <div class="md-form ml-0 mr-0">
                                <input type="number" type="text" name="quantidade1" class="form-control ml-0" required>
                                <label for="form1" class="ml-0">Quantidade</label>
                            </div>

                            <div class="md-form ml-0 mr-0">
                                <select name="motivo1" class="form-control ml-0" required>
                                    <option value="" selected>Selecione Motivo</option>
                                    <option value="Recuperado">Recuperado</option>
                                    <option value="Reparado">Reparado</option>
                                    <option value="Item Novo">Item Novo</option>    
                                </select>
                            </div>
                            <div class="md-form ml-0 mr-0">
                                <select name="tecnico1" class="form-control ml-0" required>
                                    <option value="" selected>Selecione Tecnico</option>
                                    <option value="Tecnico 1">Tecnico 1</option>
                                    <option value="Tecnico 2">Tecnico 2</option>
                                    <option value="Tecnico 3">Tecnico 3</option>
                                    <option value="Tecnico 4">Tecnico 4</option>
                                    <option value="Tecnico 5">Tecnico 5</option>
                                    <option value="Tecnico 6">Tecnico 6</option>  
                                </select>
                            </div>
                            <tr>
                                <td>
                                    <input type="hidden" name="data1" value="<?= $datetime ?>">
                                </td>
                            </tr>
                            <div class="text-center mt-4">
                                <button class="btn btn-cyan" name="enviar1" data-toggle="modal" data-target="#myModal">Adicionar
                                    <i class="fa fa-sign-in ml-1"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                   
                </div>
            </div>
            <!--Modal Form Login-->
            <!--Modal Success-->
            <div class="modal fade" id="centralModalSuccess1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
              aria-hidden="true">
              <div class="modal-dialog modal-notify modal-success" role="document">
               
                <div class="modal-content">
                 
                  <div class="modal-header">
                    <p class="heading lead">Modal Success</p>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <div class="text-center">
                      <i class="fa fa-check fa-4x mb-3 animated rotateIn"></i>
                      <p><h2>Item Adicionado</h2></p>
                    </div>
                  </div>
                </div>
             
              </div>
            </div>
            <!--Modal Success-->
            <!--Modal Danger-->
            <div class="modal fade" id="centralModalDanger1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                            <p><h2>Impossivel adicionar 0 Itens</h2></p>
                        </div>
                    </div>

                </div>
               
            </div>
            </div>
            <!--Modal Danger-->
        </form>
        <!--Modal Info-->
        <div class="modal fade left show" id="centralModalInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
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
        <!--Modal Info-->
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
    <script language="javascript">

    $('#centralModalSuccess').on('hidden.bs.modal', function(){
        location.href = 'estoque.php?action=ok';
    });

    $('#centralModalSuccess1').on('hidden.bs.modal', function(){
        location.href = 'estoque.php?action=ok';
    });

    var tecladousb = "<?php print $quantidadetecladousb; ?>";
    var mouseusb = "<?php print $quantidademouseusb; ?>";
    var headsetusb = "<?php print $quantidadeheadsetusb; ?>";
    var headsetrj = "<?php print $quantidadeheadsetrj; ?>";
    //pie
    var ctxP = document.getElementById("pieChart").getContext('2d');
    var myPieChart = new Chart(ctxP, {
        type: 'pie',
        data: {
            labels: ["Mouse USB", "Teclado USB", "HeadSet RJ11", "HeadSet USB"],
            datasets: [
                {
                    data: [mouseusb, tecladousb, headsetrj, headsetusb],
                    backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1"],
                    hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5"]
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
    
};
if(isset($_POST['enviar1'])){
    
    $id = $_POST["nome1"];
    $motivo = $_POST["motivo1"];
    $tecnico = $_POST["tecnico1"];
    $data = $_POST["data1"];
    $quantidader = $_POST["quantidade1"];

    $busca = mysqli_query($conexao, "SELECT * FROM produtos WHERE id = $id"); 
    $row = mysqli_fetch_array($busca);

    $unidades = $row['quantidade'];

    $nome = $row['nome'];
    
    if($quantidader > 0){
        if (insereProduto1($conexao, $nome, $motivo, $tecnico, $data, $quantidader)){
            $atualizado = $unidades + $quantidader;

            $up = "UPDATE produtos SET quantidade= '$atualizado' WHERE id= $id";
            $resultadoAlteracao = mysqli_query($conexao, $up);

            ?>
            <script>
                $('#sucesso1').click();
            </script>

        <?php } else{ ?>
            <script>
                $('#erro1').click();
            </script>
        <?php }
    }
    else{ ?>
        <script>
            $('#erro1').click();
        </script>
    <?php }
}
?>
</body>

</html>