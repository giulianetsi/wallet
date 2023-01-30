<!DOCTYPE html>
<html>
    <?php
    include("funcoes.php");
    session_start();
    if (isset($_POST["email"]) && isset($_POST["senha"])) {
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $usuarios = pega_usuarios("usuarios");
        $resultado=login($usuarios,$email,$senha);
        if ($resultado==1) {
            $_SESSION["email"] = $email;
            header("Location: inicio.php");
        }
        elseif ($resultado==0) {
            $error = true;
        }
        }
    ?>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="topo"><img src="imagens/logo.png" id="logo"></div>
    <form id="box" action="login.php" method="POST">
        <h1>Login</h1>
        
        <span>E-mail</span>
        <input id="email" name="email" class="text" type="text">

        <span>Senha</span>
        <input id="senha" name="senha" class="text" type="password">

        <input type="submit" value="Entrar" class="button">
        <?php 
            if (isset($error)) {
                echo "<div>Usuário ou senha inválidos</div>";
            }
        ?>
        <div><a href="cadastro.php" style="text-decoration: none; color: #e84c3d">Não possui uma conta? Cadastre-se</div>
    </form>
</body>
</html>