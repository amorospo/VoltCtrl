#! /bin/sh

sudo rm /var/www/MyScripts/VoltCtrl/chkvar.txt
sleep 1
sudo service VoltCtrl restart
sleep 1
