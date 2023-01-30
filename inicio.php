<?php
    session_start();
     include("funcoes.php");

    if (isset($_POST["Sair"])) {
        unset($_SESSION["email"]);
    }
    if (isset($_SESSION["email"])) {
        $userSession = $_SESSION["email"];
    }
    else {
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Wallet</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="topo"><img src="imagens/logo.png" id="logo"></div>
    <div class="container">
        <div class="box" id="box1">Gastos
            <div class="valor">
                <?php
                $gastos = soma_gastos_mes($userSession);
                if ($gastos!=0) {
                    echo "<p class='ini'>".$gastos."</p>";
                }
                ?>
            </div>
        </div>
        <div class="box">Saldo
            <div class="valor">
                <?php
                $lancamentos = soma_lancamentos_mes($userSession);
                $gastos = soma_gastos_mes($userSession);
                $total = $lancamentos-$gastos;
                    echo "<p class='ini'>".$total."</p>";
                ?>
            </div>
        </div></br>
        
        <div class="">
            <a class="button" href="relatorio.php">Relatórios</a>
            <a class="button" href="fazerlancamentos.php">Fazer Lançamento</a>
            <form action="inicio.php" method="POST">
            <input type="submit" value="Sair" name="Sair" class="button">
            </form>
        </div>

</body>
</html>