<?php

require_once("../includes/Conectar.php");

//teste de login
if(!isset($_SESSION["user"])){
    header("location: index.php");
  }
//fim do teste de login

//Pegando os itens no DB
  $sql_meu_carrinho = "SELECT * FROM carrinho WHERE sessao = '".session_id()."' ORDER BY nome ASC";
  $exec_meu_carrinho =  mysqli_query($sql_meu_carrinho, $conecta) or die(mysqli_connect_errno());
  $qtd_meu_carrinho = mysqli_num_rows($exec_meu_carrinho);

//Excluindo itens do carrinho
if($_GET['acao'] == 'del'){
    $codigo = $_GET['id'];
    $sessao = session_id();

    $excluir = "DELETE FROM carrinho WHERE codigo_produto_evento = '".$codigo."' AND sessao = '".$sessao."'";    
    $exec_carrinho_excluir = mysqli_query($excluir, $conecta) or die(mysqli_connect_errno());
}

?>


<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Carrinho</title>
    </head>
  <body> 
    <header>
        <?php require_once("../includes/cabecalho.php"); ?>
    </header>

    <table>
        <tr>
            <th>Item</th>
            <th>Tamanho</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Subtotal</th>
        </tr>
    <?php 
   while($linha = mysqli_fetch_assoc($exec_meu_carrinho)){
       $subt = $linha['preco'] * $linha['quantidade']; 
    ?>
        <tr>
            <td>'.$linha['nome'].'</td>
            <td>'.$linha['tamanho'].'</td>
            <td>R$ '.$linha['preco'].'</td>
            <td>'.$linha['quantidade'].'</td>
            <td>R$'.$subt.'</td>
            <td><a href="?acao=del&id='.$linha['codigo_produto_evento'].'">Remover</a></td>
        </tr>

    <?php
        }
    ?>

    </table>

<a href="../public_html/pagina_aluno.php">Continuar Comprando</a>

</body>
</html>  