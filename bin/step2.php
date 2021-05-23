<?php
session_start();
include "../elements/header.elem.php";
include "../includes/conn.inc.php";

$_SESSION['pers_data'] = $_POST;

?>
<script src="/vendor/tinymce/tinymce.min.js" referrerpolicy="origin"></script>

<div class="section" id="form-section">
	<div class="sm-cont section-cont">
        <h2 class="form-title">Deine E-Mail</h2>
        <p class="form-lead">Verfasse deine E-Mail an das Amt:</p>
		<form id="#sign_step2" action="step3.php" method="POST">
            <div style="grid-column: 1 / -1">
                <label for="betreff" class="notop">Betreff:</label>
                <input type="text" name="betreff" value="Vernehmlassungsantwort XYZ" id="betreff" required>
            </div>
            <div style="grid-column: 1 / -1; max-width: 90vw">
                <label for="email-content">Deine Nachricht:</label>
                <textarea name="content" id="email-content">Gesch&auml;tzte Damen und Herren,<br><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.<br><br><?= $_POST['fname']?> <?= $_POST['lname']?></textarea>
            </div>
            <button type="submit" class="button">Weiter</button>
        </form>
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
<script>
    tinymce.init({
        selector: '#email-content',
        forced_root_block: false,
      });
</script>
<?php
include "../elements/footer.elem.php";
?>