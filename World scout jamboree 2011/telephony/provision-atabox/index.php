<?php

// Provisioning file for linksys ata boxes

// Ata sends SERIAL-Number in HTTP-HEADER. 

// if you do this: http://webserver-ip/index.php?mac=$MA
// in the "profile rule" field under admin -> advanced -> provisioning

// MAC of ata is in $_GET["mac"];

include "db.php";
db(true)->connect('localhost','provision','password','provision');

if ( !isset($_GET["mac"] ) ) 
	die("no mac found");

if (!$config = db()->fetchSingle("SELECT * from phones where mac = '%s';",$_GET["mac"]))
	die ("no config found");



echo '<?xml version="1.0" encoding="ISO-8859-1"?>'."\n";
echo '<flat-profile>'."\n";
 
?>
<!-- tag case appears to be important -->
<!-- system, system configuration -->
 	<Admin_Passwd>adminpass</Admin_Passwd>
 	<User_Passwd>userpass</User_Passwd>

<!-- line 1, proxy and registration -->
        <Proxy_1_>SIP-SERVER-IP</Proxy_1_>

<!-- line 1, subscriber information -->
       	<Display_Name_1_><?php echo $config["line1_dn"]; ?></Display_Name_1_>
       	<User_ID_1_><?php echo $config["line1_uid"]; ?></User_ID_1_>
       	<Password_1_><?php echo $config["line1_pwd"]; ?></Password_1_>
       	<Dial_Plan_1_><?php echo $config["line1_dialplan"]; ?></Dial_Plan_1_>

<!-- line 2, proxy and registration -->
       	<Proxy_2_>SIP-SERVER-IP</Proxy_2_>

<!-- line 2, subscriber information -->
       	<Display_Name_2_><?php echo $config["line2_dn"]; ?></Display_Name_2_>
       	<User_ID_2_><?php echo $config["line2_uid"]; ?></User_ID_2_>
       	<Password_2_><?php echo $config["line2_pwd"]; ?></Password_2_>
       	<Dial_Plan_2_><?php echo $config["line2_dialplan"]; ?></Dial_Plan_2_>


</flat-profile>
<!--  Ring and Call Waiting Tone Spec   -->
<Ring_Waveform ua="na">Sinusoid</Ring_Waveform>
<Syslog_Server>Syslog-server-ip</Syslog_Server>

