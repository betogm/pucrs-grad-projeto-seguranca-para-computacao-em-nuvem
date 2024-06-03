<?php

// Retorna o padding para preenchimento
function pkcs7Pad($data, $blockSize) {
    $padding = $blockSize - (strlen($data) % $blockSize);
    return $data . str_repeat(chr($padding), $padding);
}

// Retira o padding
function pkcs7Unpad($data) {
    $padding = ord($data[strlen($data) - 1]);
    if ($padding > strlen($data)) {
        return false; // padding inválido
    }
    if (strspn($data, chr($padding), strlen($data) - $padding) != $padding) {
        return false; // padding inválido
    }
    return substr($data, 0, -$padding);
}

function encryptAES($plaintext, $keyHex, $ivHex) {
    // Converte a chave e o IV de hexadecimal para texto
    $key = hex2bin($keyHex);
    $iv = hex2bin($ivHex);

    // A chave deve ter 16 bytes (128 bits)
    if (strlen($key) !== 16) {
        throw new Exception("A chave deve ter 16 bytes (128 bits).");
    }

    // O IV deve ter 16 bytes
    if (strlen($iv) !== 16) {
        throw new Exception("O vetor de inicialização (IV) deve ter 16 bytes.");
    }

    // Adicionar padding PKCS7 ao plaintext
    $blockSize = 16; // AES block size é de 16 bytes
    $plaintextPadded = pkcs7Pad($plaintext, $blockSize);

    // Encriptar usando AES-128-CTR
    $ciphertext = openssl_encrypt($plaintextPadded, 'aes-128-ctr', $key, OPENSSL_RAW_DATA, $iv);

    return bin2hex($ciphertext);
}

function decryptAES($ciphertextHex, $keyHex, $ivHex) {
    $key = hex2bin($keyHex);
    $iv = hex2bin($ivHex);

    // A chave deve ter 16 bytes (128 bits)
    if (strlen($key) !== 16) {
        throw new Exception("A chave deve ter 16 bytes (128 bits).");
    }

    // O IV deve ter 16 bytes
    if (strlen($iv) !== 16) {
        throw new Exception("O vetor de inicialização (IV) deve ter 16 bytes.");
    }

    // Decodificar texto criptografado em hexadecimal
    // para texto (para ser decriptado no openssl_decrypt)
    $ciphertext = hex2bin($ciphertextHex);

    // Decriptar usando AES-128-CTR
    $decryptedPadded = openssl_decrypt($ciphertext, 'aes-128-ctr', $key, OPENSSL_RAW_DATA, $iv);

    // Remover padding PKCS7
    $decrypted = pkcs7Unpad($decryptedPadded);

    return $decrypted;
}

// Exemplo de uso
$plaintext = $argv[1];
$keyHex = $argv[2];
$ivHex = $argv[3];

$ciphertextHex = encryptAES($plaintext, $keyHex, $ivHex);
echo "Texto encriptado (hex): " . $ciphertextHex . "\n";

$decryptedText = decryptAES($ciphertextHex, $keyHex, $ivHex);
echo "Texto decriptado: " . $decryptedText . "\n";
?>