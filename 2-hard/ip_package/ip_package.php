<?php

function ipToHex($ip)
{
    $ipOctets = split("\.", $ip);
    foreach ($ipOctets as $key => $octet) {
        $ipOctets[$key] = sprintf("%02s", dechex($octet));
    }

    return $ipOctets;
}

function flipBits($decNumber)
{
    $bits = (string) decbin($decNumber);
    for ($i = 0; $i < strlen($bits); $i++) {
        $bits[$i] = ($bits[$i] == "0") ? "1" : "0";
    }

    return bindec($bits);
}

$fileName = $argv[1];
$input = file_get_contents($fileName);
$bytes = split(" ", $input);
$sourceIp = array_shift($bytes);
$destinationIp = array_shift($bytes);

$sourceIpHex = ipToHex($sourceIp);
$destinationIpHex = ipToHex($destinationIp);

$bytes[12] = $sourceIpHex[0];
$bytes[13] = $sourceIpHex[1];
$bytes[14] = $sourceIpHex[2];
$bytes[15] = $sourceIpHex[3];

$bytes[16] = $destinationIpHex[0];
$bytes[17] = $destinationIpHex[1];
$bytes[18] = $destinationIpHex[2];
$bytes[19] = $destinationIpHex[3];

//calculating checksum
$bytes[10] = "00";
$bytes[11] = "00";

$checksum = 0;
for ($i = 0; $i < 20; $i += 2) {
    $checksum += hexdec($bytes[$i].$bytes[$i + 1]);
}

$tmp = dechex($checksum);
$carry = $tmp[0];
$rest = substr($tmp, 1, strlen($tmp));
$checksum = dechex(flipBits(hexdec($carry) + hexdec($rest)));

$bytes[10] = substr($checksum, 0, 2);
$bytes[11] = substr($checksum, 2, 4);

$ipHeaderLength = (hexdec($bytes[0][1]) > 5) ? 24 : 20;

echo join(" ", array_slice($bytes, 0, $ipHeaderLength))."\n";
