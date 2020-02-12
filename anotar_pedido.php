<h1>Anotar pedido</h1>

<?php
if(isset($_GET["acao"])){
    //Adicionando produtos ao carrinho
    if($_GET["acao"] == 'add'){

        //teste
           // echo "funciona o condicional";
        $codigo = $_GET['id'];
        $sessao = session_id();
        $cliente = $_SESSION["user"];
        $qnt = 1;
        
        //Colocando as informações da compra no DB
        $inserir = "INSERT INTO carrinho(numero da sessao, codigo_produto_evento, comprador, quantidade) VALUES ('$sessao','$codigo','$cliente',$qnt)";
        $operacao_inserir = mysqli_query($conecta,$inserir);
        if(!$operacao_inserir){
            die("Erro no Banco " . mysqli_connect_errno());
        } else{
           echo "Deu certo?";
        }

    }



}



?>