<?php

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;

require 'vendor/autoload.php';

//Arrange - Given
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
$valorEsperado = 2500;

if ($valorEsperado == $maiorValor) {
    echo 'TESTE OK' . PHP_EOL;
} else {
    echo 'TESTE FALHOU' . PHP_EOL;
}



