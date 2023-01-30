<!DOCTYPE html>
<html>
 <?php
    session_start();
    include("funcoes.php");
    
    if (isset($_POST["lancamento"]) && isset($_POST["categoria"]) && isset($_POST["mes"]) && isset($_POST["valor"])) {
        $email = $_SESSION["email"];
        $lancamentos = pega_lancamentos("lancamentos");
        $lancamento = array();
        $lancamento["email"] = $email;
        $lancamento["lancamento"] = $_POST["lancamento"];
        $lancamento["categoria"] = $_POST["categoria"];
        $lancamento["mes"] = $_POST["mes"];
        $lancamento["valor"] = $_POST["valor"];
        array_push($lancamentos, $lancamento);
        $message = "<span>Lançamento cadastrado</span>";
        salva_lancamentos("lancamentos", $lancamentos);
    }
    ?>
<head>
    <meta charset="UTF-8">
    <title>Fazer Lançamentos</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>

    <form id="box" action="fazerlancamentos.php", method="POST">
        <h1>Fazer Lançamento</h1>
        <span>Tipo de Lançamento</span>
        <select id="lancamento" name="lancamento">
            <option value="" disabled selected>Selecione Tipo de Lançamento</option>
            <option value="Gasto">Gasto</option>
            <option value="Lancamento">Lançamento</option>
        </select><br>

        <span>Categoria</span>
        <select id="categoria" name="categoria">
            <option value="" disabled selected>Selecione uma categoria</option>
            <option value="GastoDomestico">Gastos Domesticos</option>
            <option value="GastoPessoal">Gastos Pessoais</option>
            <option value="GastoEmergencial">Gastos Emergenciais</option>
            <option value="Salario">Salario</option>
            <option value="Extras">Extras</option>
        </select><br>

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

        <span>Valor</span>
        <input id="valor" name="valor" class="text" type="text">
        <input type="submit" value="Enviar" class="button">
        <a class="button" href="inicio.php">Voltar</a>
        <?php if (isset($message)) { echo $message; } ?>
    </form>
    
</body>
</html>