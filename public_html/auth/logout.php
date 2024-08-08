<?php

session_start();
session_destroy();
setcookie('username', '', time() - 3600, "/", $tool_domain, true, true);
setcookie('access_key', '', time() - 3600, "/", $tool_domain, true, true);
setcookie('access_secret', '', time() - 3600, "/", $tool_domain, true, true);
// echo "You are now logged out. <a href='auth.php?a=index'>Log in.</a>";

// return to the previous page
$return_to = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/index.php';

// echo json_encode($_SERVER);
header("Location: $return_to");
