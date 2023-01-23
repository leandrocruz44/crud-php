<?php

include_once "conexao.php";



if (!empty($_GET)) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $db = connect();

    $deletar_filme = $db->prepare("DELETE FROM avaliacao_de_filmes WHERE id = :id");
    $deletar_filme->execute(["id"=>$id]);

    $db = null;

    header('location:consultar.php');
}






