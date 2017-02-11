<?php
$output = shell_exec('./RestartService.sh');
echo "<pre>$output</pre>";
echo "<br><br><a href=\"javascript:history.go(-2)\">Torna indietro</a>";
//$output = shell_exec('ls -lart');
//echo "<pre>$output</pre>";
?>
