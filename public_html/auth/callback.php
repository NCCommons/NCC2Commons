<?php

use MediaWiki\OAuthClient\Client;
use MediaWiki\OAuthClient\ClientConfig;
use MediaWiki\OAuthClient\Consumer;
use MediaWiki\OAuthClient\Token;

if (!isset($_GET['oauth_verifier'])) {
	echo "This page should only be access after redirection back from the wiki.";
	echo <<<HTML
		Go to this URL to authorize this tool:<br />
		<a href='auth.php?a=login'>Login</a><br />
	HTML;
	exit(1);
}

// Configure the OAuth client with the URL and consumer details.
$conf = new ClientConfig($oauthUrl);
$conf->setConsumer(new Consumer($consumerKey, $consumerSecret));
$conf->setUserAgent($gUserAgent);
$client = new Client($conf);

// Get the Request Token's details from the session and create a new Token object.
session_start();
$requestToken = new Token(
	$_SESSION['request_key'],
	$_SESSION['request_secret']
);

// Send an HTTP request to the wiki to retrieve an Access Token.
$accessToken1 = $client->complete($requestToken, $_GET['oauth_verifier']);

// At this point, the user is authenticated, and the access token can be used to make authenticated
// API requests to the wiki. You can store the Access Token in the session or other secure
// user-specific storage and re-use it for future requests.
// $_SESSION['access_key'] = $accessToken1->key;
add_to_cookie('access_key', $accessToken1->key);

// $_SESSION['access_secret'] = $accessToken1->secret;
add_to_cookie('access_secret', $accessToken1->secret);

// You also no longer need the Request Token.
unset($_SESSION['request_key'], $_SESSION['request_secret']);

// include_once __DIR__ . '/make_user_infos.php';
// The demo continues in demo/edit.php
echo "Continue to <a href='auth.php?a=edit'>edit</a><br>";
echo "Continue to <a href='auth.php?a=index'>index</a><br>";

// $accessToken = new Token($_SESSION['access_key'], $_SESSION['access_secret']);
$accessToken = new Token($accessToken1->key, $accessToken1->secret);

$ident = $client->identify($accessToken);
// Use htmlspecialchars to properly encode the output and prevent XSS vulnerabilities.
echo "You are authenticated as " . htmlspecialchars($ident->username, ENT_QUOTES, 'UTF-8') . ".\n\n";
// ---
// $_SESSION['username'] = $ident->username;

$twoYears = time() + 60 * 60 * 24 * 365 * 2;

add_to_cookie('username', $ident->username);

echo "Continue to <a href='auth.php?a=index'>index</a><br>";

$return_to = $_GET['return_to'] ?? '';
// ---
$test = $_REQUEST['test'] ?? '';
$state = ($test != '') ? "?test=$test" : "";
// ---
$newurl = "/$tool_folder/index.php$state";
// ---
// echo "header('Location: $newurl');<br>";
// ---
// if ($test == '') {
header("Location: $newurl");
// }
