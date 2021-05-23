<?php
include "{$_SERVER['DOCUMENT_ROOT']}/includes/conn.inc.php";
include "{$_SERVER['DOCUMENT_ROOT']}/includes/config.inc.php";
include "{$_SERVER['DOCUMENT_ROOT']}/includes/functions.inc.php";
include "{$_SERVER['DOCUMENT_ROOT']}/includes/lang/lang.{$lang}.php";
?>
<!DOCTYPE html>
<html lang="<?=$lang?>" style="--vh:100vh; --vw:100vw; --scpad:5vw; --mcpad:5vw; --lcpad:5vw;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Primary Meta Tags -->
    <title><?= $lang_metatitle ?></title>
    <meta name="title" content="<?= $lang_metatitle ?>">
    <meta name="description" content="<?= $lang_metadescr ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>">
    <meta property="og:title" content="<?= $lang_metatitle ?>">
    <meta property="og:description" content="<?= $lang_metadescr ?>">
    <meta property="og:image" content="/img/og_<?= $lang ?>.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>">
    <meta property="twitter:title" content="<?= $lang_metatitle ?>">
    <meta property="twitter:description" content="<?= $lang_metadescr ?>">
    <meta property="twitter:image" content="/img/og_<?= $lang ?>.png">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/pdf-lib@1.4.0"></script>
    <script src="https://unpkg.com/downloadjs@1.4.7"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="/img/favicon/safari-pinned-tab.svg" color="#36006b">
    <link rel="shortcut icon" href="/img/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#36006b">
    <meta name="msapplication-config" content="/img/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="/vendor/hamburger/hamburger.min.css">
    <link rel="stylesheet" href="/style/style.css">
</head>
    <nav id="nav-head">
        <div class="lg-cont" id="head-cont">
            <a href="/#" style="line-height: 0;height: auto;"><img src="/img/logo_neg_<?=$lang?>.svg"></a>
            <div id="nav-cont">
                <a href="/#mehr"><?= $lang_menu1 ?></a>
                <a href="/spenden"><?= $lang_menu2 ?></a>
                <!--<a href="/#unterstutzerinnen">Unterstützerinnen</a>-->
                <!-- <a class="button neg" href="/#mitmachen"><?= $lang_menu3 ?></a> -->
            </div>
            <div id="m-nav-cont">
                <button class="hamburger hamburger--collapse opensesame" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </nav>
    
    <nav id="scroll-head">
        <div class="lg-cont" id="scroll-head-cont">
            <a href="/#" style="line-height: 0;height: auto;"><img src="/img/logo_<?=$lang?>.svg"></a>
            <div id="scroll-nav-cont">
                <a href="/#mehr"><?= $lang_menu1 ?></a>
                <a href="/spenden"><?= $lang_menu2 ?></a>
                <!--<a href="/#unterstutzerinnen">Unterstützerinnen</a>-->
                <!-- <a class="button" href="/#mitmachen"><?= $lang_menu3 ?></a> -->
            </div>
            <div id="m-scroll-nav-cont">
                <button class="hamburger hamburger--collapse opensesame" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </nav>
<body>


<div id="main-content">