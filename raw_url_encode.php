<?php

if (empty($argv[1])) {
    echo "Usage: php raw_url_encode.php <string>\n";
    exit(1);
}

echo rawurlencode($argv[1]) . "\n";

