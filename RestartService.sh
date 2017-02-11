#! /bin/sh

echo Controllo lo stato del servizio
service VoltCtrl status 

sleep 1

echo Ora riavvio il servizio

sleep 0.3

echo Sto riavviando il servizio
sudo service VoltCtrl restart
sleep 1

echo Controlla lo stato del servizio se è attivo e riavviato da pochi secondi
service VoltCtrl status 
sleep 1

echo Se il servizio è LOADED e ACTIVE ed è attivo da pochi secondi tutto è andato per il verso giusto. 
