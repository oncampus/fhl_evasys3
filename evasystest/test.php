<?php
require_once('config.inc');
require_once('lib.inc');



/*
 * ACHTUNG! Diese Datei befindet sich produktiv im Einsatz
 * 
 * Sie dient dazu, nach einem Evasysupdate die Funkionalität der SOAP-Schnittstelle zu testen
 */


$subunit_id=11; // Testbereich
$coursetype_id=8; // Onlinekurs
$form_id=242; // demoeva 

echo '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>SOAP-TEST</title>
<link rel="stylesheet" type="text/css" media="all" href="test.css" />
</head>
<body>';
echo '<strong>Testing SOAP-Service for evaluation.oncampus.de</strong><br/><br/>';

$ok=true;

try {
	$evasys=new Evasys($wsdl, $wsdlheader, $soapuser, $soappass);
	
	if (isset($evasys->client->__soap_fault)) {
		$ok=false;
		echo '<p class="error">Soapclient error!</p>';
		echo '<pre>';
		print_r($evasys->client->__soap_fault);
		echo '</pre>';
	} else {
		echo '<p class="ok">Soapclient ok.</p>';
		echo '<pre>';
		print_r($evasys->client->__default_headers);
		echo '</pre>';		
		
	}
	
} catch (SoapFault $fault) {
	$ok=false;
	echo '<p class="error">Soapclient error!</p>';
	echo '<pre>';
	print_r($fault->detail.' '.$fault->faultstring);
	echo '</pre>';
}	

if ($ok) {
	echo '<strong>Insert User</strong><br/>';
	try {
		$uid=uniqid();
		$new_user=new stdClass();
		$new_user->m_nId='';
		$new_user->m_nType='';
		$new_user->m_sLoginName='';
		$new_user->m_sExternalId='externalid'.$uid;
		$new_user->m_sTitle='';
		$new_user->m_sFirstName='Vorname';
		$new_user->m_sSurName='Nachname'.$uid;
		$new_user->m_sUnitName='';
		$new_user->m_sAddress='';
		$new_user->m_sEmail='';
		$new_user->m_nFbid=$subunit_id;
		$new_user->m_nAddressId='';
		$new_user->m_sPassword='';
		$new_user->m_sPhoneNumber='';
		$new_user->m_aCourses='';
								
		$created_user=$evasys->InsertUser($new_user);
		if (isset($created_user->m_nId)) {
			echo '<p class="ok">Insert User ok.</p>';
			echo '<pre>';
			print_r($created_user);
			echo '</pre>';						
		} else {
			$ok=false;
			echo '<p class="error">Insert User error!</p>';	
		}
		
	} catch (SoapFault $fault) {
		$ok=false;
		echo '<p class="error">User insert error!</p>';
		echo '<pre>';
		print_r($fault->detail.' '.$fault->faultstring);
		echo '</pre>';
	}	

}

if ($ok) {
	echo '<strong>Update User</strong><br/>';
	try {
		$created_user->m_sFirstName='Vorname'.$uid;
		$updated_user=$evasys->UpdateUser($created_user);
		if ($updated_user->m_sFirstName == 'Vorname'.$uid) {
			echo '<p class="ok">Update User ok.</p>';
			echo '<pre>';
			print_r($updated_user);
			echo '</pre>';	
		} else {
			$ok=false;
			echo '<p class="error">Update User error!</p>';	
		}
	} catch (SoapFault $fault) {
		$ok=false;
		echo '<p class="error">User update error!</p>';
		echo '<pre>';
		print_r($fault->detail.' '.$fault->faultstring);
		echo '</pre>';
	}
}

if ($ok) {
	echo '<strong>Delete User</strong><br/>';
	try {
		$userid = $updated_user->m_nId;
		$delresult = $evasys->DeleteUser($userid);
		if ($delresult == true) {
			echo '<p class="ok">Delete User ok.</p>';
		} else {
			$ok=false;
			echo '<p class="error">Delete User error!</p>';			
		}
		
	} catch (SoapFault $fault) {
		$ok=false;
		echo '<p class="error">User delete error!</p>';
		echo '<pre>';
		print_r($fault->detail.' '.$fault->faultstring);
		echo '</pre>';
	}
}

echo '</body></html>';

?>