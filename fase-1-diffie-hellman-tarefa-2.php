<?php
# PUCRS - Curso Superior de Tecnologia em Gestão da Tecnologia da Informação: Soluções Baseadas em Nuvem
# Trimestre: 06
# Disciplina: Segurança para Computação em Nuvem
# Professores:  Avelino Francisco Zorzo
# Projeto - Fase 1
# Título: Troca de chaves e geração - Diffie Hellman
# Aluno: Huberto Gastal Mayer

// Valores fornecidos
$p = $argv[1];
$g = $argv[2];
$A = $argv[3];
$b = (isset($argv[4]) ? $argv[4] : null);

// Utilizei a API PHP: GNU Multiple Precision ou GMP

// Se não for passado um b, ele é gerado aleatoriamente à seguir
if(is_null($b)) {
    // Geração de valor aleatório b com pelo menos 40 dígitos e menor que p
    // Obs: gmp_random_bits não é seguro (aleatório) suficiente para aplicações reais de criptografia
    do {
        $b = gmp_random_bits(160); // Gera um valor de 40 dígitos (160 bits, 4 bytes) - https://www.php.net/manual/en/function.gmp-cmp.php
    } while (gmp_cmp($b, $p) >= 0); // gmp_cmp compara dois números - https://www.php.net/manual/en/function.gmp-cmp.php
}

// Calcula B = g^b mod p
// gmp_powm — Eleva um número a uma potência com módulo - https://www.php.net/manual/pt_BR/function.gmp-powm
$B = gmp_powm($g, $b, $p);

// Calcula o valor que deverá gerar a chave compartilhada: v = A^b mod p
$v = gmp_powm($A, $b, $p);

// Gera o hash sha256 do valor v:
$h = hash('sha256', gmp_strval($v));

// Pega os primeiros 32 caracteres (4 bits cada um) do valor hex de v
// para ser usado como chave:
$K = substr($h, 0, 32);

// Mostra os valores
// gmp_strval converte os valores GMP binários em strings
echo "\n";
echo "Valor p: " . $p . "\n";
echo "Valor do Gerador g: " . $g . "\n";
echo "Valor A (Alice): " . $A . "\n";
echo "Valor b (Bob): " . gmp_strval($b) . "\n";
echo "Valor B (Bob): B = g^b mod p: " . gmp_strval($B) . "\n";
echo "Valor para gerar a chave v: v = A^b mod p: " . gmp_strval($v) . "\n";
echo "Hash do valor: " . $h . "\n";
echo "chave compartilhada 128 bits: " .$K . "\n";
?>
