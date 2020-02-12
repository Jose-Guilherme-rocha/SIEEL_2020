<?php
    //consulta ao banco de dados
    $produtos = "SELECT idprodutos, nome, preco, quantidade, tamanho, imagem, ocultar FROM produtos";

    $resultado = mysqli_query($conecta, $produtos);
    if(!$resultado){
        die("Falha na consulta do banco");
    }

?>

<?php 
   while($linha = mysqli_fetch_assoc($resultado)){ 
?>
    <?php    
        if($linha["ocultar"] == 0){
    ?>
        <ul style="list-style-type:none;">
            <li><?php echo $linha["nome"] ?></li>
            <li>Preço: R$ <?php echo $linha["preco"] ?></li>
            <li>Quantidade: <?php echo $linha["quantidade"] ?></li>
            <li>Tamanho: <?php echo $linha["tamanho"] ?></li>
            
        </ul>
        <a href="?acao=add&id=<?php echo $linha['idprodutos']?>">Comprar</a>       
    <?php
        }
    ?>
<?php
   }
 ?>
