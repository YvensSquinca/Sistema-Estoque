<?php

function listaProdutos($conexao){
    $produtos = array();
    $resultado = mysqli_query($conexao, "select * from produtos ORDER BY nome ASC");
    while ($produto = mysqli_fetch_assoc($resultado)){
        array_push($produtos, $produto);
    }
    return $produtos;
}

function listaRelatorios($conexao){
    $produtos = array();
    $resultado = mysqli_query($conexao, "select * from " . "relatorio");
    while ($produto = mysqli_fetch_assoc($resultado)){
        array_push($produtos, $produto);
    }
    return $produtos;
}

function listaRelatorios10ultimos($conexao){
    $relatorios10 = array();
    $resultado = mysqli_query($conexao, "SELECT dataregistro, item, tecnico, quantidade, motivo, local FROM relatorio ORDER BY dataregistro DESC LIMIT 10");
    while ($relatorio = mysqli_fetch_assoc($resultado)){
        array_push($relatorios10, $relatorio);
    }
    return $relatorios10;
}

function listaRelatorios10ultimosEntrada($conexao){
    $relatorios10E = array();
    $resultado = mysqli_query($conexao, "SELECT dataregistro, item, tecnico, quantidade, motivo FROM relatorioentrada ORDER BY dataregistro DESC LIMIT 10");
    while ($relatorioE = mysqli_fetch_assoc($resultado)){
        array_push($relatorios10E, $relatorioE);
    }
    return $relatorios10E;
}

function insereProduto($conexao, $nome, $motivo, $chamado, $local, $solicitante, $tecnico, $data, $quantidader) {
    $query = "insert into relatorio (item, motivo, chamado, local, solicitante, tecnico, dataregistro, quantidade) values('{$nome}','{$motivo}',{$chamado}, '{$local}', '{$solicitante}', '{$tecnico}', '{$data}', {$quantidader})";
    $resultadoDaInsercao = mysqli_query($conexao, $query);
    return $resultadoDaInsercao;
}

function insereProduto1($conexao, $nome, $motivo, $tecnico, $data, $quantidader) {
    $query = "insert into relatorioentrada (item, motivo, tecnico, dataregistro, quantidade) values('{$nome}','{$motivo}','{$tecnico}', '{$data}',{$quantidader})";
    $resultadoDaInsercao = mysqli_query($conexao, $query);
    return $resultadoDaInsercao;
}