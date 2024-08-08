<?php
//---
if (isset($_REQUEST['test']) || $_SERVER['SERVER_NAME'] == 'localhost') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
};
//---
require_once __DIR__ . "/text.php";
//---
// get the root path from __FILE__ , split before public_html
// split the file path on the public_html directory
$pathParts = explode('public_html', __FILE__);
// the root path is the first part of the split file path
$ROOT_PATH = $pathParts[0];
//---
$tool_folder = "ncc_to_c";
//---
$main_site = "https://ncc2commons.toolforge.org";
//---
$source_site = "nccommons.org";
$target_domain = "commons.wikimedia.org";
//---
$inifile = $ROOT_PATH . '/confs/OAuthConfig_commons_new.ini';
//---
$gUserAgent = 'commonsbeta MediaWikiOAuthClient/1.0';
//---
require_once __DIR__ . "/../auth/load.php";
