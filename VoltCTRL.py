#!/usr/bin/python

# Power outage and surges alarm system 

####################################################################################
#### Author: Alessandro Botta - amorospo@yahoo.it				####
####################################################################################

import smtplib
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
import linecache
import time
import os
from Variabili_VoltCTRL import *

def send_msg():
        server = smtplib.SMTP(smtp_S, smtp_P)    
        server.ehlo()
        server.starttls()
        server.login(from_addr, pwd)
        msg = MIMEMultipart()
        msg['From'] = from_addr
        msg['To'] = to_addrs
        msg['Subject'] = "%s - %s" % (site, msg_sbj)              
        msg.attach(MIMEText(msg_obj))
        time.sleep(1)
        server.sendmail(from_addr, to_addrs.split(','), msg.as_string())
	time.sleep(5)
        server.quit()
        time.sleep(lapse)                                 

def chk():
        linecache.checkcache(Volt)

#Let MeterN write first data
time.sleep(10)
file_V = linecache.getline(Volt,3)

# Loop starts
while file_V.startswith(met_V) is True:

	# Reading files and data
       	Volt_num = float((linecache.getline(Volt,3)).replace((''.join([met_V,"("]))," ").replace("*V)"," ").strip())
	time.sleep(1)
       	chk()
        time.sleep(1)

	#Routine in case of POWER OUTAGE
	if Volt_num <= BlackOut:
        	msg_sbj = 'POWER OUTAGE WARNING!!!'		#Email subject
               	msg_obj = ('Warning! Power is down. Voltage is now: {0:0.1f} Volt'.format(Volt_num))	#Email text
		send_msg()
		while True: 
			if Volt_num <= BlackOut:
                       		time.sleep(5)
		        	Volt_num = float((linecache.getline(Volt,3)).replace((''.join([met_V,"("]))," ").replace("*V)"," ").strip())
				chk()
			else:
				#routine Power Outage end
				if Volt_num < HiV and Volt_num > LowV:	
		        		msg_sbj = 'POWER OUTAGE ENDS'		#Email subject
                			msg_obj = ('Alarm ends. Power is up! Voltage is now: {0:0.1f} Volt'.format(Volt_num))	#Email text
					send_msg()
					break
				else:
					time.sleep(2)
				       	Volt_num = float((linecache.getline(Volt,3)).replace((''.join([met_V,"("]))," ").replace("*V)"," ").strip())
					chk()
                       	        	break

	#routine Low voltage alarm
	elif Volt_num > BlackOut and Volt_num <= LowV:	
        	msg_sbj = 'Voltage anomaly'			#Email subject
               	msg_obj = ('Warning! Voltage is too low : {0:0.1f} Volt'.format(Volt_num))	#Email text
		send_msg()
		while True:
   	   		if Volt_num > BlackOut and Volt_num <= LowV:				
	               		time.sleep(5)
		        	Volt_num = float((linecache.getline(Volt,3)).replace((''.join([met_V,"("]))," ").replace("*V)"," ").strip())
				chk()
                        else:	
				#routine Low voltage alarm end
				if Volt_num < HiV and Volt_num > LowV:
                           		msg_sbj = 'Voltage anomaly ends'		#Email subject
                                       	msg_obj = ('Anomaly ends. Voltage is OK: {0:0.1f} Volt'.format(Volt_num))	#Email text
					send_msg()
                              		break
				else:
					time.sleep(2)
				        Volt_num = float((linecache.getline(Volt,3)).replace((''.join([met_V,"("]))," ").replace("*V)"," ").strip())
					chk()
                                       	break
	
	#routine High voltage alarm
	elif Volt_num >= HiV:
        	msg_sbj = 'Voltage anomaly'			#Email subject
               	msg_obj = ('Warning! Voltage is too high: {0:0.1f} Volt'.format(Volt_num))	#Email text
		send_msg()
		while True:
  			if Volt_num >= HiV:
				time.sleep(5)
		        	Volt_num = float((linecache.getline(Volt,3)).replace((''.join([met_V,"("]))," ").replace("*V)"," ").strip())
				chk()
                        else:
				#routine High voltage alarm end
				if Volt_num < HiV and Volt_num > LowV:	
                               		msg_sbj = 'Voltage anomaly ends'		#Email subject
             	                    	msg_obj = ('Anomaly ends. Voltage is OK: {0:0.1f} Volt'.format(Volt_num))	#Email text
					send_msg()
                              		break
				else:
					time.sleep(2)
			        	Volt_num = float((linecache.getline(Volt,3)).replace((''.join([met_V,"("]))," ").replace("*V)"," ").strip())
					chk()
	                               	break

	#Routine normal Voltage
	else:	
		time.sleep(lapse)
	       	Volt_num = float((linecache.getline(Volt,3)).replace((''.join([met_V,"("]))," ").replace("*V)"," ").strip())
		chk()

#Routine reading file error
else:	
	msg_sbj = 'Voltage control fatal error'                #Email subject
       	msg_obj = ('Error reading file %s. No usuful data to process' % (Volt))       #Email text
       	send_msg()
	while True:
		if file_V.startswith(met_V) is False:	
			file_V = linecache.getline(Volt,3)
			chk()
    			time.sleep(5)
		else:
			execfile(os.path.realpath(__file__))
