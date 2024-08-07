<?php

require("darkmode.php");
$them_li = dark_mode_icon();

function is_active($page, $id) {
    return $page == $id ? 'active' : '';
}
function header_nav_tag($title="NCCommons to Commons", $page='', $log_lis='') {
    global $them_li;

    $ncc_to_c_active = is_active($page, 'ncc_to_c');
    // ---
    $login_logout_lis = <<<HTML
        <li class="nav-item col col-lg-auto dropdown">
            <div id="user_login" class="navbar-text">
                <a href="auth.php?a=login"><i class="fas fa-sign-in-alt fa-sm fa-fw mr-2"></i> Login</a>
            </div>
        </li>
        <li class="nav-item col col-lg-auto dropdown">
            <div id="user_li" class="navbar-text" style="display:none">
                <i class="fas fa-user fa-sm fa-fw mr-2"></i> <span id="username" style="color:blue;"></span>
            </div>
        </li>
        <li class="nav-item col col-lg-auto dropdown">
            <div id="user_logout" class="navbar-text" style="display:none">
                <span> </span> <a href="auth.php?a=logout"> <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i></a>
            </div>
        </li>
    HTML;
    // ---
    $login_logout_lis = ($log_lis == '') ? $login_logout_lis : $log_lis;
    // ---
    return <<<HTML
        <header class="mb-3 border-bottom">
            <nav id="mainnav" class="navbar navbar-expand-lg shadow">
                <div class="container-fluid" id="navbardiv">
                    <a class="navbar-brand mb-0 h1" href="index.php" style="color:#0d6efd;">
                        $title
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar"
                        aria-controls="collapsibleNavbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavbar">
                        <ul class="navbar-nav flex-row flex-wrap bd-navbar-nav">
                            <li class="nav-item col-4 col-lg-auto">
                                <a class="nav-link py-2 px-0 px-lg-2" href="https://nccommons.org/" target="_blank">
                                    <span class="navtitles">NC Commons</span>
                                </a>
                            </li>
                            <li class="nav-item col-4 col-lg-auto $ncc_to_c_active" id="ncc_to_c">
                                <a class="nav-link py-2 px-0 px-lg-2 $ncc_to_c_active" href="../ncc_to_c/index.php">
                                    <span class="navtitles">NC Commons to Commons</span>
                                </a>
                            </li>
                            <li class="nav-item col-4 col-lg-auto">
                                <a class="nav-link py-2 px-0 px-lg-2" href="https://github.com/MrIbrahem/Multi-CropTool" target="_blank">
                                    <span class="navtitles">Github</span>
                                </a>
                            </li>
                        </ul>
                        <hr class="d-lg-none text-black-50">
                        <ul class="navbar-nav flex-row flex-wrap bd-navbar-nav ms-lg-auto">
                            <li class="nav-item col col-lg-auto dropdown">
                                $them_li
                            </li>
                            $login_logout_lis
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
    HTML;
}
