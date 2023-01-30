<!DOCTYPE html>
<html>
    <?php
    include("funcoes.php");
    
    if (isset($_POST["nome"]) && isset($_POST["sobrenome"]) && isset($_POST["email"]) && isset($_POST["senha"])) {
        $email = $_POST["email"];
        $usuarios = pega_usuarios("usuarios");
        $resultado = valida_usuario($usuarios,$email);

        if ($resultado==0) {
            $usuario = array();
            $usuario["nome"] = $_POST["nome"];
            $usuario["sobrenome"] = $_POST["sobrenome"];
            $usuario["email"] = $_POST["email"];
            $usuario["senha"] = $_POST["senha"];
            array_push($usuarios, $usuario);
            $message = "<span>Usuario cadastrado</span>";
            salva_usuarios("usuarios", $usuarios);
        }
        elseif ($resultado==1) {
            $message = "<span>Usuario já cadastrado</span>";
        }
    }
    ?>
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="topo"><img src="imagens/logo.png" id="logo"></div>
    <form id="box" action="cadastro.php", method="POST">
        <h1>Cadastro</h1>
        <span>Nome</span>
        <input id="nome" name="nome" class="text" type="text">
        
        <span>Sobrenome</span>
        <input id="sobrenome" name="sobrenome" class="text" type="text">

        <span>E-mail</span>
        <input id="email" name="email" class="text" type="text">

        <span>Senha</span>
        <input id="password" name="senha" class="text" type="password">

        <input type="submit" value="Cadastrar" class="button">
        <div><a href="login.php" style="text-decoration: none; color: #e84c3d">Já possui uma conta? Faça login</div>
        <?php if (isset($message)) { echo $message; } ?>
    </form>
</body>
</html>