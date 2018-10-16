<?php
/**
 * Created by PhpStorm.
 * User: rdoliveira
 * Date: 04/10/2018
 * Time: 16:52
 */

class FuncoesInicializar
{
    /**
     * @param int $n
     * @return array
     */
    public static function inicializaTabuleiro(int $n): array
    {
        for ($i = 0; $i < $n; $i++) {
            $tabuleiro[$i] = mt_rand(0, $n-1);
        }

        return $tabuleiro;
    }

    /**
     * @param array $tabuleiro
     * @return int
     */
    public static function getHeuristica(array $tabuleiro): int
    {
        $h = 0;

        for ($i = 0; $i < count($tabuleiro); $i++) {
            for ($j = $i + 1; $j < count($tabuleiro); $j++) {
                if ($tabuleiro[$i] == $tabuleiro[$j] || abs($tabuleiro[$i] - $tabuleiro[$j]) == $j - $i){
                    $h++;
                }
            }
        }

        return $h;
    }
}