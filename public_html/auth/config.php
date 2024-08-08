<?php
//---
include_once __DIR__ . '/../vendor/autoload.php';
//---
use Defuse\Crypto\Key;
//---
$inifile = getenv('INIFILE');
//---
$ini = parse_ini_file($inifile);
//---
if ($ini === false) {
    header("HTTP/1.1 500 Internal Server Error");
    echo "The ini file:($inifile) could not be read";
    exit(0);
}
if (
    !isset($ini['consumerKey']) ||
    !isset($ini['consumerSecret'])
) {
    header("HTTP/1.1 500 Internal Server Error");
    echo 'Required configuration directives not found in ini file';
    exit(0);
}
// ---
$consumerKey    = $ini['consumerKey'];
$consumerSecret = $ini['consumerSecret'];
$tool_domain    = $ini['tool_domain'] ?? '';
$target_domain  = $ini['target_domain'];
$source_site    = $ini['source_site'];
$main_site      = $ini['main_site'];
$tool_folder    = $ini['tool_folder'];
$gUserAgent     = $ini['gUserAgent'];
// ---
$oauthUrl = 'https://' . $target_domain . '/w/index.php?title=Special:OAuth';
//---
// Make the api.php URL from the OAuth URL.
$apiUrl = preg_replace('/index\.php.*/', 'api.php', $oauthUrl);

// When you register, you will get a consumer key and secret. Put these here (and for real
// applications, keep the secret secret! The key is public knowledge.).

$cookie_key     = $ini['cookie_key'] ?? '';
$cookie_key = Key::loadFromAsciiSafeString($cookie_key);
