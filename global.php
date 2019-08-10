<?php

/**
 * @Author: indran
 * @Date:   2018-09-01 00:55:37
 * @Last Modified by:   indran
 * @Last Modified time: 2018-09-01 16:02:34
 */
?><?php
if (session_status() === PHP_SESSION_NONE){session_start();}

define( 'SYSTEM_NAME', 'surveillance' ); 
define( 'DISPLAY_NAME', 'doctor V1' );
define( 'SYSTEM_ROOT', '/surveillance' );




define( 'KEY', '');
define( 'MAP_KEY', ''); 
define( 'CAPTCHA', ''); 
define( 'MODE', "testing"  );  
define("ENCRYPTION_KEY", "!@1#Y$%^gw&k*");

define("INDEX_NUMBER", 29861);



define( 'FILES', "files_p9DFyy/"  );  
define( 'TEMP_DIR', FILES . "temp/"  );  

define( 'ADMIN', 'admin');
define( 'DOCTOR', 'doctor'); 
define( 'HOSPITAL', 'hospital'); 



function siteURL() {
	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https" : "http"; 
	return $protocol;
} 

$SPROTOCOL = siteURL();

define( 'ROOT',  $SPROTOCOL. ':' . '//' . $_SERVER['SERVER_NAME'] .':' . $_SERVER['SERVER_PORT']  ); 
define( 'DIRECTORY',  SYSTEM_ROOT . '/'); 
define( 'PATH', $SPROTOCOL. '://' . $_SERVER['SERVER_NAME'] .':' . $_SERVER['SERVER_PORT']  . DIRECTORY ); 











define( 'DIRECTORY_ADMIN', DIRECTORY . ADMIN . '/' ); 
define( 'DIRECTORY_DOCTOR', DIRECTORY . DOCTOR . '/' ); 
define( 'DIRECTORY_HOSPITAL', DIRECTORY . HOSPITAL . '/' ); 




define( 'PATH_ADMIN', PATH . ADMIN ); 
define( 'PATH_DOCTOR', PATH . DOCTOR );  
define( 'PATH_HOSPITAL', PATH . HOSPITAL );  










define( 'TERMS__CONDITIONS', '#'); 
define( 'THEME_OWN_BY', '2018 DOCTOR ');






function indexMe ( $index ) {
	$index = INDEX_NUMBER + $index;
	return  $index;
}
function unIndexMe ( $index ) {
	$index = $index - INDEX_NUMBER ;
	return  $index;
}


function setLocation ( $nowPath ){ echo '<script type="text/javascript">location.href = "' . $nowPath . '" ;</script>'; exit(); }
function encrypt($pure_string, $encryption_key = "25c6c7ff3sw5b9979b151f2ds136cd13b0ff") {
	if ($encryption_key == "25c6c7ff3sw5b9979b151f2ds136cd13b0ff") {
		return strtr(base64_encode($pure_string), '+/=', '-_,');
	}
	$iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
	$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	$encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
	return $encrypted_string;
}

/*
 * Returns decrypted original string
 */	
function decrypt($encrypted_string, $encryption_key = "25c6c7ff3sw5b9979b151f2ds136cd13b0ff") {
	if ($encryption_key == "25c6c7ff3sw5b9979b151f2ds136cd13b0ff") {
		return base64_decode(strtr($encrypted_string, '-_,', '+/='));
	}

	$iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
	$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	$decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
	return $decrypted_string;
}


function random_bytes_05($length, $keyspace = 'abcdefghijklmnopqrstuvwxyz234567'){    
	$str = '';
	$keysize = strlen($keyspace);
	for ($i = 0; $i < $length; ++$i) {
		$str .= $keyspace[mt_rand(0,25)];
	}
	return $str;
}  
if (empty($_SESSION[ SYSTEM_NAME .'_token']) || !isset($_SESSION[ SYSTEM_NAME .'_token'] )) {
	$_SESSION[  SYSTEM_NAME . '_token'] = bin2hex(random_bytes_05(32));
}














?>
