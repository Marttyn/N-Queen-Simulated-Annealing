<?php
/**
 * Created by PhpStorm.
 * User: rdoliveira
 * Date: 04/10/2018
 * Time: 17:11
 */

include_once 'FuncoesInicializar.php';

class TemperaSimulada
{
    public $tabuleiro;
    public $custo;
    public $temperatura;
    public $txResfriamento;

    /**
     * TemperaSimulada constructor.
     * @param int $n
     * @param int $maximoIteracoes
     * @param float $temperatura
     * @param float $txResfriamento
     */
    public function __construct(array $tabuleiro = null, int $custo, float $temperatura = null, float $txResfriamento = null)
    {
        $this->tabuleiro = $tabuleiro;
        $this->temperatura = $temperatura;
        $this->txResfriamento = $txResfriamento;
        $this->custo = $custo;
    }

    /**
     * @return int
     */
    public function busca()
    {
        $this->tabuleiro = $this->mover();
        $this->mostraTabuleiro();
        ob_flush();
        ob_clean();
        $this->custo = FuncoesInicializar::getHeuristica($this->tabuleiro);
        $this->temperatura = max($this->temperatura * $this->txResfriamento, 0.01);
        return $this->custo == 0 ? 0 : 1;
    }

    /**
     * @return array
     */
    private function mover(): array
    {
        $n = count($this->tabuleiro);

        while (true) {
            $novaColuna = mt_rand(0, $n - 1);
            $novaLinha = mt_rand(0, $n - 1);
            $tmpLinha = $this->tabuleiro[$novaColuna];

            $this->tabuleiro[$novaColuna] = $novaLinha;

            $custo = FuncoesInicializar::getHeuristica($this->tabuleiro);

            if ($custo < $this->custo) {
                return $this->tabuleiro;
            }

            $novoCusto = $this->custo - $custo;

            $probAceitavel = min(1, exp($novoCusto / $this->temperatura));

            if (mt_rand() / mt_getrandmax() < $probAceitavel) {
                return $this->tabuleiro;
            }

            $this->tabuleiro[$novaColuna] = $tmpLinha;
        }

        return [];
    }

    public function mostraTabuleiro()
    {
        $tabuleiroHTML = '<div id="containerFull"><div id="container">';
        $linha = 1;
        $coluna = 1;
        $tamanho = 100/count($this->tabuleiro);
        $font = (600/count($this->tabuleiro))*(2/3);
        foreach ($this->tabuleiro as $value) {
            $tabuleiroHTML .= "<div class=\"row line-{$linha}\" style='--n:{$tamanho}%;'>";
            for ($i = 0; $i < count($this->tabuleiro); $i++) {
                if ($i == $value) {
                    $tabuleiroHTML .= "<div id=\"$coluna\" style='font-size: {$font}px !important;'>&#9819</div>";
                } else {
                    $tabuleiroHTML .= "<div id=\"$coluna\"></div>";
                }
                $coluna++;
            }
            $tabuleiroHTML .= '</div>';
            if ($linha == 2) {
                $linha = 1;
            } else {
                $linha++;
            }
        }

        return $tabuleiroHTML;
    }
}