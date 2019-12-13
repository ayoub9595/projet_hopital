<?php
session_start();
require_once("../connection.php");
require_once('../tcpdf/tcpdf.php');

$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetTitle("Historique de congés");
$obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins('10', 60, '10');   //obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
$obj_pdf->setPrintHeader(false);
$obj_pdf->setPrintFooter(false);
$obj_pdf->SetFont('helvetica', '', 10);
$obj_pdf->SetAutoPageBreak(TRUE, 20);	//$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->AddPage();
print_r($_SESSION);
$req = $conn->prepare("select prescription.idPres,prescription.datePres,prescription.genre,prescription.corps,prescription.idP,
utilisateur.nom,utilisateur.prenom from prescription inner join utilisateur on prescription.idP = utilisateur.idU where prescription.idPres=? and genre='radio' and Archive=0 ");
$req->execute(array($_GET["idPres"]));
$results = $req->fetchAll();
$content = '
	<style>

		.paragraph {
			font-size : 14px;
			font-family: "Times New Roman", Times, serif;
			line-height: 1.6;
			
		}
	
	</style>
	';
$content.='Marrakech le:'.$results[0]["datePres"];

$content .= '
	<br /><br /><br /><br /><br /><br /><br />
		
	<h1 style="text-align:center;">ORDONNANCE DE RADIOGRAPHIE</strong></h1>

	';

$content .= '

 <div class="divpar">
 <p class="paragraph"> Je soussigné Dr '.$_SESSION["nom"]." ".$_SESSION["prenom"].'.Je recommande à Mr(Mme/Mlle) '.$results[0]["nom"]." ".$results[0]["prenom"].' les radiographies suivantes: <br><br>'
    .nl2br($results[0]["corps"]).'
 </p>  <br><br><br>';


$content .= ' 

 <div style="padding-top:500px;">
  <h2 style="text-align:center; "> Signature </h2>
  </div>';

$obj_pdf->writeHTML($content);
echo "<br>";
//$obj_pdf->Image('ressources/footer.png', 5, 247, 200, 20, 'PNG', '', '', false, 300, '', false, false, 0, false, false, false);
ob_end_clean();
$obj_pdf->Output('sample.pdf', 'I');
?>