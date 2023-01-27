<?php

include_once "conexao.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar</title>
    <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>

<?php
    $db = connect();

    function determinarOrdem() {
        if (!empty($_POST)){
            $ordem = $_POST['ordenar'];
            if ($ordem === "alfaAZ") {
                return "SELECT * FROM avaliacao_de_filmes ORDER BY nome_filme";
            } elseif ($ordem === "alfaZA") {
                return "SELECT * FROM avaliacao_de_filmes ORDER BY nome_filme DESC";
            } elseif ($ordem === "maior") {
                return "SELECT * FROM avaliacao_de_filmes ORDER BY nota DESC";
            } elseif ($ordem === "menor") {
                return "SELECT * FROM avaliacao_de_filmes ORDER BY nota ASC";
            } else {
                return "SELECT * FROM avaliacao_de_filmes";
            }
        } else {
            return "SELECT * FROM avaliacao_de_filmes";
        }
    }
 
    $filmesAssistidos = $db->query(determinarOrdem());
    $filmes = $filmesAssistidos->fetchAll(PDO::FETCH_ASSOC);
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

    function checkFavorito($favorito) {
        if ($favorito == 1) {
            return '✔ Favorito';
        }
    }

    $db = null;

?>
<body class="consultar">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="row justify-content-center font-weight-bolder">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Início</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="cadastrar.php">+ Cadastrar Filmes</a>
                        </li>
                    </ul>
                </div>

                <div class="row text-center">
                    <div class="col text-white">
                        <h1>Filmes Assistidos</h1>
                    </div>
                </div>

                <form action="" method="post">
                    <select class="btn btn-dark text-left" name="ordenar" id="ordenar">
                        <option>Ordenar por:</option>
                        <optgroup label="Alfabético">
                            <option value="alfaAZ">A-Z</option>
                            <option value="alfaZA">Z-A</option>
                        </optgroup>
                        <optgroup label="Nota">
                            <option value="maior">Maior</option>
                            <option value="menor">Menor</option>
                        </optgroup>
                        
                    </select>
                    <input class="btn btn-primary" type="submit" value="Pronto" />
                </form>
                                
                <div id="cards-container" class="row my-3">
                    <?php foreach ($filmes as $filme): ?>
                    <div class="col-sm-12 col-md-6 col-lg-4 my-3">
                        <div class="card bg-dark text-white border-danger">
                            <div class="card-header bg-danger">
                                <div class="row justify-content-around">
                                    <div class="col"><?=estrelas($filme['nota'])?></div>
                                    <div class="col text-right"><?=checkFavorito($filme['favorito'])?></div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?=$filme['nome_filme'];?></h5>
                                <p class="card-text cuzi"><?=$filme['resenha']?></p>
                                <div class="row justify-content-around">
                                    <a href="ler_resenha.php?id=<?=$filme['id']?>" class="btn btn-success">Resenha</a>
                                    <a href="editar.php?id=<?=$filme['id']?>" class="btn btn-primary">Editar</a>
                                    <a href="confirmar_deletar.php?id=<?=$filme['id'];?>" class="btn btn-danger">Deletar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>   
</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</html>