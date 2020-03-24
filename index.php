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
    
    $acesso = mysqli_query($conecta, $login);
    if (!$acesso){
        die("Um erro ocorreu! " . mysqli_connect_errno());
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

//Conferindo se o e email já não está cadastrado no DB

$cadastros = "SELECT email FROM alunos";

$verificacao = mysqli_query($conecta, $cadastros);
if(!$verificacao){
    die("Falha na consulta do banco " . mysqli_connect_errno());
}else{
    while($emails_existentes = mysqli_fetch_assoc($verificacao)){
        if($emails_existentes = $email){ die("O email já está cadastrado");}
    }
}


//inserindo informação no BD
    $inserir = "INSERT INTO alunos(nome,sobrenome,rg,tel,faculdade,matricula,email,senha) VALUES ('$nome','$sobrenome','$rg','$telefone','$faculdade','$matricula','$email','$senha')";

    $operacao_inserir = mysqli_query($conecta,$inserir);
    if(!$operacao_inserir){
        die("Erro no Banco " . mysqli_connect_errno());
    } else{
        unset($_POST);
    }

    //Caso a pessoa queira retornar para a página de login e sair da pagina de cadastro
    if(isset($_POST["fazer_login"])){
        unset($_POST);
    }
}

?>


<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" href = "../tmp/index.css">
    <meta charset="utf-8" />
    <title>Sistema Integrado da SIEEL</title>
</head>
<body>

    <header>
        <nav>
            <img class = "container" src = "../tmp/Logo.png" alt = SIEEL >
        </nav>
    </header>

    <h1>Bem vindo ao Sistema de Cadastro integrado da SIEEL</h1>
    <h3>Ingressos, compras, presenças e certificados. Tudo isso em um único lugar</h3>

<?php if(!isset($_POST["cadastrar"])) { ?>
    <div class = "JanelaCadastro">
        <form action = "index.php" method = "post">
			<h2>Login</h2>
            
            <div class="email">
            <label for="email">Email</label> <br />
            <input type="email" name="usuario" placeholder="Email" class="input_box" size="30" maxlength="100" require>
            </div>

            <div class="criar_senha">
            <label for="criar_senha">Digite a senha</label> <br />
            <input type="password" name="senha" placeholder="Senha" class="input_box" size="30" maxlength="50" require>
            </div>
            
            <br>
            <input type="submit" value="Login" name="login" id="botao_login" />
            <input type="submit" value="Cadastrar" name="cadastrar" id="botao_cadastro" />
        </form>
    </div>
<?php } ?>

    <?php if(isset($mensagem)){ ?>
        <p><?php echo $mensagem ?></p>
    <?php } ?>

<?php if(isset($_POST["cadastrar"])) { ?>
    <div class = "JanelaCadastro">
        <form action="index.php" method="post">

            <div class="nome">
            <label for="nome">Nome</label> <br />
            <input type="text" id="nome" name="nome" size="30" maxlength="100" class="input_box" placeholder="Insira seu nome" require/> <br />
            </div>

            <div class="sobrenome">
            <label for="sobrenome">Sobrenome</label> <br />
            <input type="text" id="sobrenome" name="sobrenome" size="30" maxlength="100" class="input_box" placeholder="Insira o seu sobrenome" require /> <br />
            </div>

            <div class="rg">
            <label for="rg">Número do RG</label> <br />
            <input type="text" id="rg" name="rg" size="30" maxlength="30" class="input_box" placeholder="Insira o seu número de RG" require/> <br />
            </div>

            <div class="tel">
            <label for="tel">Telefone de contato</label> <br />
            <input type="tel" id="tel" name="tel" size="30" class="input_box" placeholder="Insira o seu telefone para contato" /> <br />
            </div>

            <div class="faculdade">
            <label for="faculdade">Qual é a sua universidade?</label> <br />
            <input type="radio" name="faculdade" value="USP" />USP <br />
            <input type="radio" name="faculdade" value="UFSCar" />UFSCar <br />
            <input type="radio" name="faculdade" value="outro" />Outro <br />
            </div>

            <div class="matricula">
            <label for="matricula">Número da Matrícula</label> <br />
            <input type="text" id="matricula" name="matricula" size="30" maxlength="30" class="input_box" placeholder="Insira o seu número de matrícula" /> <br />
            </div>

            <div class="email">
            <label for="email">Email</label> <br />
            <input type="email" id="email" name="email" size="30" class="input_box" placeholder="Insira um email" require /> <br />
            </div>

            <div class="criar_senha">
            <label for="criar_senha">Criar senha</label> <br />
            <input type="password" id="criar_senha" name="criar_senha" size="30" maxlength="50" class="input_box" placeholder="Crie um senha" require/> <br />
            </div>

            <br>
            <input type="submit" id="botao_cadastro" value="Cadastrar" name="submeter_cadastro" onclick="alert('Cadastro realizado com sucesso.')" />
            <input type="submit" id="botao_login" value="Fazer login" name="fazer_login" />

        </form>
    </div>


<?php } ?>


</body>
</html>