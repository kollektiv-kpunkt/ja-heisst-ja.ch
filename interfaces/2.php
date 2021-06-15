<?php
include __DIR__ . "/../includes/config.inc.php";
include __DIR__ . "/../includes/conn.inc.php";
include __DIR__ . "/../i18n/{$lang}.php";

$uuid = $_POST["uuid"];
$address = $_POST["address"];
$plz = $_POST["plz"];
$place = $_POST["place"];
if (isset($_POST["phone"])) {
    $phone = $_POST["phone"];
} else {
    $phone = "";
}


$sql = "UPDATE `activists` SET `activist_address` = ?, `activist_plz` = ?, `activist_ort` = ?, `activist_phone` = ? WHERE `activist_UUID` = ?;";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $address, $plz, $place, $phone, $uuid);

$result = $stmt->execute();

if ($result == 1) {
    $response = array(
        "code" => 200,
        "type" => "success",
        "text" => "",
        "uuid" => $uuid
    );
} else {
    $response = array(
        "code" => 1,
        "type" => "error",
        "text" => $i18n["e-unknown"],
        "uuid" => $uuid
    );
}

$stmt = $conn->prepare("SELECT * from `activists` WHERE `activist_UUID` = ?;");
$stmt->bind_param("s", $uuid);
$stmt->execute();
$activist = $stmt->get_result()->fetch_assoc();

ob_start();
require __DIR__ . "/email.php";
$email_template = ob_get_clean();

$tags = array("{fname}", "{WA-link}", "{WA-text}", "{Tele-link}", "{Tele-text}");
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];
$WAlink = "https://api.whatsapp.com/send?text=" . urlencode($i18n["step3-mobitext"] . "\n" . $actual_link);
$Telelink = "https://t.me/share/url?url=" . urlencode($actual_link) . "&text=" . urlencode($i18n["step3-mobitext"] . "\n" . $actual_link);
$replace = array($activist["activist_fname"], $WAlink, $i18n["step3-wa-button"], $Telelink, $i18n["step3-tele-button"]);
$email_content = str_replace($tags, $replace, $email_template);

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require(__DIR__ . '/../vendor/mailer/vendor/autoload.php');


// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = $emailHost;
    $mail->SMTPAuth   = true;
    $mail->Username   = $emailUser;
    $mail->Password   = $emailPwd;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = $emailPort;

    //Recipients
    $mail->setFrom($emailFromEmail, $i18n["email-from"]);
    $mail->addAddress($activist["activist_email"], "{$activist['activist_fname']} {$activist['activist_lname']}");
    $mail->CharSet  = 'UTF-8';

    // Content
    $mail->isHTML(true);
    $mail->Subject = $i18n["email-subject"];
    $mail->Body    = $email_content;

    $mail->send();
} catch (Exception $e) {
    $response = array(
        "code" => 3,
        "type" => "error",
        "text" => "Failed to send E-Mail",
        "uuid" => $uuid
    );
    header('Content-type: application/json');
    echo(json_encode($response));
    exit;
}


header('Content-type: application/json');
echo(json_encode($response));

?>