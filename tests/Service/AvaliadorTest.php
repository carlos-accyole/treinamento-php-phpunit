<?php

namespace Alura\Leilao\Tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    public function testeAvaliadorDeveEncontrarOMaiorValorDeLancesEmOrdemCrescente()
    {
        $leilao = new Leilao('FIAT 147 0KM');

        $gabriela = new Usuario('Gabriela');
        $rafaela = new Usuario('Rafaela');

        $leilao->recebeLance(new Lance($gabriela, 2000));
        $leilao->recebeLance(new Lance($rafaela, 2500));

        $leiloeiro = new Avaliador();

        //Act - When
        $leiloeiro->avalia($leilao);

        $maiorValor = $leiloeiro->getMaiorValor();

        //Assert - Then
//        $this->assertEquals(2500, $maiorValor);
        //outra maneira de testar
        self::assertEquals(2500, $maiorValor);
    }

    public function testeAvaliadorDeveEncontrarOMaiorValorDeLancesEmOrdemDecrescente()
    {
        $leilao = new Leilao('FIAT 147 0KM');

        $gabriela = new Usuario('Gabriela');
        $rafaela = new Usuario('Rafaela');

        $leilao->recebeLance(new Lance($rafaela, 2500));
        $leilao->recebeLance(new Lance($gabriela, 2000));

        $leiloeiro = new Avaliador();

        //Act - When
        $leiloeiro->avalia($leilao);

        $maiorValor = $leiloeiro->getMaiorValor();

        //Assert - Then
//        $this->assertEquals(2500, $maiorValor);
        //outra maneira de testar
        self::assertEquals(2500, $maiorValor);
    }

    public function testeAvaliadorDeveEncontrarOMenorValorDeLancesEmOrdemDecrescente()
    {
        $leilao = new Leilao('FIAT 147 0KM');

        $gabriela = new Usuario('Gabriela');
        $rafaela = new Usuario('Rafaela');

        $leilao->recebeLance(new Lance($rafaela, 2500));
        $leilao->recebeLance(new Lance($gabriela, 2000));

        $leiloeiro = new Avaliador();

        //Act - When
        $leiloeiro->avalia($leilao);

        $menorValor = $leiloeiro->getMenorValor();

        //Assert - Then
//        $this->assertEquals(2500, $maiorValor);
        //outra maneira de testar
        self::assertEquals(2000, $menorValor);
    }

    public function testeAvaliadorDeveEncontrarOMenorValorDeLancesEmOrdemCrescente()
    {
        $leilao = new Leilao('FIAT 147 0KM');

        $gabriela = new Usuario('Gabriela');
        $rafaela = new Usuario('Rafaela');

        $leilao->recebeLance(new Lance($gabriela, 2000));
        $leilao->recebeLance(new Lance($rafaela, 2500));

        $leiloeiro = new Avaliador();

        //Act - When
        $leiloeiro->avalia($leilao);

        $menorValor = $leiloeiro->getMenorValor();

        //Assert - Then
//        $this->assertEquals(2500, $maiorValor);
        //outra maneira de testar
        self::assertEquals(2000, $menorValor);
    }
}