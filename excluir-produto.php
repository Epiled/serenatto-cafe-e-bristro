<?php

require "src/conexao-db.php";
require "src/Modelos/Produto.php";
require "src/Repositorio/ProdutoRepositorio.php";

$produtosRepositorios = new ProdutoRepositorio($pdo);

$produtosRepositorios->deletar($_POST['id']);

header("Location: admin.php");