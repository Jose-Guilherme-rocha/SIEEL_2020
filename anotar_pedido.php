<?php
if(isset($_GET["acao"])){

    //Adicionando produtos ao carrinho
    if($_GET["acao"] == 'Comprar'){
        
        $codigo = $_GET["codigo"];
        $sessao = session_id();
        $cliente = $_SESSION["user"];
        $qnt = "1";
        
        if($codigo > 1000){  //Se o código for >1000 entao é um evento, logo nao existe tamanho
            $tamanho = "u";
        }else{               //Se o código for <1000 é um produto, então precisamos do tamanho
            $tamanho = $_GET["tamanho"];
        }

        //Colocando as informações da compra no DB
        $inserir_compra = "INSERT INTO pedidos(sessao,codigo,aluno,tamanho,quantidade) VALUES ('$sessao','$codigo','$cliente','$tamanho','$qnt')";     
        $operacao_inserir_compra = mysqli_query($conecta,$inserir_compra);
        if(!$operacao_inserir_compra){
            die("Erro no Banco " . mysqli_connect_errno());
        } 
    }
}

?>