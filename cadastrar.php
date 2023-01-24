<?php
include_once "conexao.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Filme</title>
    <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>

<?php
    $aviso = '';

    if (!empty($_POST)) {
        $nome_filme = trim(strip_tags($_POST['nome_filme']));
        $nota = '';
        $resenha = trim(strip_tags($_POST['resenha']));
        $favorito = '';
        

        $db = connect();

        if (isset($_POST['nota'])) {
            $nota = $_POST['nota'];
        } else {
            $nota = '';
        }

        if (isset($_POST['favorito'])) {
            $favorito = 1;
        } else {
            $favorito = 0;
        }

        if ($nome_filme === '' || $nota === '') {
            $aviso = "Preencha os campos obrigatórios";
        } else {
            $add_dados = $db->prepare("INSERT INTO avaliacao_de_filmes (nome_filme, nota, resenha, favorito) VALUES (:nome_filme, :nota, :resenha, :favorito)");

            $add_dados->execute(["nome_filme"=>$nome_filme, "nota"=>$nota, "resenha"=>$resenha, "favorito"=>$favorito]);

            header('location:consultar.php');

        }

        $db = null;
    }

?>

<body class="cadastrar">
    <div class="container">
        <div class="row">
            <div class="col main">
                <ul class="nav font-weight-bolder">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="consultar.php">Consultar Filmes</a>
                    </li>
                </ul>
                <div class="card bg-dark text-white text-center border-danger rounded cardpadding my-2">
                    <p class="text-danger"><?=$aviso?></p>
                    <h4>Cadastrar Filme</h4>
                    <form name="cadastrar_filme" action="" method="post">
                        <label for="nome_filme">Nome do Filme</label><br>
                        <input type="text" name="nome_filme" id="nome_filme"><br><br>
                        <div class="nota my-3">
                            <label for="nota">Nota</label>
                            <div class="rate">
                                <input type="radio" id="star5" name="nota" value="5" />
                                <label for="star5" title="Excelente">5 stars</label>
                                <input type="radio" id="star4" name="nota" value="4" />
                                <label for="star4" title="Ótimo">4 stars</label>
                                <input type="radio" id="star3" name="nota" value="3" />
                                <label for="star3" title="Bom">3 stars</label>
                                <input type="radio" id="star2" name="nota" value="2" />
                                <label for="star2" title="Ruim">2 stars</label>
                                <input type="radio" id="star1" name="nota" value="1" />
                                <label for="star1" title="Péssimo">1 star</label>
                            </div>
                        </div><br>
                        <label for="resenha">Resenha</label><br>
                        <textarea name="resenha" id="resenha" cols="30" rows="10" style="padding: 5px;"></textarea><br><br>
                        <label for="favorito">Favorito?</label>
                        <input type="checkbox" name="favorito" id="favorito"><br><br>
                        <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</html>