<?php

require_once 'vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
date_default_timezone_set('Asia/Jakarta');

$secretKey = $_ENV['SECRET_KEY'];
$consID = $_ENV['CONS_ID'];

function generateKey($secretKey, $consID)
{
    $_TIME_STAMP_ = time();
    return $consID . $secretKey . $_TIME_STAMP_;
}

function encrypt($data, $secretKey, $consID)
{
    $key = generateKey($secretKey, $consID);
    $iv = openssl_random_pseudo_bytes(16);
    $compressedData = \LZCompressor\LZString::compressToEncodedURIComponent(json_encode($data));
    $encrypted = openssl_encrypt($compressedData, 'AES-256-CBC', hex2bin(hash('sha256', $key)), OPENSSL_RAW_DATA, $iv);
    return base64_encode($iv . $encrypted);
}

function decrypt($encryptedText, $secretKey, $consID)
{
    $key = generateKey($secretKey, $consID);
    $decoded = base64_decode($encryptedText);
    $iv = substr($decoded, 0, 16);
    $encryptedData = substr($decoded, 16);
    $decrypted = openssl_decrypt($encryptedData, 'AES-256-CBC', hex2bin(hash('sha256', $key)), OPENSSL_RAW_DATA, $iv);
    $decompressedData = \LZCompressor\LZString::decompressFromEncodedURIComponent($decrypted);
    return json_decode($decompressedData, true);
}

// Membaca data dari file JSON
$jsonData = file_get_contents('sample.json');
$dataToEncrypt = json_decode($jsonData, true);

// Mengambil data dari string
$dataToEncrypt = "Sample Text";

$encryptedText = encrypt($dataToEncrypt, $secretKey, $consID);
echo "Encrypt = " . $encryptedText . "\n\n";

$decryptedData = decrypt($encryptedText, $secretKey, $consID);
print_r($decryptedData);

?>
