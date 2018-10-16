<?php
/**
 * Created by PhpStorm.
 * User: rdoliveira
 * Date: 04/10/2018
 * Time: 17:34
 */

include_once 'TemperaSimulada.php';

try {
    $temperaSimulada = new TemperaSimulada(8, 1000, 100.00, 0.95);

    $solucao = $temperaSimulada->busca();
} catch (Exception $e){
    echo $e;
}

if (!isset($solucao)){
    echo 'A solução não foi encontrada';
} else {
    $temperaSimulada->mostraTabuleiro();
}