<?php
//require_once($CFG->dirroot.'/blocks/fhl_evasys3/evasys3_lib.php');

$settings->add(new admin_setting_heading(            
	'headerconfig',            
	get_string('headerconfig', 'block_fhl_evasys3'),            
	get_string('descconfig', 'block_fhl_evasys3'),''        
)); 
$settings->add(new admin_setting_configtext(            
	'fhl_evasys3/wsdl',            
	get_string('configlabel_wsdl', 'block_fhl_evasys3'),            
	get_string('configdesc_wsdl', 'block_fhl_evasys3'),''
));
$settings->add(new admin_setting_configtext(            
	'fhl_evasys3/header',            
	get_string('configlabel_header', 'block_fhl_evasys3'),            
	get_string('configdesc_header', 'block_fhl_evasys3'),''
));
$settings->add(new admin_setting_configtext(            
	'fhl_evasys3/soapuser',            
	get_string('configlabel_soapuser', 'block_fhl_evasys3'),            
	get_string('configdesc_soapuser', 'block_fhl_evasys3'),''
));
$settings->add(new admin_setting_configpasswordunmask(
	'fhl_evasys3/soappass', 
	get_string('configlabel_soappass', 'block_fhl_evasys3'),
	get_string('configdesc_soappass', 'block_fhl_evasys3'), 
	'password'
));
$settings->add(new admin_setting_configtext(            
	'fhl_evasys3/participation_url',            
	get_string('configlabel_participation_url', 'block_fhl_evasys3'),            
	get_string('configdesc_participation_url', 'block_fhl_evasys3'),''
));
