<?php

include_once "conexao.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resenha</title>
    <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<?php
    if (!empty($_GET)) {
        $id = $_GET['id'];

        $db = connect();

        $resenha_filme = $db->prepare("SELECT nome_filme, resenha, nota FROM avaliacao_de_filmes WHERE id = :id");
        $resenha_filme->execute(["id"=>$id]);
        $resenha = $resenha_filme->fetch(PDO::FETCH_ASSOC);

        function estrelas($nota) {
            switch ($nota) {
                case '5':
                    return '⭐⭐⭐⭐⭐';
                    break;
                case '4':
                    return '⭐⭐⭐⭐';
                    break;
                case '3':
                    return '⭐⭐⭐';
                    break;
                case '2':
                    return '⭐⭐';
                    break;
                case '1':
                    return '⭐';
                    break;
            }
    
        } 

        $db = null;
    }

?>
<body class="resenha">

<body class="cadastrar">   
    <div class="container">
        <div class="row">
            <div class="col main">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="cadastrar.php">+ Cadastrar Filmes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="consultar.php">Consultar Filmes</a>
                    </li>
                </ul>
                <div class="card text-center border-danger" style="width: 60vw">
                    <div class="card-header bg-danger text-white">
                        <h1>Resenha de <?php print_r($resenha['nome_filme'])?></h1>
                    </div>
                    <div class="card-body text-center" style="height: 70vh">
                        <p class="card-text overflow-auto" style="height: 65vh"><?php print_r($resenha['resenha'])?></p>
                    </div>
                    <div class="card-footer text-muted text-center bg-danger">
                        <?=estrelas($resenha['nota'])?>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</body>
</html>