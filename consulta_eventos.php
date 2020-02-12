<?php
    //consulta ao banco de dados
    $eventos = "SELECT ideventos, nome, local, preco, quantidade, data, ocultar, codigo FROM eventos";

    $resultado = mysqli_query($conecta, $eventos);
    if(!$resultado){
        die("Falha na consulta do banco");
    }

?>

<?php 
   while($linha = mysqli_fetch_assoc($resultado)){ 
?>
    <ul style="list-style-type:none;">
        <li><?php echo $linha["nome"] ?></li>
        <li>Local: <?php echo $linha["local"] ?></li>
        <li>Preço: <?php echo $linha["preco"] ?></li>
        <li>Quantidade: <?php echo $linha["quantidade"] ?></li>
        <li>Data: <?php echo $linha["data"] ?></li>
        
    </ul>
    <a href="?acao=add&id=<?php echo $linha['codigo']?>">Comprar</a>
<?php
   }
 ?>