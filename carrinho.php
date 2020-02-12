<?php 
  $id = 0;
    if(isset($_GET['acao'])){ 
        //ADICIONAR CARRINHO 
        if($_GET['acao'] == 'add'){ 
          $id = intval($_GET['id']); 
          if(!isset($_SESSION['carrinho'][$id])){ 
            $_SESSION['carrinho'][$id] = 1; 
          } else { 
            $_SESSION['carrinho'][$id] += 1; 
          } 
        } //REMOVER CARRINHO 
      
        if($_GET['acao'] == 'del'){ 
          $id = intval($_GET['id']); 
          if(isset($_SESSION['carrinho'][$id])){ 
            unset($_SESSION['carrinho'][$id]); 
               } 
            } 
    }

?>
<table>
    <caption>Carrinho de Compras</caption>
    <thead>
      <tr>
        <th width="244">Produto</th>
        <th width="79">Quantidade</th>
        <th width="89">Pre&ccedil;o</th>
        <th width="100">SubTotal</th>
        <th width="64">Remover</th>
      </tr>
    </thead>
    
    <tbody>
     <?php
        if(count($_SESSION['carrinho']) == 0){
          echo '
        <tr>
          <td colspan="5">Não há produto no carrinho</td>
        </tr>
      ';
          } else {
                $total = 0;
                
                
                while($_SESSION['carrinho']){
                    $qtd = $id;  
                    //consulta ao banco de dados
                    $aux = $_GET['id'];
                    $produtos = "SELECT * FROM produtos WHERE idprodutos = '{$aux}'";

                    $resultado = mysqli_query($conecta, $produtos);
                    $erro = mysqli_errno($conecta);
                    if(!$resultado){
                        echo $_GET['id'];
                        echo $erro;
                        die("Falha na consulta do banco");
                    }
                    $linha = mysqli_fetch_assoc($resultado);
                    //--------------------------------------//
                        $nome  = $linha['nome'];
                        $preco = number_format($linha['preco'], 2, ',', '.');
                        $sub   = number_format($linha['preco'] * $qtd, 2, ',', '.');
                        $total += $linha['preco'] * $qtd;
                         echo '
            <tr>       
                <td>'.$nome.'</td>
                <td>'.$qtd.'</td>
                <td>R$ '.$preco.'</td>
                <td>R$ '.$sub.'</td>
                <td><a href="?acao=del&id='.$id.'">Remover</a></td>
            </tr>';
                }
                $total = number_format($total, 2, ',', '.');
                echo '<tr>                         
              <td colspan="4">Total</td>
              <td>R$ '.$total.'</td>
                    </tr>';
          }
                   ?>
       
         </tbody>
</table>


