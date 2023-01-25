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

    if (!empty($_GET)) {
        $filme_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $db = connect();

        $dados_existentes = $db->prepare("SELECT * FROM avaliacao_de_filmes WHERE id = :id");
        $dados_existentes->execute(["id"=>$filme_id]);
        $dados = $dados_existentes->fetch(PDO::FETCH_ASSOC);

        $db = null;
    }

    $aviso = '';
    if (!empty($_POST)) {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
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
            $aviso = "Indique o nome do filme e a nota";
        } else {
            $edit_dados = $db->prepare("UPDATE avaliacao_de_filmes SET nome_filme = :nome_filme, nota = :nota, resenha = :resenha, favorito = :favorito WHERE id = :id");

            $edit_dados->execute(["nome_filme"=>$nome_filme, "nota"=>$nota, "resenha"=>$resenha, "favorito"=>$favorito, "id"=>$id]);

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
                        <a class="nav-link active" href="cadastrar.php">+ Cadastrar Filmes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="consultar.php">Consultar Filmes</a>
                    </li>
                </ul>
                <div class="card bg-dark text-white text-center border-danger rounded cardpadding my-2">
                    <p class="text-danger"><?=$aviso?></p>
                    <h4>Editar Filme</h4>
                    <form name="cadastrar_filme" action="" method="post">
                        <input type="hidden" name="id" value="<?=$dados['id']?>">
                        <div class="row justify-content-center"><label for="nome_filme">Nome do Filme</label></div>
                        <div class="row justify-content-center"><input type="text" name="nome_filme" id="nome_filme" value="<?=$dados['nome_filme']?>"></div>
                        <div class="nota my-3">
                            <label for="nota">Nota</label>
                            <div class="rate">
                                <input type="radio" id="star5" name="nota" value="5" <?php if ($dados['nota'] === '5') {echo 'checked';}?> />
                                <label for="star5" title="Excelente">5 stars</label>
                                <input type="radio" id="star4" name="nota" value="4" <?php if ($dados['nota'] === '4') {echo 'checked';}?> />
                                <label for="star4" title="Ótimo">4 stars</label>
                                <input type="radio" id="star3" name="nota" value="3" <?php if ($dados['nota'] === '3') {echo 'checked';}?> />
                                <label for="star3" title="Bom">3 stars</label>
                                <input type="radio" id="star2" name="nota" value="2" <?php if ($dados['nota'] === '2') {echo 'checked';}?> />
                                <label for="star2" title="Ruim">2 stars</label>
                                <input type="radio" id="star1" name="nota" value="1" <?php if ($dados['nota'] === '1') {echo 'checked';}?> />
                                <label for="star1" title="Péssimo">1 star</label>
                            </div>
                        </div>
                        <div class="row"><label for="resenha">Resenha</label></div>
                        <div class="row"><textarea name="resenha" id="resenha" cols="30" rows="10" style="padding: 5px;"><?=$dados['resenha']?></textarea></div>
                        <div class="row justify-content-center my-5">
                            <div class="col text-right"><label for="favorito">Favorito?</label></div>
                            <div class="col"><input type="checkbox" name="favorito" id="favorito" <?php if ($dados['favorito'] == 1) {echo 'checked';}?>></div>
                        </div>
                        <input type="submit" name="cadastrar" value="Finalizar" class="btn btn-danger">
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