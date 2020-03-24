<?php

//require_once("../includes/Conectar.php");
$conecta = mysqli_connect("localhost","sieel","#Notebook99","sieel");

session_start();
$sessao = session_id();

//teste de login
if(!isset($_SESSION["user"])){
    header("location: ../public_html/index.php");
  }
//fim do teste de login

//Pegando os itens no DB
  $sql_meu_carrinho = "SELECT * FROM pedidos WHERE sessao = '{$sessao}'";
  $exec_meu_carrinho =  mysqli_query($conecta,$sql_meu_carrinho); 
  if(!$exec_meu_carrinho){
    die("Erro no Banco " . mysqli_connect_errno());
}
   
  $qtd_meu_carrinho = mysqli_num_rows($exec_meu_carrinho);


if(isset($_GET["acao"])){

//Excluindo itens do carrinho
if($_GET['acao'] == 'Remover'){
    $codigo = $_GET['codigo'];
    

    $excluir = "DELETE FROM pedidos WHERE codigo = '{$codigo}' AND sessao = '{$sessao}'";    
    $exec_carrinho_excluir = mysqli_query($conecta,$excluir);
    if(!$exec_carrinho_excluir){
        die("Erro no Banco " . mysqli_connect_errno());
    }
}

//Realizando a reserva dos produtos
if($_GET['acao'] == 'Reservar'){
  
  while($pedido = mysqli_fetch_assoc($exec_meu_carrinho)){
    $codigo = $pedido["codigo"]; 
    $qnt_pedido = $pedido["quantidade"];
    $sessao = session_id();

    //Atualizando a reserva nos registros de compras
    $reservar = "UPDATE pedidos SET reserva = 'true' WHERE codigo = '{$codigo}' and sessao = '{$sessao}'";    
    $exec_carrinho_reservar = mysqli_query($conecta,$reservar);
    if(!$exec_carrinho_reservar){
        die("Erro na reserva no Banco " . mysqli_connect_errno());
    }

    if($codigo < 1000){  //Se for produto
        //Buscando a quantidade do produto no DB
        $sql_produto = "SELECT quantidade FROM produtos WHERE codigo = '{$codigo}'";
        $exec_produtos =  mysqli_query($conecta,$sql_produto) or die(mysqli_connect_errno());
        $qnt_prod = array_sum(mysqli_fetch_assoc($exec_produtos)); //array_sum esta convertendo o valor da string em inteiro para fazermos a operação

        //Atualizando estoque
        $qnt_prod = $qnt_prod - $qnt_pedido; 
        $sql_produto = "UPDATE produtos SET quantidade = '{$qnt_prod}' WHERE codigo = '{$codigo}'";
        $exec_produtos =  mysqli_query($conecta,$sql_produto) or die("Erro nos produtos " . mysqli_connect_errno());
        
    }
    if($codigo > 1000){  //Se for evento
        //Buscando a quantidade do evento no DB
        $sql_evento = "SELECT quantidade FROM eventos WHERE codigo = '{$codigo}'";
        $exec_eventos =  mysqli_query($conecta,$sql_evento) or die(mysqli_connect_errno());
        $qnt_event = array_sum(mysqli_fetch_assoc($exec_eventos));
        
        //Atualizando estoque
        $qnt_event = $qnt_event - $qnt_pedido; 
        $sql_evento = "UPDATE eventos SET quantidade = '{$qnt_event}' WHERE codigo = '{$codigo}'";
        $exec_eventos =  mysqli_query($conecta,$sql_evento) or die("Erro nos eventos " . mysqli_connect_errno());
        
    }


}
    header("location: ../public_html/pagina_aluno.php");
}

}
?>



<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link href="../tmp/carrinho.css" rel="stylesheet" />
    <meta charset="utf-8" />
    <title>Carrinho de compras</title>
</head>
<body>
    <header>
        <?php require_once("../includes/cabecalho.php"); ?>
    </header>

<?php
    //Se não houver nada no carrinho
    if($qtd_meu_carrinho == 0){
        echo '<h3>Seu carrinho se encontra vazio</h3>';
    }
?>


    <table align="center" id="lista_de_compra">
        <tr>
            <th><h3>Item</h3></th>
            <th><h3>Tamanho</h3></th>
            <th><h3>Preço</h3></th>
            <th><h3>Quantidade</h3></th>
            <th><h3>Subtotal</h3></th>
        </tr>
    <?php 
       $total = 0;
       
    while($pedido = mysqli_fetch_assoc($exec_meu_carrinho)){
       $codigo = $pedido["codigo"]; 
       $subtp = 0;
       $subtv = 0;
        if($codigo < 1000){  //Se for produto
            //Buscando o produto no DB
            $sql_produto = "SELECT * FROM produtos WHERE codigo = '{$codigo}'";
            $exec_produtos =  mysqli_query($conecta,$sql_produto) or die(mysqli_connect_errno());
            $produto = mysqli_fetch_assoc($exec_produtos);
         
            $nome = $produto["nome"];
            $preco_un = $produto["preco"];
            $qnt = $pedido["quantidade"];  // Quantidade de produtos no carrinho de compras
            $subtp = $preco_un * $qnt;
?>
        <tr>
            <td><?php echo $nome ?></td>
            <td><?php echo $pedido['tamanho'] ?></td>
            <td>R$ <?php echo $preco_un ?></td>
            <td><?php echo $qnt ?></td>
            <td>R$ <?php echo $subtp ?></td>
            <td>
            <form action="?" method="get">
            <input name="codigo" value="<?php echo $pedido["codigo"]; ?>" size="6px" class="input_box" readonly>
            <input type="submit" name="acao" value="Remover" id="Botao_retirar">
            </form>
            </td>
        </tr>
<?php        }
        if($codigo > 1000){  //Se for evento
            //Buscando o evento no DB
            $sql_evento = "SELECT * FROM eventos WHERE codigo = '{$codigo}'";
            $exec_eventos =  mysqli_query($conecta,$sql_evento) or die(mysqli_connect_errno());
            $evento = mysqli_fetch_assoc($exec_eventos);
         
            $nome = $evento["nome"];
            $preco_un = $evento["preco"];
            $qnt = $pedido["quantidade"];  // Quantidade de produtos no carrinho de compras
            $subtv = $preco_un * $qnt;
?>
        <tr>
            <td><?php echo $nome ?></td>
            <td><?php echo $pedido['tamanho'] ?></td>
            <td>R$ <?php echo $preco_un ?></td>
            <td><?php echo $qnt ?></td>
            <td>R$ <?php echo $subtv ?></td>
            <td>
            <form action="?" method="get">
            <input name="codigo" value="<?php echo $pedido["codigo"]; ?>" size="6px" class="input_box" readonly>
            <input type="submit" name="acao" value="Remover" id="Botao_retirar">
            </form>
            </td>
        </tr>
       
<?php    }
 
            $total = $subtv + $subtp;
        }
    ?>

    </table>

<h3 style="text-align: center"><b>Total:</b> R$<?php echo $total;?> </h3>

<div id="botoes">
<form action="?" method="get">
<input type="submit" value="Reservar" name="acao" id="Botao_retirar" >
</form>

<form action="pagina_aluno.php" method="post">
<input type="submit" value="Continuar Comprando" name="acao" id="Botao_retirar">
</form>

</div>

</body>
</html>  