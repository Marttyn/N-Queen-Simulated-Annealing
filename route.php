<?php
/**
 * Created by PhpStorm.
 * User: rdoliveira
 * Date: 04/10/2018
 * Time: 17:11
 */

include_once 'TemperaSimulada.php';
include_once 'FuncoesInicializar.php';

if ($_GET['action'] == 'inicializar') {
    $tabuleiro = FuncoesInicializar::inicializaTabuleiro($_REQUEST['n']);
    $custo = FuncoesInicializar::getHeuristica($tabuleiro);
    echo json_encode(new TemperaSimulada($tabuleiro, $custo, $_REQUEST['temperatura'], $_REQUEST['txResfriamento']));
} else {
    $temperaSimulada = new TemperaSimulada($_REQUEST['tabuleiro'], $_REQUEST['custo'], $_REQUEST['temperatura'], $_REQUEST['txResfriamento']);

    if ($_GET['action'] == 'busca'){
        $temperaSimulada->busca();
        echo json_encode($temperaSimulada);
    } elseif ($_GET['action'] == 'mostrartabuleiro'){
        echo $temperaSimulada->mostraTabuleiro();
    }

}