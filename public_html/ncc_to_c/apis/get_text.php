<?php

header("Content-type: application/json");

if (isset($_GET['test'])) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}

$usr_agent = 'NCC2Commons/1.0 (https://NCC2Commons.toolforge.org/; tools.NCC2Commons@toolforge.org)';

function get_url_result_curl(string $url): string
{
    global $usr_agent;

    if (isset($_GET['test'])) {
        echo $url;
    }
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
    // curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");

    curl_setopt($ch, CURLOPT_USERAGENT, $usr_agent);

    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);

    $output = curl_exec($ch);
    if ($output === false) {
        error_log('cURL error: ' . curl_error($ch));
        curl_close($ch);
        return '{}'; // Return an empty JSON object or handle error appropriately
    }

    curl_close($ch);

    return $output;
}

$title = $_GET['title'] ?? '';

if ($title != '') {
    $title = filter_input(INPUT_GET, 'title', FILTER_SANITIZE_STRING);
    $url = "https://nccommons.org/wiki/" . $title . "?action=raw";

    // Fetch and echo content
    try {
        $content = get_url_result_curl($url);
        echo $content;
    } catch (Exception $e) {
        echo json_encode(["Exception" => $e]);
    };
} else {
    echo json_encode(["error" => "No title provided"]);
}
