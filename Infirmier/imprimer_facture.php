<?php
session_start();
require_once '../connection.php';
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


$nom_complet=preg_split('/[ ]/',$_POST["patient"]);
$req2= $conn->prepare("select idU from utilisateur where nom= ? and prenom = ?");
$req2->execute(array($nom_complet[0],$nom_complet[1]));
$users= $req2->fetchAll();
$user_id=$users[0]["idU"];
$req=$conn->prepare("select * from depense where idP=? and paye= 0 ");
$req->execute(array($user_id));
$depenses = $req->fetchAll();
function fetchData(){
 $output='';
 global $depenses;
 foreach ($depenses as $depense){
     $output.='<tr>
    <td height="40" align="center">'.$depense["date_dep"].'</td>
    <td height="40" align="center">'.$depense["nom_dep"].'</td>
    <td height="40" align="center">'.$depense["prix_dep"].'</td>
</tr>
     ';
 }
 function somme(){
     global $depenses;
     $somme=0;
     foreach ($depenses as $depense){
         $s=intval($depense["prix_dep"]);
         $somme+=$s;
     }
     return $somme;
 }
 return $output;
}
$content ='<style>

</style>';
$content .= '<div class="">Marrakech le : '.$now = date_create('now')->format('d-m-Y').'</div><br><br><br><br><br><br>';
$content .= '<h1 style="text-align: center">Facture du Patient : '.$_POST["patient"].'</h1> <br><br><br><br><br><br>';
$content .= '
<table border="1">
<tr>
<th height="40" align="center">Date de depense</th>
<th height="40" align="center">Type de depense</th>
<th height="40" align="center">Prix de depense</th>
</tr>';
$content.=fetchData();
$content.'<tr>
</tr>';
$content.='</table><br><br><br><br>';

$content.= '<h2 style="text-align: right" id="test">Montant total à payer est de : '.somme().' DH</h2>';

$obj_pdf->writeHTML($content);
$obj_pdf->Output('sample.pdf', 'I');
