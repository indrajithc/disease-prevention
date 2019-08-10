<?php include_once('global.php'); ?><?php

$authentication = true; 
$header_token = null;

$headers = apache_request_headers();

if (isset($headers['CsrfToken'])) { 	
	$header_token = $headers['CsrfToken'];
} else if (isset($headers['Csrftoken'])) { 
	$header_token = $headers['Csrftoken'];
}  

header('Content-Type: application/json');
$headers = apache_request_headers();
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');




if (empty($_SESSION[ SYSTEM_NAME .'_token'])) {
	$_SESSION[  SYSTEM_NAME . '_token'] = bin2hex(random_bytes(32));
}

if (isset($headers['CsrfToken'])) { 	
	if ($headers['CsrfToken'] !== $_SESSION[ SYSTEM_NAME .'_token' ] ) 
		$authentication = false;
} else if (isset($headers['Csrftoken'])) { 	
	if ( $headers['Csrftoken'] !== $_SESSION[ SYSTEM_NAME .'_token' ]) 
		$authentication = false;
} else {	
	$authentication = false;
}

if( !$authentication ) {

	if ( !isset( $_POST['username'] ) && !isset( $_POST['password'] ) ) {
		echo json_encode(array('success'=> -1 , 
			'remark' => "Invalid CSRF token or Timeout , refresh page " ));	 
		exit(json_encode(['error' => 'Empty and/or Wrong CSRF token.']));
	}



}



function get_client_ip() {
	$ipaddress = '';
	if (isset($_SERVER['HTTP_CLIENT_IP']))
		$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else if(isset($_SERVER['HTTP_X_FORWARDED']))
		$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
		$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	else if(isset($_SERVER['HTTP_FORWARDED']))
		$ipaddress = $_SERVER['HTTP_FORWARDED'];
	else if(isset($_SERVER['REMOTE_ADDR']))
		$ipaddress = $_SERVER['REMOTE_ADDR'];
	else
		$ipaddress = 'UNKNOWN';
	return $ipaddress;
}




function incrementalHash($len = 5){
	$seed = str_split('abcdefghijklmnopqrstuvwxyz'
		.'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
		.'0123456789');  
	shuffle($seed);  
	$rand = '';
	foreach (array_rand($seed, $len) as $k) $rand .= $seed[$k];
	return$rand;
}


// -2 Invalid Username or Password  


$returnArray = array('success' => -2, 
	'data' => null,
	'remark' => "Invalid Username or Password");


if( isset($_POST['action']) &&  IS_AJAX  ) {

	include_once( 'root/connection.php' );  
	// include_once( 'mail.php' );  

	try { 
		global $a;
		$a = new Database();

	} catch (Exception $e) {

	}

	try {
		date_default_timezone_set("Asia/Kolkata");
	} catch (Exception $e) {

	}




	function adminLogin ( $username, $password , $type, $header_token ) {


		global $a;
		$authentication = false;
		$returnArray = array('success' => -2, 
			'data' => null,
			'remark' => "Invalid Username or Password");

		$query = 'select * from doc_admin where adm_email = :username and adm_password = :password AND adm_delete =0 AND adm_login = 1 ';
		$userid = 0;
		$params = array(
			':username' =>  $username, 
			':password' =>   hash('sha256',   encrypt($password, KEY) )   
		);  
		$user = $a->display( $query, $params );



		if( $user ) {
			if($user[0]['adm_email'] == $username &&   hash('sha256',   encrypt($password, KEY) )   == $user[0]['adm_password']) {
				$userid = $user[0]['adm_id'];
				$authentication = true;

			} 
		} 


		if( $authentication ){

			$_SESSION[SYSTEM_NAME.'userid0'] = encrypt($user[0]['adm_id']);
			$_SESSION[SYSTEM_NAME.'userid'] = encrypt($username);
			$_SESSION[SYSTEM_NAME.'type'] = encrypt('admin');
			$returnArray['success'] = 1;
			$returnArray['remark'] = "your login successful";


		} 
		if(  $authentication &&   !is_null($header_token) && ($header_token != $_SESSION[SYSTEM_NAME .'_token'] ))
			$_SESSION[ SYSTEM_NAME .'_token' ] = $header_token;




		return  $returnArray;



	}

	function userRegistration($name, $registration_no , $mobile, $email, $password , $header_token) {

		global $a;
		$authentication = false;
		$returnArray = array('success' => -2, 
			'data' => null,
			'remark' => "Invalid data");


		if(strlen($mobile) < 1 && strlen($email) < 1) {

			$returnArray ['success'] = -3; 
			$returnArray ['data'] = '#email'; 
			$returnArray ['remark'] = "one of mobile number or email address is mandatory. ";
			return $returnArray;
		}

		$user = null;
		if(strlen($mobile) > 1 ){

			$query = 'select * from doc_user where use_reg = :doc_reg_no OR use_mobile = :doc_mobile    ';
			$userid = 0;
			$params = array(
				':doc_reg_no' =>  $registration_no, 
				':doc_mobile' =>  $mobile 
			);  
			$user = $a->display( $query, $params );
		}

		
		if(strlen($email) > 1 ){

			$query = 'select * from doc_user where use_reg = :doc_reg_no  OR use_email = :use_email   ';
			$userid = 0;
			$params = array(
				':doc_reg_no' =>  $registration_no,  
				':use_email' =>  $email
			);  
			$user = $a->display( $query, $params );
		}

		



		if( ! $user ) {





			$query = ' INSERT INTO doc_user ( use_name, use_reg, use_email, use_mobile, use_type, use_password ) VALUES ( :use_name, :use_reg, :use_email, :use_mobile, :use_type, :use_password )   ';
			$userid = 0;
			$params = array(
				':use_name' =>  $name, 
				':use_reg' =>  $registration_no,
				':use_mobile' =>  $mobile,
				':use_email' =>  $email,
				':use_type' => 'doctor', 
				':use_password' =>    hash('sha256',   encrypt($password, KEY) )   
			);  
			$result = $a->execute_query( $query, $params );

			if( $result ) {
				$returnArray ['success'] = 1; 
				$returnArray ['remark'] = "Doctor Registration successful, <br><strong class='pl-2'>  wait for admin verification  </strong>";
			}
			


			

		} else { 

			if($user[0]['use_reg'] == $registration_no ) {
				$returnArray ['success'] = -4; 
				$returnArray ['data'] = '#registration_no'; 
				$returnArray ['remark'] = "Doctor Registration Number Already Exists ";

			} else if($user[0]['use_mobile'] == $mobile ) {
				$returnArray ['success'] = -5; 
				$returnArray ['data'] = '#mobile'; 
				$returnArray ['remark'] = "Doctor mobile number already exists ";

			} else if($user[0]['use_email'] == $email ) {
				$returnArray ['success'] = -6; 
				$returnArray ['data'] = '#email'; 
				$returnArray ['remark'] = "Doctor email address already exists ";

			}

		}


		if(  $authentication &&   !is_null($header_token) && ($header_token != $_SESSION[SYSTEM_NAME .'_token'] ))
			$_SESSION[ SYSTEM_NAME .'_token' ] = $header_token;




		return  $returnArray;


	}

	
	function  hosRegistration($name, $registration_no , $email, $password  , $nname, $nmobile , $bed, $header_token) {


		global $a;
		$authentication = false;
		$returnArray = array('success' => -2, 
			'data' => null,
			'remark' => "Invalid data");


		if( strlen($email) < 1) {

			$returnArray ['success'] = -3; 
			$returnArray ['data'] = '#hemail'; 
			$returnArray ['remark'] = " email address is mandatory. ";
			return $returnArray;
		}


		$query = 'select * from doc_user where use_reg = :doc_reg_no  OR use_email = :use_email   ';
		$userid = 0;
		$params = array(
			':doc_reg_no' =>  $registration_no,  
			':use_email' =>  $email
		);  
		$user = $a->display( $query, $params );

		



		if( ! $user ) {





			$query = ' INSERT INTO doc_user ( use_name, use_reg, use_email, use_type, use_password ) VALUES ( :use_name, :use_reg, :use_email,  :use_type, :use_password )   ';
			$userid = 0;
			$params = array(
				':use_name' =>  $name, 
				':use_reg' =>  $registration_no, 
				':use_email' =>  $email,
				':use_type' => 'hospital', 
				':use_password' =>    hash('sha256',   encrypt($password, KEY) )   
			);  
			$result = $a->execute_query_return_id( $query, $params );

			if( $result >0 ) {
				$returnArray ['success'] = 1; 
				$returnArray ['remark'] = "Hospital Registration successful, <br><strong class='pl-2'>  wait for admin verification  </strong>";

				$query = ' INSERT INTO doc_hospital (use_id, hos_nname, hos_nmobile, hos_bed  ) VALUES ( :use_id, :hos_nname, :hos_nmobile,:hos_bed )   ';
				$userid = 0;
				$params = array(
					':hos_nname' =>  $nname, 
					':hos_nmobile' =>  $nmobile, 
					':use_id' =>  $result ,
					':hos_bed' => $bed
				);  
				$result = $a->execute_query_return_id( $query, $params );

			}
			


			

		} else { 

			if($user[0]['use_reg'] == $registration_no ) {
				$returnArray ['success'] = -4; 
				$returnArray ['data'] = '#hregistration_no'; 
				$returnArray ['remark'] = "Hospital Registration Number Already Exists ";

			}   else if($user[0]['use_email'] == $email ) {
				$returnArray ['success'] = -6; 
				$returnArray ['data'] = '#hemail'; 
				$returnArray ['remark'] = "Hospital email address already exists ";

			}

		}


		if(  $authentication &&   !is_null($header_token) && ($header_token != $_SESSION[SYSTEM_NAME .'_token'] ))
			$_SESSION[ SYSTEM_NAME .'_token' ] = $header_token;




		return  $returnArray;



	}

	function userLogin ( $username, $password , $type, $header_token ) {


		global $a;
		$authentication = false;
		$returnArray = array('success' => -2, 
			'data' => null,
			'remark' => "Invalid Username or Password");

		$query = 'select * from doc_user where (use_email = :use_email OR use_mobile = :use_mobile ) AND use_password = :password AND use_delete =0  ';
		$userid = 0;
		$params = array(
			':use_email' =>  $username, 
			':use_mobile' =>  $username, 
			':password' =>  hash('sha256',   encrypt($password, KEY) )   
		);  
		$user = $a->display( $query, $params );



		if( $user ) {
			if( ($user[0]['use_mobile'] == $username || $user[0]['use_email'] == $username) &&  hash('sha256',   encrypt($password, KEY) )    == $user[0]['use_password']) {
				if( $user[0]['use_login'] == 1 ) {

					$userid = $user[0]['use_id'];
					$authentication = true;

				} else {

					$returnArray['success'] = -3;
					$returnArray['remark'] = " <strong>wait for admin verification !</strong> <br> ".$user[0]['use_type']." account not yet verified by admin! ";

				}
			} 
		} 


		if( $authentication ){

			$_SESSION[SYSTEM_NAME.'userid0'] = encrypt($user[0]['use_id']);
			$_SESSION[SYSTEM_NAME.'userid'] = encrypt($username);
			$_SESSION[SYSTEM_NAME.'type'] = encrypt( $user[0]['use_type'] );
			$returnArray['success'] = 1;
			$returnArray['data'] = $user[0]['use_type'];
			$returnArray['remark'] = "your login successful";


		} 
		if(  $authentication &&   !is_null($header_token) && ($header_token != $_SESSION[SYSTEM_NAME .'_token'] ))
			$_SESSION[ SYSTEM_NAME .'_token' ] = $header_token;




		return  $returnArray;



	}



	switch( $_POST['action'] ) { 

		case 'admin-login':
		$username = $_POST['username']; 
		$password = $_POST['password']; 

		$returnArray = adminLogin($username, $password , 1, $header_token);
		break;

		case 'doctor-registration':
		$name = $_POST['name']; 
		$registration_no = $_POST['registration_no']; 
		$mobile = $_POST['mobile']; 
		$email = $_POST['email']; 
		$password = $_POST['password']; 

		$returnArray = userRegistration($name, $registration_no , $mobile, $email, $password , $header_token);
		break;


		case 'hospital-registration':
		$name = $_POST['name']; 
		$registration_no = $_POST['registration_no'];  
		$email = $_POST['email']; 
		$password = $_POST['password']; 

		$nname = $_POST['nname']; 
		$nmobile = $_POST['nmobile']; 
		$bed = $_POST['bed'];

		$returnArray = hosRegistration($name, $registration_no , $email, $password , $nname, $nmobile, $bed , $header_token);
		break;





		case 'user-login':
		$username = $_POST['username']; 
		$password = $_POST['password']; 

		$returnArray = userLogin($username, $password , 2, $header_token);
		break;







		default :
		$data = null;
		break;		
	}


	echo json_encode($returnArray); 
}  


?>