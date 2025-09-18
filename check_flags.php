<?php

$flags = [];
$dir = getcwd();
$files = scandir($dir);

foreach ($files as $file) {
    if (!is_dir($file) || in_array($file, ['.', '..', '.git'])) {
        continue;
    }

    $flagPath = "$file/flag";
    if (!file_exists($flagPath)) {
        echo 'No flag file in ' . $file . "\n";
        continue;
    }

    $flag = trim(file_get_contents($flagPath));
    if ($flag === '') {
        echo 'Empty flag in ' . $file . "\n";
        continue;
    }

    echo $flag . ' --- ' . $file . "\n";
    $flags[] = [
        'challenge' => $file,
        'flag' => $flag,
    ];
}
echo "\n";

$length = count($flags);
echo "Total flags found: $length\n";

for ($i = 0; $i < $length; $i++) {
    for ($j = $i + 1; $j < $length; $j++) {
        if ($flags[$i]['flag'] === $flags[$j]['flag']) {
            echo "Duplicate flag found: " . $flags[$i]['flag'] . ' in ' . $flags[$i]['challenge'] . ' and ' . $flags[$j]['challenge'] . "\n";
        }
    }
}
