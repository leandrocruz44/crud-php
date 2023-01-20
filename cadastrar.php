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
    <?php echo '<link rel="stylesheet" type="text/css" href="style.css" media="screen" />';?>
</head>
<body>
    <a href="index.php">Início</a>
    <a href="consultar.php">Consultar Filmes</a>
    <h1>Cadastrar Filme</h1>
    <?php
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
                $favorito = "sim";
            } else {
                $favorito = "nao";
            }

            if ($nome_filme === '' || $nota === '') {
                echo "Você deve preencher os campos obrigatórios para cadastrar o filme<br><br><br>";
            } else {
                $add_dados = $db->prepare("INSERT INTO avaliacao_de_filmes (nome_filme, nota, resenha, favorito) VALUES (:nome_filme, :nota, :resenha, :favorito)");

                $add_dados->execute(["nome_filme"=>$nome_filme, "nota"=>$nota, "resenha"=>$resenha, "favorito"=>$favorito]);

                if ($add_dados->rowCount()) {
                    echo "Filme cadastrado com sucesso! <br><br><br>";
                } else {
                    echo "ERRO - Filme não cadastrado. <br><br><br>";
                }
            }


            $db = null;
        }

    ?>
    
    <form name="cadastrar_filme" action="" method="post">
        <label for="nome_filme">Nome do Filme</label><br>
        <input type="text" name="nome_filme" id="nome_filme"><br><br>

        <label for="nota">Nota</label><br>
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
        </div><br><br><br><br>

        <label for="resenha">Resenha</label><br>
        <textarea name="resenha" id="resenha" cols="30" rows="10"></textarea><br><br>

        <label for="favorito">Favorito?</label>
        <input type="checkbox" name="favorito" id="favorito"><br><br>

        <input type="submit" name="cadastrar" value="Cadastrar">
    </form>
</body>
</html>