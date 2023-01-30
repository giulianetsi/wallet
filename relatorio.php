<!DOCTYPE html>
<html>
<?php
	session_start();
	include("funcoes.php");
	$userSession = $_SESSION["email"];
?>
<head>
    <meta charset="UTF-8">
    <title>Relatório</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="topo"><img src="imagens/logo.png" id="logo"></div>
    <div class="container">
    	<form action="relatorio.php" method="POST">
           <span>Mês</span>
       		<select id="mes" name="mes">
            <option value="" disabled selected>Selecione o mês</option>
            <option value="1">Janeiro</option>
            <option value="2">Fevereiro</option>
            <option value="3">Março</option>
            <option value="4">Abril</option>
            <option value="5">Maio</option>
            <option value="6">Junho</option>
            <option value="7">Julho</option>
            <option value="8">Agosto</option>
            <option value="9">Setembro</option>
            <option value="10">Outubro</option>
            <option value="11">Novembro</option>
            <option value="12">Dezembro</option>
        	</select><br>
        	<input type="submit" value="Enviar" class="button">
        </form>
       <?php
          $data = new DateTime();
          $mes= $data->format('m');
          if(isset($_POST["mes"])) {
            $mes=$_POST["mes"];  
          }
       		relatorio_completo($userSession,$mes);
       ?>
 		<a class="button" href="inicio.php">Voltar</a>

    </div>
    
</body>
</html>
