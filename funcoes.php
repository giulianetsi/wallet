<?php
    function pega_usuarios($usuario) {
        $usuarios = array();
        if (file_exists("cadastro.json")) {
            $cadastro = json_decode(file_get_contents("cadastro.json"), true);
            if (isset($cadastro[$usuario])) {
                $usuarios = $cadastro[$usuario];
            }
        }
        return $usuarios;
    }
    // CADASTRA USUARIO
    function salva_usuarios($nome, $usuarios) {
        $cadastro = array();
        if (file_exists("cadastro.json")) {
            $cadastro = json_decode(file_get_contents("cadastro.json"), true);
        }
        $cadastro[$nome] = $usuarios;
        file_put_contents("cadastro.json", json_encode($cadastro));
    }
    // VERIFICA SE USUARIO JA EXISTE (EMAIL)
    function valida_usuario($usuarios,$email){
        foreach ($usuarios as $campo => $pessoa) {
            if ($pessoa["email"]==$email){
                return 1;
            }
            else{
                return 0;
            }
            }
    }
    // FAZ LOGIN
    function login($usuarios,$email,$senha){
        foreach ($usuarios as $campo => $pessoa) {
            if ($pessoa["email"]==$email && $pessoa["senha"]==$senha){
                return 1;
            }
            else{
                return 0;
            }
            }
    }

    // FAZER LANÇAMENTOS:
    function pega_lancamentos($lancamento) {
        $lancamentos = array();
        if (file_exists("fazerlancamentos.json")) {
            $fazerlancamentos = json_decode(file_get_contents("fazerlancamentos.json"), true);
            if (isset($fazerlancamentos[$lancamento])) {
                $lancamentos = $fazerlancamentos[$lancamento];
            }
        }
        return $lancamentos;
    }

    // CADASTRA LANÇAMENTOS
    function salva_lancamentos($nome, $lancamentos) {
        $fazerlancamentos = array();
        if (file_exists("fazerlancamentos.json")) {
            $fazerlancamentos = json_decode(file_get_contents("fazerlancamentos.json"), true);
        }
        $fazerlancamentos[$nome] = $lancamentos;
        file_put_contents("fazerlancamentos.json", json_encode($fazerlancamentos));
    }

    // CALCULA SOMA DE GASTOS DO MES ATUAL
    function soma_gastos_mes($usuario){
        $somaGastos = 0;
        $data = new DateTime();
        $mesAtual= $data->format('m');
        $lancamentos = pega_lancamentos("lancamentos");
        foreach ($lancamentos as $campo => $lancamento) {
            if ($lancamento["email"]==$usuario && $lancamento["lancamento"]=="Gasto"){
                  if ($lancamento["mes"]==$mesAtual) {
                  $somaGastos += $lancamento["valor"];
                }
            }
        }
        return $somaGastos;
    }

    // CALCULA SOMA DE LANÇAMENTOS MES ATUAL
    function soma_lancamentos_mes($usuario){
        $somaLancamentos = 0;
        $data = new DateTime();
        $mesAtual= $data->format('m');
        $lancamentos = pega_lancamentos("lancamentos");
        foreach ($lancamentos as $campo => $lancamento) {
            if ($lancamento["email"]==$usuario && $lancamento["lancamento"]=="Lancamento"){
                if ($lancamento["mes"]==$mesAtual) {
                  $somaLancamentos += $lancamento["valor"];
                }
            }
        }
        return $somaLancamentos;
    }

    // PÁGINA RELATÓRIOS
    function relatorio_completo($usuario, $mes){
        $total= 0;
        $lancamentos = pega_lancamentos("lancamentos");
        echo "<table id='tabela' style='border-style:solid; border-color:#a9a9a9; margin:20px; background-color:white'";
        echo "<tr><td style='border-style:solid; margin:40px; background-color:#e84c3d; color:white'>Tipo de Lançamento</td>";
        echo "<td style='border-style:solid; margin:40px; background-color:#e84c3d; color:white'>Categoria</td>";
        echo "<td style='border-style:solid; margin:40px; background-color:#e84c3d; color:white'>Mês</td>";
        echo "<td style='border-style:solid; margin:40px; background-color:#e84c3d; color:white'>Valor</td>";
        echo "</tr>";
        foreach ($lancamentos as $campo => $lancamento) {
            if ($lancamento["email"]==$usuario && $lancamento["mes"]==$mes){
                if ($lancamento['lancamento']=='Lancamento') {
                    $total += $lancamento['valor'];
                }
                elseif ($lancamento['lancamento']=='Gasto') {
                    $total -= $lancamento['valor'];
                }
                echo "<tr><td>".$lancamento['lancamento']."</td>";
                echo "<td>".$lancamento['categoria']."</td>";
                echo "<td>".$lancamento['mes']."</td>";
                echo "<td>".$lancamento['valor']."</td>";
                echo "</tr>";
            }
        }
        echo "<tr><td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td>".$total."</td>";
                echo "</tr>";
    }
?>