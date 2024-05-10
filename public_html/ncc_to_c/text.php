<?php

function get_from_nc_commons($filename) {
    $url = "https://nccommons.org/wiki/File:$filename?action=raw";
    $file_text = file_get_contents($url);
    // echo $url;

    $nccommons_link = "[https://nccommons.org/wiki/File:$filename nccommons.org]";
    // find |Source =
    $start = strpos($file_text, "|Source =");
    if ($start === false) {
        $file_text .= "\n\n* $nccommons_link\n";
    } else {
        $start = $start + 10;
        $file_text = substr_replace($file_text, "* $nccommons_link \n*", $start, 0);
    }
    return $file_text;
}

function make_file_text($filename) {
    // trim
    $filename = trim($filename);
    // replace " " with "_"
    $filename = str_replace(" ", "_", $filename);

    // remove "File:" prefix
    $filename = str_replace("File:", "", $filename);


    $text = get_from_nc_commons($filename);

    // remove categories
    $text = preg_replace('/\[\[Category:(.*?)\]\]/', '', $text);

    // add [[Category:Files imported from NC Commons]]
    $text .= "[[Category:Files imported from NC Commons]]\n";
    return $text;
}
