<div id = "saudacao">    
    <?php 

        if (isset($_SESSION["user"])){
            $saudacao = "SELECT nome FROM alunos WHERE idalunos = {$_SESSION["user"]}";

            $login_saudacao = mysqli_query($conecta, $saudacao);
            if (!isset($login_saudacao)){
                die ("Falha no Banco de dados");
            }
            $login_saudacao = mysqli_fetch_assoc($login_saudacao);
            $nome = $login_saudacao["nome"];

    ?>   
        <p> Seja bem-vindo, <?php echo $nome ?> </p>
    <?php
        }
    ?>
    <p><a href="../includes/logout.php">Logout</a></p>
    <p><a href="../includes/carrinho2.php">Carrinho de compras</a></p>
    
</div>
