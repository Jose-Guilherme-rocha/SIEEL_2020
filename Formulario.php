<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Formulario_PHP</title>
</head>
<body>
    <pre>
<?php
print_r($_POST);

    $nome = $_POST["nome"];

    echo "Meu nome " . $nome;
?>    
    </pre>
</body>
</html>