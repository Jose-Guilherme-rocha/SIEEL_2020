<?php
    //consulta ao banco de dados
    $produtos = "SELECT * FROM produtos";

    $resultado = mysqli_query($conecta, $produtos);
    if(!$resultado){
        die("Falha na consulta do banco " . mysqli_connect_errno());
    }

?>

<?php 
   while($linha = mysqli_fetch_assoc($resultado)){ 
?>

    <?php    
        if($linha["ocultar"] == 0 & $linha["quantidade"] != 0){
    ?>
    <div class="Produtos">
        <ul style="list-style-type:none;">
            <li><h3><?php echo  $linha["nome"] ?></h3></li>
            <li>Preço: R$ <?php echo $linha["preco"] ?></li>
            <li>Quantidade: <?php echo $linha["quantidade"] ?></li>
            <form action="?" method="get">
            <label>Código do evento:</label>
            <input name="codigo" value="<?php echo $linha["codigo"]; ?>" size="6px" class="input_box" readonly> </br>    
            <label>Tamanhos disponíveis:</label> <br>
            <?php if($linha["baby_pp"] == 'true'){ echo '<input type="radio" name="tamanho" value="bb_pp" />Baby PP'; } ?>
            <?php if($linha["baby_p"] == 'true'){ echo '<input type="radio" name="tamanho" value="bb_p" />Baby P'; } ?>
            <?php if($linha["baby_m"] == 'true'){ echo '<input type="radio" name="tamanho" value="bb_m" />Baby M'; } ?>
            <?php if($linha["baby_g"] == 'true'){ echo '<input type="radio" name="tamanho" value="bb_g" />Baby G'; } ?>
            <?php if($linha["baby_gg"] == 'true'){ echo '<input type="radio" name="tamanho" value="bb_gg" />Baby GG'; } ?>
            <?php if($linha["pp"] == 'true'){ echo '<input type="radio" name="tamanho" value="pp" />PP'; } ?>
            <?php if($linha["p"] == 'true'){ echo '<input type="radio" name="tamanho" value="p" />P'; } ?>
            <?php if($linha["m"] == 'true'){ echo '<input type="radio" name="tamanho" value="m" />M'; } ?>
            <?php if($linha["g"] == 'true'){ echo '<input type="radio" name="tamanho" value="g" />G'; } ?>
            <?php if($linha["gg"] == 'true'){ echo '<input type="radio" name="tamanho" value="gg" />GG'; } ?>
            <?php if($linha["eg"] == 'true'){ echo '<input type="radio" name="tamanho" value="eg" />EG'; } ?>
            <?php if($linha["u"] == 'true'){ echo '<input type="radio" name="tamanho" value="u" />U'; } ?> 
            <br>  
            <input type="submit" value="Comprar" name="acao" id="Botao_comprar" onclick="alert('Item adicionado ao carrinho')">
            </form>
        </ul>
    </div>           
    <?php
        }
    ?>

<?php
   }
 ?>
