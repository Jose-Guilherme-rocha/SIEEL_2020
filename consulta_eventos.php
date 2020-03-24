<?php
    //consulta ao banco de dados
    $eventos = "SELECT * FROM eventos";

    $resultado = mysqli_query($conecta, $eventos);
    if(!$resultado){
        die("Falha na consulta do banco");
    }

?>

<?php 
   while($linha = mysqli_fetch_assoc($resultado)){ 
?>

    <?php    
        if($linha["ocultar"] == 0 & $linha["quantidade"] != 0){
    ?>
    <div class="Eventos">
        <ul style="list-style-type:none;">
            <li><h3><?php echo $linha["nome"] ?></h3></li>
            <li>Local: <?php echo $linha["local"] ?></li>
            <li>Preço: <?php echo $linha["preco"] ?></li>
            <li>Quantidade: <?php echo $linha["quantidade"] ?></li>
            <li>Data: <?php echo $linha["data"] ?></li>
            <form action="?" method="get">
                <label>Código do evento:</label>
                <input name="codigo" value="<?php echo $linha["codigo"]; ?>" size="6px" class="input_box" readonly> </br> 
                <input type="submit" name="acao" value="Comprar" id="Botao_comprar" onclick="alert('Item adicionado ao carrinho')">
            </form>
        </ul>
    </div>
    <?php
        }
    ?>         
<?php
   }
 ?>