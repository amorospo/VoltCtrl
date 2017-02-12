# Voltage monitoring system

Sistema di monitoraggio della tensione elettrica tramite invio di avvisi e allarmi via email. Basato sull'utilizzo di meterN e contatori SDM.

Forum di riferimento: http://www.flanesi.it/forum/viewtopic.php?f=4&t=1916

Per installare:

sudo -s
cd /var/www/MyScripts
gitclone ssgsdgdg
mv VoltCtrl/VoltCtrl.service /etc/systemd/system/VoltCtrl.service
chmod 755 VoltCtrl
chown www-data:www-data VoltCtrl
