<?php

include_once __DIR__ . '/public_html/vendor/autoload.php';

use Defuse\Crypto\Key;

if (file_exists('secret-key.txt')) {
    die('Key already exists, will not overwrite.');
}

$key = Key::createNewRandomKey();

file_put_contents('secret-key.txt', $key->saveToAsciiSafeString());

chmod('secret-key.txt', 0600);
