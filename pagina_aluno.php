<?php

require_once("../includes/Conectar.php");
    
 //inicia a sessão
session_start();

//teste de login
    if(!isset($_SESSION["user"])){
      header("location: index.php");
    }
//fim do teste de login

    //Inicializando o carrinho vazio
    if(!isset($_SESSION['carrinho'])){ 
        $_SESSION['carrinho'] = array(); 
    }
   
?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link href="../tmp/pagina_aluno.css" rel="stylesheet" />
    <meta charset="utf-8" />
    <title>Sistema Integrado da SIEEL</title>
</head>

<body>

    <header>
        <?php require_once("../includes/cabecalho.php"); ?>
    </header>

<?php require_once("../includes/consulta_eventos.php"); ?>
    

<?php require_once("../includes/consulta_produtos.php"); ?>
    
<?php  require_once("../includes/anotar_pedido.php");?>


</body>
</html>