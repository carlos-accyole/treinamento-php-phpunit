<?php

namespace Alura\Leilao\Tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    /**
     * @var Avaliador
     */
    private $leiloeiro;

    protected function setUp(): void
    {
        $this->leiloeiro = new Avaliador();
    }

    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemAleatoria
     * @dataProvider leilaoEmOrdemDecrescente
     */
    public function testeAvaliadorDeveEncontrarOMaiorValorDeLances(Leilao $leilao)
    {
        //Act - When
        $this->leiloeiro->avalia($leilao);

        $maiorValor = $this->leiloeiro->getMaiorValor();

        //Assert - Then
//        $this->assertEquals(2500, $maiorValor);
        //outra maneira de testar
        self::assertEquals(2500, $maiorValor);
    }

    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemAleatoria
     * @dataProvider leilaoEmOrdemDecrescente
     */
    public function testeAvaliadorDeveEncontrarOMenorValorDeLances(Leilao $leilao)
    {
        //Act - When
        $this->leiloeiro->avalia($leilao);

        $menorValor = $this->leiloeiro->getMenorValor();

        //Assert - Then
//        $this->assertEquals(2500, $maiorValor);
        //outra maneira de testar
        self::assertEquals(1700, $menorValor);
    }

    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemAleatoria
     * @dataProvider leilaoEmOrdemDecrescente
     */
    public function testAvaliadorDeveBuscar3MaioresValores(Leilao $leilao)
    {
        $this->leiloeiro->avalia($leilao);

        $maiores = $this->leiloeiro->getMaioresLances();
        $this->assertCount(3, $maiores);
        $this->assertEquals(2500, $maiores[0]->getValor());
        $this->assertEquals(2000, $maiores[1]->getValor());
        $this->assertEquals(1700, $maiores[2]->getValor());

    }

    public function testLeilaoVazioNaoPodeSerAvaliado()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Não é possível avaliar leilão vázio');

        $leilao = new Leilao('Fusca Aaul');
        $this->leiloeiro->avalia($leilao);
    }

    /* --------------- DADOS ---------------  */
    public function leilaoEmOrdemCrescente()
    {
        $leilao = new Leilao('FIAT 147 0KM');

        $gabriela = new Usuario('Gabriela');
        $rafaela = new Usuario('Rafaela');
        $carlos = new Usuario('Carlos');

        $leilao->recebeLance(new Lance($gabriela, 1700));
        $leilao->recebeLance(new Lance($rafaela, 2000));
        $leilao->recebeLance(new Lance($carlos, 2500));

        return [
           'ordem-crescente' => [$leilao]
        ];
    }

    public function leilaoEmOrdemDecrescente()
    {
        $leilao = new Leilao('FIAT 147 0KM');

        $gabriela = new Usuario('Gabriela');
        $rafaela = new Usuario('Rafaela');
        $carlos = new Usuario('Carlos');

        $leilao->recebeLance(new Lance($carlos, 2500));
        $leilao->recebeLance(new Lance($rafaela, 2000));
        $leilao->recebeLance(new Lance($gabriela, 1700));

        return [
            'ordem-decrescente' =>[$leilao]
        ];
    }

    public function leilaoEmOrdemAleatoria()
    {
        $leilao = new Leilao('FIAT 147 0KM');

        $gabriela = new Usuario('Gabriela');
        $rafaela = new Usuario('Rafaela');
        $carlos = new Usuario('Carlos');

        $leilao->recebeLance(new Lance($carlos, 2500));
        $leilao->recebeLance(new Lance($gabriela, 1700));
        $leilao->recebeLance(new Lance($rafaela, 2000));

        return [
            'ordem-aleatoria' => [$leilao]
        ];
    }
}