<?php
    require_once("../includes/Conectar.php");
    
    //inicia a sessão
    session_start();

    //Login
if (isset($_POST["login"])){

    $usuario = $_POST["usuario"];
    $cria_senha = $_POST["senha"];
    $senha = sha1($cria_senha);

    $login = "SELECT * FROM alunos WHERE email = '{$usuario}' and senha = '{$senha}'";
    //$login .= "FROM dadosalunos1"; // tabela dentro do DB
    //$login .= "WHERE email = '{$usuario}' and senha = '{$senha}' ";

    $acesso = mysqli_query($conecta, $login);
    if (!$acesso){
        die("Um erro ocorreu!");
    }

    $informacao = mysqli_fetch_assoc($acesso);

    if(empty($informacao)){
        $mensagem = "Login sem sucesso. :(";
    }else{
        $_SESSION["user"] = $informacao["idalunos"];
        header("location: pagina_aluno.php");
        
    }
    
}

    //Cadastro
    
    // isset serve para testar se o array estar vazio
if (isset($_POST["submeter_cadastro"])){
    $nome =  utf8_decode(isset ($_POST["nome"]) ? $_POST["nome"] : "Sem nome"); //operador ternário
    $sobrenome = utf8_decode(isset($_POST["sobrenome"]) ? $_POST["sobrenome"] : "Sem sobrenome"); //utf8_decode serve para manter os caracteres especiais no DB
    $rg = isset($_POST["rg"]) ? $_POST["rg"] : "Sem RG";
    $telefone = isset ($_POST["tel"]) ? $_POST["tel"] : "Sem telefone";
    $faculdade = isset ($_POST["faculdade"]) ? $_POST["faculdade"] : "Faculdade não declarada";
    $matricula = $_POST["matricula"];
    $email = $_POST["email"];
    $cria_senha = $_POST["criar_senha"];
    $senha = sha1($cria_senha); //criptografar a senha

//inserindo informação no BD
    $inserir = "INSERT INTO alunos(nome,sobrenome,rg,tel,faculdade,matricula,email,senha) VALUES ('$nome','$sobrenome','$rg','$telefone','$faculdade','$matricula','$email','$senha')";
    //$inserir = "INSERT INTO sieel ";
    //$inserir .= "(nome,sobrenome,rg,telefone,faculdade,matricula,email,senha) ";
    //$inserir .= "VALUES ";
    //$inserir .=  "('$nome','$sobrenome','$rg','$telefone','$faculdade','$matricula','$email','$senha') "

    $operacao_inserir = mysqli_query($conecta,$inserir);
    if(!$operacao_inserir){
        die("Erro no Banco " . mysqli_connect_errno());
    } else{
        unset($_POST);
    }

}

?>


<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Sistema Integrado da SIEEL</title>
</head>
<body>

    <h1>Bem vindo ao Sistema de Cadastro integrado da SIEEL</h1>
    <h3>Ingressos, compras, presenças e certificados. Tudo isso em um único lugar</h3>

<?php if(!isset($_POST["cadastrar"])) { ?>
    <div id = "Janela de login">
        <form action = "index.php" method = "post">
			<h2>Login</h2>
			<input type="email" name="usuario" placeholder="Email" require>
			<input type="password" name="senha" placeholder="Senha" require>
			<input type="submit" value="Login" name="login" />
            <input type="submit" value="Cadastrar" name="cadastrar" />
        </form>
    </div>
<?php } ?>

    <?php if(isset($mensagem)){ ?>
        <p><?php echo $mensagem ?></p>
    <?php } ?>

<?php if(isset($_POST["cadastrar"])) { ?>
    <div id = "Janela de Cadastro">
        <form action="index.php" method="post">

            <label for="nome">Nome</label> <br />
            <input type="text" id="nome" name="nome" size="30" maxlength="100" placeholder="Insira seu nome" require/> <br />

            <label for="sobrenome">Sobrenome</label> <br />
            <input type="text" id="sobrenome" name="sobrenome" size="30" maxlength="100" placeholder="Insira o seu sobrenome" require /> <br />
            
            <label for="rg">Número do RG</label> <br />
            <input type="text" id="rg" name="rg" size="30" maxlength="30" placeholder="Insira o seu número de RG" require/> <br />

            <label for="tel">Telefone de contato</label> <br />
            <input type="tel" id="tel" name="tel" size="30" placeholder="Insira o seu telefone para contato" /> <br />

            <label for="faculdade">Qual é a sua universidade?</label> <br />
            <input type="radio" name="faculdade" value="USP" />USP <br />
            <input type="radio" name="faculdade" value="UFSCar" />UFSCar <br />
            <input type="radio" name="faculdade" value="outro" />Outro <br />

            <label for="matricula">Número da Matrícula</label> <br />
            <input type="text" id="matricula" name="matricula" size="30" maxlength="30" placeholder="Insira o seu número de matrícula" /> <br />

            <label for="email">Email</label> <br />
            <input type="email" id="email" name="email" size="30" placeholder="Insira um email" require /> <br />

            <label for="criar_senha">Criar senha</label> <br />
            <input type="password" id="criar_senha" name="criar_senha" size="30" maxlength="50" placeholder="Crie um senha" require/> <br />

            <input type="submit" id="botao_cadastro" value="Cadastrar" name="submeter_cadastro" />

        </form>
    </div>


<?php } ?>


</body>
</html>