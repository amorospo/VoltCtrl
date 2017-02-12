# Voltage monitoring system

Sistema di monitoraggio della tensione elettrica tramite invio di avvisi e allarmi via email. Basato sull'utilizzo di meterN e contatori SDM.

Topic di riferimento: http://www.flanesi.it/forum/viewtopic.php?f=4&t=1916


Per installare:

sudo -s<br>
cd /var/www/MyScripts<br>
gitclone https://github.com/amorospo/VoltCtrl.git<br>
mv VoltCtrl/VoltCtrl.service /etc/systemd/system/VoltCtrl.service<br>
chmod 755 VoltCtrl<br>
chown www-data:www-data VoltCtrl<br>

Una volta installato per prima cosa occorre modificare le variabili a proprio uso e consumo accedendo alla pagina web:<br>
http://localhost/MyScripts/VoltCtrl/Modulo.htm<br>
e seguire le istruzioni a video

Successivamente bisogna abilitare e far partire il servizio all'avvio del sistema:

sudo systemctl enable VoltCtrl<br>
sudo systemctl start VoltCtrl<br>

e poi un bel riavvio del sistema

shutdown -r now<br>
