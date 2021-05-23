<?php
include "./elements/header.elem.php";
?>
<div class="section" id="heroine">
	<div id="heroine-cont" class="sm-cont section-cont">
		<h1 id="h-title"><?= $lang_htitle ?></h1>
		<p class="h-sub"><?= $lang_hsub ?></p>
		<div class="buttongrid center">
			<a class="button neg" href="#mehr"><?= $lang_morebutton ?></a>
			<a class="button neg line" href="/spenden"><?= $lang_mitmachbutton ?></a>
		</div>
	</div>

</div>

<div class="section" id="mehr">
	<div id="sec-1-cont" class="sm-cont section-cont">
		<h2><?= $lang_moretitle ?></h1>
		<p><?= $lang_more ?></p>
		<div id="accordion">
			<div class="wrap">
				<input type="checkbox" id="tab-1" name="tabs">
				<label for="tab-1"><div><?= $lang_t1t ?></div><div class="cross"></div></label>
				<div class="content"><p><?= $lang_t1b ?></p></div>
			</div>
			<div class="wrap">
				<input type="checkbox" id="tab-2" name="tabs">
				<label for="tab-2"><div><?= $lang_t2t ?></div><div class="cross"></div></label>
				<div class="content"><p><?= $lang_t2b ?></p></div>
			</div>
			<!-- <div class="wrap">
				<input type="checkbox" id="tab-3" name="tabs">
				<label for="tab-3"><div><?= $lang_t3t ?></div><div class="cross"></div></label>
				<div class="content"><p><?= $lang_t3b ?></p></div>
			</div> -->
			<div class="wrap">
				<input type="checkbox" id="tab-4" name="tabs">
				<label for="tab-4"><div><?= $lang_t4t ?></div><div class="cross"></div></label>
				<div class="content"><p><?= $lang_t4b ?></p></div>
			</div>
		</div>
		<div class="buttongrid m-2">
			<!-- <a class="button" href="#mitmachen"><?= $lang_mitmachbutton ?></a> -->
			<a class="button line" href="/spenden"><?= $lang_donatebutton ?></a>
		</div>
	</div>
	<div id="bottom-bar">
		<div class="sm-cont" id="bottom-bar-inner">
			<div id="footer-copyright">
				<p class="text_small">© 2020, SP Schweiz</p>
			</div>
			<div id="footer-creds">
				<p class="text_small">Made with ❤️ in Zurich | <a href="/datenschutz" target="_blank">Datenschutz</a> | <a href="https://kpunkt.ch" target="_blank">Development by <strong>K.</strong></a></p>
			</div>
		</div>
	</div>
</div>

<!--<div class="section neg" id="unterstutzerinnen">
	<div id="sec-2-cont" class="md-cont section-cont">
		<h2>Unterstützerinnen</h1>
		<p>Quis sodales pharetra justo, erat vitae nascetur nec eros pretium. Vitae tincidunt vel, leo vel vitae. Iaculis eu nibh at gravida faucibus placerat condimentum nisi, nulla. Sit sociis at sit quis pretium montes, in tempor id. Integer in donec sollicitudin orci, vitae. Sapien magnis libero dignissim massa, elit ultricies vel vitae. Ultrices euismod ante velit mattis nisi risus.</p>
		<div id="support-grid">
		<?php
		/*$query = "SELECT * from `support` WHERE `support_active` IS TRUE LIMIT 0, 10;";
		$results = $conn->query($query);
		foreach ($results as $result) { ?>
			<div class="supporter">
				<div class="sup-img" style="background-image: url(<?= $result['support_img'] ?>)">
				</div>
				<div class="sup-text">
					<p class="sup-name"><?php echo("{$result['support_fname']} {$result['support_lname']}")?></p>
					<p class="sup-position"><?= $result['support_position'] ?></p>
				</div>
			</div>
		<?php }*/ ?>
		</div>
	</div>
</div>-->

<!-- <div class="section" id="mitmachen">
	<div id="sec-3-cont" class="sm-cont section-cont">
		<h2><?= $lang_mitmachbutton ?></h2>
		<p><?= $lang_mitmachen ?></p>
		<p class="text_small" style="margin-top: -1.5em;"><?= $lang_mitmachen_small ?></p>
		<p class="text_small" id="403error" style="color: red; display: none; margin-top: -1.5rem;">Diese E-Mail Adresse wurde bereits verwendet. Cette adresse e-mail a déjà été utilisée. Questo indirizzo e-mail è già stato utilizzato.</p>
		<form action="/support/" method="POST" id="sign_step1">
			<input type="text" name="fname" placeholder="<?= $lang_fname ?>" required>
			<input type="text" name="lname" placeholder="<?= $lang_lname ?>" required>
			<input type="email" name="email" placeholder="<?= $lang_email ?>" required>
			<input type="number" name="plz" placeholder="<?= $lang_plz ?>" min="1000" max="9999" required>
			<div>
				<input type="checkbox" name="optin" value="1" id="opt-in" checked>
				<label for="opt-in" class="text_small opt-in"><?= $lang_optin ?></label>
			</div>
			<input type="hidden" name="uuid" value="<?= uniqid('signups_') ?>" required>
			<button type="submit" class="button"><?= $lang_next ?></button>
		</form>
		<p class="text_small"><?= $submitcountlangt ?></p>
	</div>
	<div id="bottom-bar">
		<div class="sm-cont" id="bottom-bar-inner">
			<div id="footer-copyright">
				<p class="text_small">© 2020, SP Schweiz</p>
			</div>
			<div id="footer-creds">
				<p class="text_small">Made with ❤️ in Zurich | <a href="/datenschutz" target="_blank">Datenschutz</a> | <a href="https://kpunkt.ch" target="_blank">Development by <strong>K.</strong></a></p>
			</div>
		</div>
	</div>
</div> -->


<?php

if (isset($_GET["uuid"])){ 
$email_data = getEmail($conn, $_GET["uuid"]);
?>

<div class="section" id="success-overlay">
    <div id="success-inner" class="sm-cont section-cont">
        <div id="success-container">
            <h4><?= $lang_danket ?><?= $email_data["emails_fname"]?>!</h4>
            <p><?= $lang_danke ?></p>
			<a class="button block small" href="https://wa.me/?text=<?= $lang_dankeWA ?>"><?= $lang_dankeWAb ?></a>
			<a class="button block small line" href="https://www.facebook.com/sharer/sharer.php?u=<?= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]"; ?>"><?= $lang_dankeFBb ?></a>
            <a style="color: var(--prim); text-decoration: underline; cursor: pointer" onclick="back()"><em><?= $lang_last ?></em></a>
        </div>
        <script>
            document.getElementsByTagName("html")[0].classList.add("noscroll");
            function back() {
                document.getElementById("success-overlay").classList.add("hidden");
                document.getElementsByTagName("html")[0].classList.remove("noscroll");
                window.history.replaceState({}, document.title, "/");
            }
        </script>
    </div>
</div>

<?php 
$query = "UPDATE `emails` SET `emails_sent`= 1 WHERE `emails_UUID` = ?;";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $_GET["uuid"]);
$stmt->execute();
} ?>


<?php
include "./elements/footer.elem.php";
?>