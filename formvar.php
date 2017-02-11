<?php
// Recupero i valori inseriti nel form
$site = $_POST['site'];
$Volt = $_POST['Volt'];
$met_V = $_POST['met_V'];
$smtp_S = $_POST['smtp_S'];
$smtp_P = $_POST['smtp_P'];
$from_addr = $_POST['from_addr'];
$pwd = $_POST['pwd'];
$to_addrs = $_POST['to_addrs'];
$BlackOut = $_POST['BlackOut'];
$LowV = $_POST['LowV'];
$HiV = $_POST['HiV'];
$lapse = $_POST['lapse'];

// verifico che tutti i campi siano stati compilati
if (!$site || !$Volt || !$met_V || !$smtp_S || !$smtp_P || !$from_addr || !$pwd || !$to_addrs || !$BlackOut || !$LowV || !$HiV || !$lapse) {
  echo 'Tutti i campi del modulo sono obbligatori!'; 
  echo "<br><a href=\"javascript:history.go(-1)\">Torna indietro e compila i campi vuoti</a>";
}
// verifico che i campi compilati non contengano caratteri nocivi
elseif (!preg_match('/^[A-Za-z0-9_.,@ \'-]+$/i',$site)) {
  echo 'il primo campo contiene caratteri non ammessi';
  echo "<br><a href=\"javascript:history.go(-1)\">Torna indietro e correggi i dati immessi</a>";
}
//elseif (!preg_match('/^[A-Za-z0-9_. \'-]+$/i',$Volt)) {
//  echo 'il secondo campo contiene caratteri non ammessi';
//}
elseif (!preg_match('/^[A-Za-z0-9_., \'-]+$/i',$met_V)) {
  echo 'il terzo campo contiene caratteri non ammessi';
  echo "<br><a href=\"javascript:history.go(-1)\">Torna indietro e correggi i dati immessi</a>";
}
elseif (!preg_match('/^[A-Za-z0-9_., \'-]+$/i',$smtp_S)) {
  echo 'il quarto campo contiene caratteri non ammessi';
  echo "<br><a href=\"javascript:history.go(-1)\">Torna indietro e correggi i dati immessi</a>";
}
elseif (!preg_match('/^[0-9 \'-]+$/i',$smtp_P)) {
  echo 'il quinto campo contiene caratteri non ammessi';
  echo "<br><a href=\"javascript:history.go(-1)\">Torna indietro e correggi i dati immessi</a>";
}
elseif (!preg_match('/^[A-Za-z0-9_.@, \'-]+$/i',$from_addr)) {
  echo 'il sesto campo contiene caratteri non ammessi';
  echo "<br><a href=\"javascript:history.go(-1)\">Torna indietro e correggi i dati immessi</a>";
}
elseif (!preg_match('/^[A-Za-z0-9_.@, \'-]+$/i',$pwd)) {
  echo 'il settimo campo contiene caratteri non ammessi';
  echo "<br><a href=\"javascript:history.go(-1)\">Torna indietro e correggi i dati immessi</a>";
}
elseif (!preg_match('/^[A-Za-z0-9_.,@ \'-]+$/i',$to_addrs)) {
  echo 'il ottavo campo contiene caratteri non ammessi';
  echo "<br><a href=\"javascript:history.go(-1)\">Torna indietro e correggi i dati immessi</a>";
}
elseif (!preg_match('/^[0-9 \'-]+$/i',$BlackOut)) {
  echo 'il nono campo contiene caratteri non ammessi';
  echo "<br><a href=\"javascript:history.go(-1)\">Torna indietro e correggi i dati immessi</a>";
}
elseif (!preg_match('/^[0-9 \'-]+$/i',$LowV)) {
  echo 'il decimo campo contiene caratteri non ammessi';
  echo "<br><a href=\"javascript:history.go(-1)\">Torna indietro e correggi i dati immessi</a>";
}
elseif (!preg_match('/^[0-9 \'-]+$/i',$HiV)) {
  echo 'il undicesimo campo contiene caratteri non ammessi';
  echo "<br><a href=\"javascript:history.go(-1)\">Torna indietro e correggi i dati immessi</a>";
}
elseif (!preg_match('/^[0-9 \'-]+$/i',$lapse)) {
  echo 'il dodicesimo campo contiene caratteri non ammessi';
  echo "<br><a href=\"javascript:history.go(-1)\">Torna indietro e correggi i dati immessi</a>";
}else{

//controllo che il file sia accessibile
if (!$apri = fopen ("Variabili_VoltCTRL.py","w+")) {
echo 'Impossibile accedere al file di configurazione. <br><a href=\"javascript:history.go(-1)\">Controlla le impostazione del server e reinvia il modulo</a>';
}else{
$apriw = fopen ("Variabili_VoltCTRL.py","w+");

// Scrivo il file con le variabile che leggerà lo script
fputs($apriw,'site = "' . $site . '"' . "\n");
fputs($apriw,'Volt = "' . $Volt . '"' . "\n");
fputs($apriw,'met_V = "' . $met_V . '"' . "\n");
fputs($apriw,'smtp_S = "' . $smtp_S . '"' . "\n");
fputs($apriw,'smtp_P = ' . $smtp_P . "\n");
fputs($apriw,'from_addr = "' . $from_addr . '"' . "\n");
fputs($apriw,'pwd = "' . $pwd . '"' . "\n");
fputs($apriw,'to_addrs = "' . $to_addrs . '"' . "\n");
fputs($apriw,'BlackOut = ' . $BlackOut . "\n");
fputs($apriw,'LowV = ' . $LowV . "\n");
fputs($apriw,'HiV = ' . $HiV . "\n");
fputs($apriw,'lapse = ' . $lapse . "\n");

//chiudo il file
fclose($apriw);
}

// Mostro un messaggio di conferma all'utente
echo 'File di configurazione correttamente aggiornato.<br>';

//riavvio il servizio per rendere le modifiche effettive
echo 'Devi riavviare il servizio VoltCtrl per rendere effettive le modifiche<br>';
echo "<input type=\"button\" onclick=\"location.href='RestartService.php'\" value=\"Riavvia il servizio\"/>";
echo "<br><a href=\"javascript:history.go(-1)\">Torna indietro</a>";
}
?>
