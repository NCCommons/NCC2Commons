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
if (!getenv('INIFILE')) {
    $ROOT_PATH = explode('public_html', __FILE__)[0];
    //---
    $inifile = $ROOT_PATH . '/confs/OAuthConfig_commons_new.ini';
    //---
    // set evnironment variables inifile
    putenv("INIFILE=$inifile");
}
//---
require_once __DIR__ . "/../auth/load.php";
