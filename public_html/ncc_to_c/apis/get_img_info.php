<?php

header("Content-type: application/json");

if (isset($_GET['test'])) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}

$usr_agent = 'NCC2Commons/1.0 (https://NCC2Commons.toolforge.org/; tools.NCC2Commons@toolforge.org)';

function get_url_params_result(string $endPoint, array $params = []): string
{
    global $usr_agent;

    $ch = curl_init();
    if (isset($_GET['test'])) {
        $urlx = $endPoint . "?" . http_build_query($params);
        echo $urlx;
    }
    curl_setopt($ch, CURLOPT_URL, $endPoint);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
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

$params = [
    "action" => "query",
    "format" => "json",
    "prop" => "imageinfo",
    "iiprop" => "url",
    "formatversion" => "2"
];

if ($title != '') {
    $title = filter_input(INPUT_GET, 'title', FILTER_SANITIZE_STRING);
    // if title not starts with "File:"
    if (substr($title, 0, 5) != "File:") {
        $title = "File:" . $title;
    }
    $params["titles"] = $title;
    $end_point = "https://nccommons.org/w/api.php";
    // Fetch and echo content
    try {
        $content = get_url_params_result($end_point, $params);
        $data = json_decode($content, true);
        if ($data != null) {
            echo json_encode($data);
        } else {
            json_encode(["error" => "error"]);
        }

    } catch (Exception $e) {
        echo json_encode(["Exception" => $e]);
    };
} else {
    echo json_encode(["error" => "No title provided"]);
}
