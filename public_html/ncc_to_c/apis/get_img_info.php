<?php

header("Content-type: application/json");

if (isset($_GET['test'])) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

$usr_agent = 'NCC2Commons/1.0 (https://NCC2Commons.toolforge.org/; tools.NCC2Commons@toolforge.org)';

function get_url_params_result(string $endPoint, array $params = []): string
{
    global $usr_agent;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $endPoint);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
    curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
    curl_setopt($ch, CURLOPT_USERAGENT, $usr_agent);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);

    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}
$title = $_GET['title'] ?? '';

$params = [
    "action" => "query",
    "format" => "json",
    "prop" => "imageinfo",
    "titles" => $title,
    "iiprop" => "url",
    "formatversion" => "2"
];

if ($title != '') {
    $end_point = "https://nccommons.org/w/api.php";
    // Fetch and echo content
    try {
        $content = get_url_params_result($end_point, $params);
        echo $content;
    } catch (Exception $e) {
        echo "{}";
    };
}
