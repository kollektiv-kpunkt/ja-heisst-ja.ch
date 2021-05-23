<?php
header("Location: /");
exit;

if (!isset($_POST['uuid'])) {
    header("Location: /#mitmachen");
}

include "../elements/header.elem.php";

$uuid = $_POST['uuid'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$plz = $_POST['plz'];
$ort = plzlookup($_POST['plz'], $conn);


$query = "INSERT INTO `emails` (emails_UUID, emails_fname, emails_lname, emails_email, emails_plz, emails_ort) VALUES (?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE `emails_UUID` = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("sssssss", $uuid, $fname, $lname, $email, $plz, $ort, $uuid);
$stmt->execute();

$query = "INSERT INTO `locations` (locations_UUID) VALUES (?) ON DUPLICATE KEY UPDATE `locations_UUID` = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $uuid, $uuid);
$stmt->execute();

?>
<script src="/vendor/tinymce/tinymce.min.js" referrerpolicy="origin"></script>

<div class="form-container is-active" id="pers-data">
    <div class="section">
        <div class="sm-cont section-cont">
            <h2 class="form-title"><?= $lang_menu3 ?></h2>
            <p class="form-lead"><?= $lang_mitmachen1 ?></p>
            <form id="sign_step2">
                <input type="text" name="fname" value="<?= $_POST['fname']?>" required>
                <input type="text" name="lname" value="<?= $_POST['lname']?>" required>
                <input type="text" name="email" value="<?= $_POST['email']?>" required>
                <hr style="grid-column: 1 / -1">
                <input type="text" name="adresse" placeholder="<?= $lang_mitmachen1f ?>" value="" style="grid-column: 1 / -1" required>
                <input type="number" name="plz" value="<?= $_POST['plz']?>" required>
                <input type="text" name="ort" value="<?= $ort?>" required>
                <input type="hidden" value="<?= $uuid ?>" name="uuid">
                <button type="submit" id="submit_step2" class="button"><?= $lang_next ?></button>
            </form>
        </div>
    </div>
</div>

<div class="form-container" id="email-data">
    <div class="section">
        <div class="sm-cont section-cont">
            <h2 class="form-title"><?= $lang_mitmachen2t ?></h2>
            <p class="form-lead"><?= $lang_mitmachen2 ?></p>
            <form id="sign_step3">
                <div style="grid-column: 1 / -1">
                    <label for="betreff" class="notop"><?= $lang_mitmachen2betreffT ?></label>
                    <input type="text" name="betreff" value="<?= $lang_mitmachen2betreff ?>" id="betreff" required>
                </div>
                <div style="grid-column: 1 / -1; max-width: 90vw">
                    <label for="email-content"><?= $lang_mitmachen2inhaltT ?></label>
                    <textarea name="content" id="email-content"><?php echo(str_replace(array("{{fname}}", "{{lname}}"), array($fname, $lname), $lang_mitmachen2inhalt)); ?></textarea>
                </div>
                <input type="hidden" value="<?= $uuid ?>" name="uuid">
                <div id="errormsg" class="text_small" style="color: red; grid-column: 1 / -1; display: none"><?= $lang_errormsg_length ?></div>
                <a id="back_step3" style="grid-column: 1" class="button line"><?= $lang_last ?></a>
                <button id="submit_step3" class="button"><?= $lang_next ?></button>
            </form>
        </div>
    </div>
</div>

<div class="form-container" id="end-screen">
    <div class="section" id="form-section">
        <div class="sm-cont section-cont">
            <h2 class="form-title"><?= $lang_mitmachen3t ?></h2>
            <p class="form-lead"><?= $lang_mitmachen3 ?></a></p>
            <form id="sign_step5">
                <input type="hidden" value="<?= $uuid ?>" name="uuid">
                <a id="back_step5" style="grid-column: 1" class="button line"><?= $lang_last ?></a>
                <button id="submit_step5" class="button"><?= $lang_send ?></button>
            </form>
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
<script>
    tinymce.init({
        selector: '#email-content',
        forced_root_block: false,
        height: 400
    });
</script>

<?php
include "../elements/footer.elem.php";
?>