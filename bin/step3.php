<?php
session_start();
include "../elements/header.elem.php";
include "../includes/functions.inc.php";
include "../includes/conn.inc.php";

$_SESSION['email_data'] = $_POST;

?>
<script src="/vendor/tinymce/tinymce.min.js" referrerpolicy="origin"></script>

<div class="section" id="form-section">
	<div class="sm-cont section-cont">
        <h2 class="form-title">Persönliche Gründe</h2>
        <p class="form-lead">Wenn du möchtest, kannst du hier noch persönliche Gründe für deine Vernehmlassungsantwort verfassen:</p>
		<form id="#sign_step3" action="email.php" method="POST">
            <div style="grid-column: 1 / -1; max-width: 90vw">
                <textarea name="content" id="reasons-content"></textarea>
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
        selector: '#reasons-content'
      });
</script>
<?php
include "../elements/footer.elem.php";
?>