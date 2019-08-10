<?php include_once('global.php'); ?>
<?php

$authentication = true;

if (empty($_SESSION[ SYSTEM_NAME .'_token']) || !isset($_SESSION[ SYSTEM_NAME .'_token'] )) {
	$_SESSION[  SYSTEM_NAME . '_token'] = bin2hex(random_bytes(32));
}

header('Content-Type: application/json');
$headers = apache_request_headers();
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

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
	echo json_encode(array('success'=> -1 ,
		'data' => "errror",
		'remark' => "Empty and/or invalid CSRF token." ));	 
	exit( );
}



if (!isset($_SESSION[SYSTEM_NAME.'userid0']) || !isset($_SESSION[SYSTEM_NAME.'userid']) || !isset($_SESSION[SYSTEM_NAME.'type'])) {
	echo json_encode(array('success'=> -1 ,
		'data' => "errror",
		'remark' => "access denied due to invalid authentication." ));	 
	exit( );
}



$returnArray = array('success' => 0, 
	'data' => null,
	'remark' => "Nothing here.");




// admin only 
if( isset($_POST['action']) &&  IS_AJAX  &&  decrypt($_SESSION[ SYSTEM_NAME .'type' ]) == 'admin' ) {

	include_once( 'root/admin_processes.php' ); 

	switch( $_POST['action'] ) { 

		case 'check-user': 
		$returnArray = checkUser( 'admin' );
		break;

		case 'set-profile':  


		$name = $_POST['name'];  
		$email = $_POST['email']; 
		$mobile = $_POST['phone']; 
		$image = $_POST['image']; 
		$landline = $_POST['landline']; 
		$address = $_POST['address'];   
		$returnArray = setProfile( $name , $email, $mobile , $landline , $address , $image ,   'admin' );
		break;

		case 'get-profile':   

		$returnArray = getProfile( 'admin' );
		break;




		case 'set-settings':   
		$details = $_POST['details'];   
		$returnArray = setSettings( $details ,  'admin' );
		break;
		case 'get-settings': 
		$returnArray = getSettings( 'admin' );
		break;


		




		case 'get-profile-basic':   

		$returnArray = getProfileBasic( 'admin' );
		break;






		case 'update-dp':    
		$data = $_POST['data'];   
		$returnArray = updateDp( $data ,  'admin' );
		break;

		case 'get-log': 
		$from = $_POST['from'];   
		$limit = $_POST['limit'];   
		$returnArray = getLog( 'admin', $from, $limit  );
		break;




		case 'update-login': 
		$password = $_POST['password'];   
		$newpassword = $_POST['newpassword'];    
		$returnArray = updateLogin( 'admin', $password, $newpassword   );
		break;


		case 'get-login-users':  
		$from = $_POST['from'];   
		$limit = $_POST['limit'];   
		$returnArray = getLoginUsers( 'admin' , $from , $limit );
		break;



		case 'get-new-user-count':   
		$returnArray = getNewUserCount( 'admin'  );
		break;

		case 'get-new-user':  
		$from = $_POST['from'];   
		$limit = $_POST['limit'];   
		$returnArray = getNewUser( 'admin' , $from , $limit );
		break;

		case 'active-new-user':  
		$key = $_POST['key'];    
		$returnArray = activeNewUser( 'admin' , $key  );
		break;
		

		case 'get-existing-user':  
		$from = $_POST['from'];   
		$limit = $_POST['limit'];   
		$returnArray = getExistingUser( 'admin' , $from , $limit );
		break;

		case 'delete-user':  
		$key = $_POST['key'];    
		$delete = $_POST['delete'];    
		$returnArray = deleteUser( 'admin' , $key , $delete );
		break;
		


		case 'get-singe-user':  
		$key = $_POST['key'];    
		$returnArray = getSingeUser( 'admin' , $key  );
		break;
		







		case 'get-added-diseases': 
		$from = $_POST['from'];   
		$limit = $_POST['limit'];   
		$returnArray = getAddedDiseases( 'admin', $from, $limit  );
		break;
		

		case 'get-added-files': 
		$from = $_POST['from'];   
		$limit = $_POST['limit'];   
		$returnArray = getAddedFiles( 'admin', $from, $limit  );
		break;
		
		case 'download-file': 
		$key = $_POST['key'];    
		$returnArray = downloadFilea( 'admin', $key   );
		break;
		

		case 'get-added-diseases-filter-date': 
		$from = $_POST['from'];   
		$to = $_POST['to'];   
		$returnArray = getAddedDiseasesFilterDate( 'admin', $from, $to  );
		break;
		
		case 'add-notification': 
		$expiry = $_POST['expiry'];   
		$type = $_POST['type'];   
		$subject = $_POST['subject'];   
		$description = $_POST['description'];   
		$district = $_POST['district'];   
		$returnArray = addNotification( 'admin', $expiry, $type, $subject, $description, $district  );
		break;
		

		case 'get-notification': 
		$from = $_POST['from'];   
		$to = $_POST['limit'];   
		$returnArray = getNotification( 'admin', $from, $to  );
		break;

		case 'delete-notification':  
		$key = $_POST['key'];    
		$delete = $_POST['delete'];    
		$returnArray = deleteNotification( 'admin' , $key , $delete );
		break;





		default :  
		$returnArray['success'] = 0; 
		$returnArray['remark'] = " server 304 error , refresh page";
		break; 
	}
} 


// staff only 
if( isset($_POST['action']) &&  IS_AJAX  &&  decrypt($_SESSION[ SYSTEM_NAME .'type' ]) == 'doctor' ) {


	include_once( 'root/user_processes.php' ); 

	switch( $_POST['action'] ) { 

		case 'check-user': 
		$returnArray = checkUser( 'doctor' );
		break;

		case 'set-profile':  

		


		$name = $_POST['name'];  
		$mobile = $_POST['mobile']; 
		$email = $_POST['email'];  
		$reg = $_POST['reg'];   
		$address = $_POST['address'];  
		$hospital = $_POST['hospital'];  
		$hospital_type = $_POST['hospital_type'];   
		$district = $_POST['district'];   
		$delete = $_POST['delete'];     
		$returnArray = setProfile($name , $mobile, $email , $reg , $address , $hospital, $hospital_type , $district ,  $delete,  'doctor' );
		break;

		case 'get-profile':    
		$returnArray = getProfile( 'doctor' );
		break;

		case 'get-profile-basic':    
		$returnArray = getProfileBasic( 'doctor' );
		break;


		case 'set-settings':   
		$details = $_POST['details'];   
		$returnArray = setSettings( $details ,  'doctor' );
		break;
		case 'get-settings': 
		$returnArray = getSettings( 'doctor' );
		break;






		case 'update-dp':    
		$data = $_POST['data'];   
		$blobs = null;
		if(isset($_FILES['blobs']))
			$blobs =$_FILES['blobs'];

		$returnArray = updateDp( $data, $blobs ,  'doctor' );
		break;

		case 'get-log': 
		$from = $_POST['from'];   
		$limit = $_POST['limit'];   
		$returnArray = getLog( 'doctor', $from, $limit  );
		break;




		case 'update-login': 
		$password = $_POST['password'];   
		$newpassword = $_POST['newpassword'];    
		$returnArray = updateLogin( 'doctor', $password, $newpassword   );
		break;




		/*===================================================================================================================*/
		/*===================================================================================================================*/
		/*===================================================================================================================*/

		case 'get-diagnosis-list': 

		$returnArray = getDiagnosisList( 'doctor'  );
		break;

		case  'get-tody-surveillance': 

		$returnArray = getTodySurveillance( 'doctor'  );
		break;





		case 'add-surveillance':  
		$data = $_POST['data'];    
		$returnArray = addSurveillance( 'doctor' , $data  );
		break;


		case 'update-today-surveillance':  
		$data = $_POST['data'];    
		$done = $_POST['done'];    
		$id = $_POST['id'];    
		$returnArray = updateTodaySurveillance( 'doctor' , $id, $data, $done  );
		break;
		

		case 'delete-single-today-surveillance':  
		$id = $_POST['id'];    
		$returnArray = deleteSingleTodaySurveillance( 'doctor' , $id  );
		break;

		case 'get-added-diseases': 
		$from = $_POST['from'];   
		$limit = $_POST['limit'];   
		$returnArray = getAddedDiseases( 'doctor', $from, $limit  );
		break;
		

		case 'add-file':    
		$description = $_POST['description'];     
		$files = null;
		if(isset($_FILES))
			$files =$_FILES; 

		$returnArray = addFile( 'doctor', $description, $files  );
		break;		




		case 'get-added-files': 
		$from = $_POST['from'];   
		$limit = $_POST['limit'];   
		$returnArray = getAddedFiles( 'doctor', $from, $limit  );
		break;
		
		case 'download-file': 
		$key = $_POST['key'];    
		$returnArray = downloadFilea( 'doctor', $key   );
		break;
		


		case 'get-notification': 
		$from = $_POST['from'];   
		$to = $_POST['limit'];   
		$returnArray = getNotification( 'admin', $from, $to  );
		break;



		default :  
		$returnArray['success'] = 0; 
		$returnArray['remark'] = " server 304 error , refresh page";
		break; 

	}

}




// staff only 
if( isset($_POST['action']) &&  IS_AJAX  &&  decrypt($_SESSION[ SYSTEM_NAME .'type' ]) == 'hospital' ) {


	include_once( 'root/hospital_processes.php' ); 

	switch( $_POST['action'] ) { 

		case 'check-user': 
		$returnArray = checkUser( 'hospital' );
		break;

		case 'set-profile':  



		$name = $_POST['name'];  
		$mobile = $_POST['mobile']; 
		$email = $_POST['email'];   


		$nname = $_POST['nname'];  
		$nmobile = $_POST['nmobile'];  
		$bed = $_POST['bed'];   
		$htype = $_POST['htype'];   
		$area = $_POST['area'];    
		$city = $_POST['city'];  
		$district = $_POST['district'];  
		$pin = $_POST['pin'];   
		$longitude = $_POST['longitude'];   
		$latitude = $_POST['latitude'];     



		$returnArray = setProfile($name , $mobile, $email  , $nname, $nmobile, $bed, $htype, $area, $city,	$district, $pin, $longitude, $latitude,  'hospital' );
		break;

		case 'get-profile':    
		$returnArray = getProfile( 'hospital' );
		break;

		case 'get-profile-basic':    
		$returnArray = getProfileBasic( 'hospital' );
		break;


		case 'set-settings':   
		$details = $_POST['details'];   
		$returnArray = setSettings( $details ,  'hospital' );
		break;
		case 'get-settings': 
		$returnArray = getSettings( 'hospital' );
		break;






		case 'update-dp':    
		$data = $_POST['data'];   
		$blobs = null;
		if(isset($_FILES['blobs']))
			$blobs =$_FILES['blobs'];

		$returnArray = updateDp( $data, $blobs ,  'hospital' );
		break;

		case 'get-log': 
		$from = $_POST['from'];   
		$limit = $_POST['limit'];   
		$returnArray = getLog( 'hospital', $from, $limit  );
		break;




		case 'update-login': 
		$password = $_POST['password'];   
		$newpassword = $_POST['newpassword'];    
		$returnArray = updateLogin( 'hospital', $password, $newpassword   );
		break;




		/*===================================================================================================================*/
		/*===================================================================================================================*/
		/*===================================================================================================================*/

		case 'get-diagnosis-list': 

		$returnArray = getDiagnosisList( 'hospital'  );
		break;

		case  'get-tody-surveillance': 

		$returnArray = getTodySurveillance( 'hospital'  );
		break;





		case 'add-surveillance':  
		$data = $_POST['data'];    
		$returnArray = addSurveillance( 'hospital' , $data  );
		break;


		case 'update-today-surveillance':  
		$data = $_POST['data'];    
		$done = $_POST['done'];    
		$id = $_POST['id'];    
		$returnArray = updateTodaySurveillance( 'hospital' , $id, $data, $done  );
		break;
		

		case 'delete-single-today-surveillance':  
		$id = $_POST['id'];    
		$returnArray = deleteSingleTodaySurveillance( 'hospital' , $id  );
		break;

		case 'get-added-diseases': 
		$from = $_POST['from'];   
		$limit = $_POST['limit'];   
		$returnArray = getAddedDiseases( 'hospital', $from, $limit  );
		break;
		

		case 'add-file':    
		$description = $_POST['description'];     
		$files = null;
		if(isset($_FILES))
			$files =$_FILES; 

		$returnArray = addFile( 'hospital', $description, $files  );
		break;		




		case 'get-added-files': 
		$from = $_POST['from'];   
		$limit = $_POST['limit'];   
		$returnArray = getAddedFiles( 'hospital', $from, $limit  );
		break;
		
		case 'download-file': 
		$key = $_POST['key'];    
		$returnArray = downloadFilea( 'hospital', $key   );
		break;
		



		case 'get-notification': 
		$from = $_POST['from'];   
		$to = $_POST['limit'];   
		$returnArray = getNotification( 'admin', $from, $to  );
		break;



		default :  
		$returnArray['success'] = 0; 
		$returnArray['remark'] = " server 304 error , refresh page";
		break; 

	}

}





















echo json_encode($returnArray); 
?>