<?php
include "../elements/header.elem.php";
?>

<div class="section">
    <div class="sm-cont section-cont">
        <?= $i18n["privacy1"] ?>
    </div>
</div>
<div id="bottom-bar" class="nofix">
    <div class="sm-cont" id="bottom-bar-inner">
        <div id="footer-copyright">
            <p class="text_small">© 2020, SP Schweiz</p>
        </div>
        <div id="footer-creds">
            <p class="text_small">Made with ❤️ in Zurich | <a href="/datenschutz" target="_blank">Datenschutz</a> | <a href="https://kpunkt.ch" target="_blank">Development by <strong>K.</strong></a></p>
        </div>
    </div>
</div>

<style>
    #nav-head {display: none;}
    #scroll-head {
        top: 0;
        visibility: visible;
        opacity: 1;
    }
</style>
<?php
include "../elements/footer.elem.php";
?>