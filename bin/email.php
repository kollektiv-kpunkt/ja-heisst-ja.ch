<?php
session_start();
include "../elements/header.elem.php";
include "../includes/functions.inc.php";
include "../includes/conn.inc.php";

$_SESSION['reas_data'] = $_POST;
$pers_data = $_SESSION['pers_data'];
$email_data = $_SESSION['email_data'];
$reas_data = $_SESSION['reas_data'];
$content = str_replace("<br />", "%0D%0A", $email_data['content']);

?>
<script src="/vendor/tinymce/tinymce.min.js" referrerpolicy="origin"></script>

<div class="section" id="form-section">
	<div class="sm-cont section-cont">
        <h2 class="form-title">Danke, <?= $pers_data['fname'] ?>!</h2>
        <p class="form-lead">Lade hier deine Vernehmlassungsantwort herunter und hänge sie dann dem E-Mail an, um deine Antwort zu senden.</p>
		<div class="buttongrid m-2">
            <a id="antwort-download" class="button" onclick="createPdf()">Herunterladen</a>
            <a class="button line" href="mailto:timothy.oesch@gmail.com?subject=<?= $email_data['betreff'] ?>&body=<?= $content ?>">Senden</a>
        </div>
	</div>
</div>



<style>
    #nav-head {display: none;}
    #scroll-head {display: none;}
</style>
<script>
const { PDFDocument, StandardFonts, rgb } = PDFLib

async function createPdf() {
    const url = '/doc/vorlage.pdf'
    const existingPdfBytes = await fetch(url).then(res => res.arrayBuffer())
  
    const pdfDoc = await PDFDocument.load(existingPdfBytes)
    const helveticaFont = await pdfDoc.embedFont(StandardFonts.Helvetica)
  
    const pages = pdfDoc.getPages()
    const firstPage = pages[0]
    const secondPage = pages[1]
    const { width, height } = firstPage.getSize()
    firstPage.drawText('<?= $pers_data['fname'] ?> <?= $pers_data['lname'] ?>', {
        x: width / 2 + 50,
        y: height / 2 + 300,
        size: 11,
        font: helveticaFont,
        color: rgb(0, 0, 0),
    })
    firstPage.drawText('<?= $pers_data['adresse'] ?>', {
      x: width / 2 + 50,
      y: height / 2 + 285,
      size: 11,
      font: helveticaFont,
      color: rgb(0, 0, 0),
    })
    firstPage.drawText('CH-<?= $pers_data['plz'] ?> <?= $pers_data['ort'] ?>', {
      x: width / 2 + 50,
      y: height / 2 + 270,
      size: 11,
      font: helveticaFont,
      color: rgb(0, 0, 0),
    })
    secondPage.drawText('<?= $pers_data['fname'] ?> <?= $pers_data['lname'] ?>', {
      x: 70,
      y: height / 2 - 200,
      size: 11,
      font: helveticaFont,
      color: rgb(0, 0, 0),
    })
    
    const pdfBytes = await pdfDoc.save()

        // Trigger the browser to download the PDF document
    download(pdfBytes, "Vernehmlassungsantwort_<?= $pers_data['fname'] ?>_<?= $pers_data['lname'] ?>.pdf", "application/pdf");
}


</script>
<?php
include "../elements/footer.elem.php";
?>