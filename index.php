<?php
include __DIR__ . "/elements/header.elem.php";

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];

$pledges = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM activists"));

if ($pledges < 200) {
	$goal = 250;
} else if ($pledges < 400) {
	$goal = 500;
} else if ($pledges < 800) {
	$goal = 100;
} else if ($pledges < 1200) {
	$goal = 1600;
} else {
	$goal = 2000;
}

$percentage = round($pledges / $goal * 100, 2);

if ($percentage >= 100) {
    $percentage = 100;
}

$pledges_format = number_format($pledges, 0, ",", "'");
$goal_format = number_format($goal, 0, ",", "'");

?>
<div class="section" id="heroine">
	<div id="heroine-cont" class="sm-cont section-cont">
		<h1 id="h-title"><?= $i18n["h-title"] ?></h1>
		<p class="h-sub"><?= $i18n["h-lead"] ?></p>
		<div class="buttongrid center">
			<a class="button neg" href="#more"><?= $i18n["b_learnmore"] ?></a>
			<a class="button neg line" href="/#<?= $i18n["b_participate"] ?>"><?= $i18n["b_support"] ?></a>
		</div>
	</div>

</div>


<div class="fit-section sm-cont" id="<?= $i18n["b_participate"] ?>">
	<h2><?= $i18n["s1-title"] ?></h2>
	<?= $i18n["s1-content"] ?>
	<div id="progress-container">
		<div id="arrow-container" style="margin-left: 0%">
			<div id="arrow-inner">
				<small><span id="arrow-percentage"></span>%</small>
				<i class="ri-arrow-down-line"></i>
			</div>
		</div>
		<div id="amount-container">
            <small>0</small>
            <small style="color: var(--prim)"><?= $goal_format ?></small>
        </div>
		<div id="progress-outer">
			<div id="progress-inner" style="width: 0%">
			</div>
		</div>
	</div>
	<div class="alert" style="display:none">
		<p>This is the alert message</p>
	</div>
	<form action="" class="ajax-form" data-interface="1.php" data-step="1">
		<select name="anrede" required>
			<option disabled selected value=""><?= $i18n["anrede-select"] ?></option>
			<option value="frau"><?= $i18n["anrede-frau"] ?></option>
			<option value="herr"><?= $i18n["anrede-herr"] ?></option>
			<option value="neutral"><?= $i18n["anrede-neutral"] ?></option>
		</select>
		<input class="input-half" type="text" name="fname" placeholder="<?= $i18n["fname"] ?>" required>
		<input class="input-half" type="text" name="lname" placeholder="<?= $i18n["lname"] ?>" required>
		<input type="email" name="email" placeholder="<?= $i18n["email"] ?>" required>
		<input type="hidden" name="uuid" value="<?= uniqid("activist_") ?>">
		<button class="button" type="submit"><?= $i18n["b_participate"] ?></button>
	</form>
	
	<form action="" class="ajax-form" data-interface="2.php" data-step="2" style="display:none">
		<h5 style="margin-top: 0.5rem"><?= $i18n["form_details"] ?></h5>
		<input type="text" name="address" placeholder="<?= $i18n["address"] ?>" required>
		<input class="input-half" type="text" name="plz" placeholder="<?= $i18n["plz"] ?>" required>
		<input class="input-half" type="text" name="place" placeholder="<?= $i18n["place"] ?>" required>
		<input type="text" name="phone" placeholder="<?= $i18n["phone"] ?>">
		<input type="hidden" name="uuid" value="">
		<button class="button" type="submit"><?= $i18n["b_participate"] ?></button>
	</form>
	
	
	<form action="" class="ajax-form" data-step="3" style="display:none">
		<h4 style="margin-top: 0.5rem"><?= $i18n["step3-title"] ?></h4>
		<p style="margin-top:0;"><?= $i18n["step3-content"] ?></p>
		<div class="buttongrid">
			<a class="button" target="_blank" href="https://api.whatsapp.com/send?text=<?= urlencode($i18n["step3-mobitext"] . "\n" . $actual_link)?>"><?= $i18n["step3-wa-button"] ?></a>
			<a class="button line" target="_blank" href="https://t.me/share/url?url=<?= urlencode($actual_link)?>&text=<?= urlencode($i18n["step3-mobitext"] . "\n" . $actual_link)?>"><?= $i18n["step3-tele-button"] ?></a>
		</div>
		<input type="hidden" name="uuid" value="">
	</form>



</div>


<div class="fit-section sm-cont" id="keyring">
	<div id="cta-box">
		<h2><?= $i18n["cta-title"] ?></h2>
		<p><?= $i18n["cta-content"] ?></p>
		<a class="button neg" href="<?= $i18n["cta-link"] ?>" target="_blank"><?= $i18n["cta-button"] ?></a>
	</div>
</div>

<div class="fit-section sm-cont last" id="more">
	<h2><?= $i18n["s2-title"] ?></h2>
	<p><?= $i18n["s2-content"] ?></p>
	<div id="accordion">
		<div class="wrap">
			<input type="checkbox" id="tab-1" name="tabs">
			<label for="tab-1"><div><?= $i18n["s2-q1"] ?></div><div class="cross"></div></label>
			<div class="content"><p><?= $i18n["s2-a1"] ?></p></div>
		</div>
		<div class="wrap">
			<input type="checkbox" id="tab-2" name="tabs">
			<label for="tab-2"><div><?= $i18n["s2-q2"] ?></div><div class="cross"></div></label>
			<div class="content"><p><?= $i18n["s2-a2"] ?></p></div>
		</div>
		<div class="wrap">
			<input type="checkbox" id="tab-3" name="tabs">
			<label for="tab-3"><div><?= $i18n["s2-q3"] ?></div><div class="cross"></div></label>
			<div class="content"><p><?= $i18n["s2-a3"] ?></p></div>
		</div>
	</div>
	<div class="buttongrid m-2">
		<a class="button" href="#<?= $i18n["b_participate"] ?>"><?= $i18n["b_participate"] ?></a>
		<a class="button line" href="/donate"><?= $i18n["donate"] ?></a>
	</div>
</div>

<div id="bottom-bar">
	<div class="sm-cont" id="bottom-bar-inner">
		<div id="footer-copyright">
			<p class="text_small">© <?= date("Y") ?>, SP Schweiz</p>
		</div>
		<div id="footer-creds">
			<p class="text_small">Made with ❤️ in Zurich | <a href="/datenschutz" target="_blank">Datenschutz</a> | <a href="https://kpunkt.ch" target="_blank">Development by <strong>K.</strong></a></p>
		</div>
	</div>
</div>



<script src="/vendor/jquery.countTo.js"></script>
<script>
    setTimeout(() => {
        jQuery('#arrow-percentage').countTo({from: 0, to: <?= $percentage ?>});
        jQuery('#arrow-container').css('margin-left', '<?= $percentage ?>%')
        jQuery('#progress-inner').css('width', '<?= $percentage ?>%')
    }, 250);
</script>


<?php
include "./elements/footer.elem.php";
?>