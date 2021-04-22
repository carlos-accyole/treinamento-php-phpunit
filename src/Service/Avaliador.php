<?php

namespace Alura\Leilao\Service;

use Alura\Leilao\Model\Leilao;

class Avaliador
{
    private $maiorValor = -INF;
    private $menorValor = INF;

    public function avalia(Leilao $leilao): void
    {
        foreach ($leilao->getLances() as $lances) {
            if ($lances->getValor() > $this->maiorValor) {
                $this->maiorValor = $lances->getValor();
            }

            if ($lances->getValor() < $this->menorValor) {
                $this->menorValor = $lances->getValor();
            }
        }
    }

    /**
     * @return float
     */
    public function getMaiorValor(): float
    {
        return $this->maiorValor;
    }

    /**
     * @return float
     */
    public function getMenorValor(): float
    {
        return $this->menorValor;
    }
}