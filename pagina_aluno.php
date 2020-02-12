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
    <meta charset="utf-8" />
    <title>Sistema Integrado da SIEEL</title>

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <link href="../includes/estilo_abas.css" rel="stylesheet" />
   
</head>

<script type="text/javascript">
      //$(document).ready(function () {
        //      $("#content div:nth-child(1)").show();
          //    $(".abas li:first div").addClass("selected");
            //  $(".aba").click(function () {
              //$(".aba").removeClass("selected");
              //$(this).addClass("selected");
              //var indice = $(this).parent().index();
              //indice++;
              //$("#content div").hide();
              //$("#content div:nth-child(" + indice + ")").show();
     
    //    });
 
      //  $(".aba").hover(
        //             function () { $(this).addClass("ativa") },
          //  function () { $(this).removeClass("ativa") }
        //);

    //});
</script>

<body>

    <header>
        <?php require_once("../includes/cabecalho.php"); ?>
    </header>

<!--    
<div class="TabControl">
    <div id="header">
    <ul class="abas" style="list-style-type:none;" >
        <li> 
        <div class="aba">
            <span>Comprar minicursos/visitas</span>
        </div>
        </li>  
        <li>
        <div class="aba">
            <span>Comprar produtos</span>
        </div>
        </li>
        <li>
        <div class="aba">
            <span>Presença em aula</span>
        </div>
        </li>
        <li>
        <div class="aba">
            <span>Carrinho de compras</span>
        </div>
        </li>
    </ul>
    </div>
        <div id="content">
            <div class="conteudo">
                <?php //require_once("../includes/consulta_eventos.php"); ?>
            </div>
            <div class="conteudo">
                <?php //require_once("../includes/consulta_produtos.php"); ?>
            </div>
            <div class="conteudo">
                <?php //require_once("../includes/consulta_presenca.php"); ?>
            </div>
            <div class="conteudo">
                <?php //require_once("../includes/carrinho.php"); ?>
            </div>
        </div>
    </div>
-->
<div>
    <?php require_once("../includes/consulta_eventos.php"); ?>
</div>

<div>
    <?php include("../includes/anotar_pedido.php") ?>
</div>

</body>
</html>