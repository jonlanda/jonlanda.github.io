<?php

$email_from = "absender@domain.de";   //Absender falls keiner angegeben wurde
$sendermail_antwort = true;      //E-Mail Adresse des Besuchers als Absender. false= Nein ; true = Ja
$name_von_emailfeld = "Email";   //Feld in der die Absenderadresse steht

$empfaenger = "jonlanda06@gmail.com"; //Empfänger-Adresse
$mail_cc = ""; //CC-Adresse, diese E-Mail-Adresse bekommt einer weitere Kopie
$betreff = "Neue Kontaktanfrage"; //Betreff der Email

$url_ok = "/Webshop/contact/"; //Zielseite, wenn E-Mail erfolgreich versendet wurde
$url_fehler = "/Webshop/contact/fehler.html"; //Zielseite, wenn E-Mail nicht gesendet werden konnte



$ignore_fields = array('submit');


$name_tag = array("Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag");
$num_tag = date("w");
$tag = $name_tag[$num_tag];
$jahr = date("Y");
$n = date("d");
$monat = date("m");
$time = date("H:i");

$msg = ":: Gesendet am $tag, den $n.$monat.$jahr - $time Uhr ::\n\n";


foreach($_POST as $name => $value) {
if (in_array($name, $ignore_fields)) {

}
$msg .= "::: $name :::\n$value\n\n";
}

if ($sendermail_antwort and isset($_POST[$name_von_emailfeld]) and filter_var($_POST[$name_von_emailfeld], FILTER_VALIDATE_EMAIL)) {
$email_from = $_POST[$name_von_emailfeld];
}

$header="From: $email_from";

if (!empty($mail_cc)) {
$header .= "\n";
$header .= "Cc: $mail_cc";
}

$header .= "\nContent-type: text/plain; charset=utf-8";

$mail_senden = mail($empfaenger,$betreff,$msg,$header);

if($mail_senden){
header("Location: ".$url_ok);
exit();
} else{
header("Location: ".$url_fehler);
exit();
}