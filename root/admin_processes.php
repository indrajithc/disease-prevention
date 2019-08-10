<?php

/**
 * @Author: indran
 * @Date:   2018-09-01 01:01:20
 * @Last Modified by:   indran
 * @Last Modified time: 2018-11-22 14:38:39
 */  
include_once( 'connection.php' ); 
include_once( 'save_image.php' ); 

try { 
	global $a;
	$a = new Database();

} catch (Exception $e) {

}

try {
	date_default_timezone_set("Asia/Kolkata");
} catch (Exception $e) {

}



/*
*/
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
}/*
*/
function imageToString ( $path , $WIDTH  = 0, $HEIGHT = 0, $QUALITY  = 0) { 

	$type = strtolower(pathinfo($path, PATHINFO_EXTENSION) );
	try {


		if( !($type == 'png' || $type == 'jpg' || $type == 'jpeg' || $type == 'gif'  ) || !file_exists( $path) ){
			$path = 'assets/images/default/no.png';
			$type = pathinfo($path, PATHINFO_EXTENSION); 
		}  

		if( !( $WIDTH  == 0 || $HEIGHT == 0 || $QUALITY == 0) ) {


			$DESTINATION_FOLDER = TEMP_DIR;  

			list($width_orig, $height_orig) = getimagesize($path);
			$ratio_orig = $width_orig/$height_orig;
			if ($WIDTH/$HEIGHT > $ratio_orig) {
				$WIDTH = $HEIGHT*$ratio_orig;
			} else {
				$HEIGHT = $WIDTH/$ratio_orig;
			}

			$filename = basename($path); 
			if ( $type  == "png") {
				$image = imagecreatefromstring(file_get_contents($path));
// $image = imagecreatefrompng($path);
			} else {
				$image = imagecreatefromjpeg($path);
			}

			$bg = imagecreatetruecolor($WIDTH, $HEIGHT);
			imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
			imagealphablending($bg, TRUE);
			imagecopyresampled($bg, $image, 0, 0, 0, 0, $WIDTH, $HEIGHT, $width_orig, $height_orig);
			imagedestroy($image);

			imagejpeg($bg, $DESTINATION_FOLDER.$filename, $QUALITY);
			$bin_string_little = file_get_contents($DESTINATION_FOLDER.$filename); 
			if( file_exists($DESTINATION_FOLDER.$filename ) )
				if(is_writable($DESTINATION_FOLDER.$filename ))
					unlink($DESTINATION_FOLDER.$filename);

				imagedestroy($bg);
				$base64 =   'data:image/' . $type . ';base64,' .  base64_encode($bin_string_little); 

			} else {

				$data = file_get_contents($path);
				$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
			}


		} catch (Exception $e) { 

		}
		return $base64 ;


	}





	function checkUser ( $type ){  
		$returnArray = array('success' => -1, 
			'data' => null,
			'remark' => "session expired, login again "); 

		if(isset($_SESSION[SYSTEM_NAME.'userid']) && isset($_SESSION[SYSTEM_NAME.'type']) )
			if( decrypt($_SESSION[SYSTEM_NAME.'type']) == $type) {
				$returnArray['success'] = 1;
				$returnArray['remark'] = "access granted";
			} 
			return  $returnArray;
		}



		function setProfile($name , $email, $mobile , $landline , $address , $image  , $type ) {

			global $a;

			$returnArray = array('success' => -2, 
				'data' => null,
				'remark' => "Invalid input");

			try{

				$array =  array(
					'adm_name' => $name, 
					'adm_email' => $email, 
					'adm_mobile' => $mobile,  
					'adm_landline' => $landline,  
					'adm_address' => $address ,
					"adm_date" => date("Y-m-d H:i:s")
				);


				$result  = updateTable (' doc_admin ', $array,  ' adm_id = ' . decrypt($_SESSION[SYSTEM_NAME.'userid0']) . ' AND adm_delete = 0 AND adm_login = 1 '  , $a ); 
				$returnArray['success'] = $result;
				$returnArray['remark'] = "data updated successfully";

			} catch (Exception $e) {

				$returnArray['success'] = 2;
				$returnArray['remark'] = "invalid data";
			}



			return  $returnArray;
		}








		function getProfile( $type) {

			global $a;

			$returnArray = array('success' => 0, 
				'data' => null,
				'remark' => "Invalid request");



			try {

				$result  = selectFromTable (' * ', ' doc_admin ',  '  adm_id = ' . decrypt($_SESSION[SYSTEM_NAME.'userid0']) . ' AND adm_delete = 0 AND adm_login =  1  ' , $a ); 
				if( isset($result[0])) {


					$returnArray['success'] = 3;
					$returnArray['data'] = array(

						'name' => $result[0]['adm_name'],
						'phone' => $result[0]['adm_mobile'], 
						'email' => $result[0]['adm_email'],
						'image' => imageToString( $result[0]['adm_image'] , 300, 300, 50 ), 
						'landline' => $result[0]['adm_landline'],
						'address' => $result[0]['adm_address'] 
					);

					$returnArray['remark'] = "data fetching success";


				}



			} catch (Exception $e) {

				$returnArray['success'] = 2;
				$returnArray['remark'] = "invalid request";
			}



			return  $returnArray;

		}

		function updateDp ($data, $type) {
			$done = false;
			$path = null;
			$sitedirectory = FILES . 'admin/images';
			global $a;

			$returnArray = array('success' => 2, 
				'data' => null,
				'remark' => "Invalid input");


			try {
				$path =  saveImageNow($data , $sitedirectory );
				$done = true;
			} catch (Exception $e) {
				$done = false;
			}

			if( $done ) {



				try { 



					$array = array(

						"adm_image"     => $sitedirectory. '/' . $path['image'] ,
						"adm_date" => date("Y-m-d H:i:s")
					);
					$result  = updateTable (' doc_admin ', $array,  ' adm_id = ' . decrypt($_SESSION[SYSTEM_NAME.'userid0']) . ' AND adm_delete = 0 AND adm_login =  1  ' , $a ); 
					$returnArray['success'] = $result;
					$returnArray['remark'] = "image updated successfully";


					$returnArray['data'] = imageToString( $sitedirectory. '/' . $path['image'] , 300, 300, 50 ) ;


				} catch (Exception $e) {

					$returnArray['success'] = 2;
					$returnArray['remark'] = "invalid request";
				}


			}



			return  $returnArray;
		}



		function getProfileBasic ( $type) {

			global $a;

			$returnArray = array('success' => 0, 
				'data' => null,
				'remark' => "Invalid request");



			try {



				$result = selectFromTable (' * ', 'doc_admin ',  ' adm_id = ' . decrypt($_SESSION[SYSTEM_NAME.'userid0']) . ' AND adm_delete = 0 AND  adm_login = 1 '  , $a );
				if( isset($result[0])) {


					$returnArray['success'] = 3;
					$returnArray['data'] = array(
						'name' => $result[0]['adm_name'],
						'mobile' => $result[0]['adm_mobile'], 
						'email' => $result[0]['adm_email'],
						'image' => imageToString( $result[0]['adm_image'] , 300, 300, 50 )
					);

					$returnArray['remark'] = "data fetching success";

				}



			} catch (Exception $e) {

				$returnArray['success'] = 2;
				$returnArray['remark'] = "invalid request";
			}



			return  $returnArray;

		}
		function getLog( $type, $from = 0, $limit = 100 ) {

			global $a;

			$returnArray = array('success' => 0, 
				'data' => null ,
				'remark' => "Invalid request");



			try {


				$result = selectFromTable ('  log.id, log.admin_id, user.username, log.action, log.result, log.remark, DATE_FORMAT(log.date, "%Y-%m-%d") AS day , DATE_FORMAT(log.date, "%H:%i:%s")  time  ', ' `admin_log` log LEFT JOIN admin user ON user.id = log.admin_id ',  ' log.admin_id = ' . decrypt($_SESSION[SYSTEM_NAME.'userid0']) . '  ORDER BY log.date DESC LIMIT  ' .  $limit . '  OFFSET ' . $from   , $a );

				$returnArray['success'] = 3;
				$returnArray['data'] =  $result; 
				$returnArray['remark'] = "data fetching success";


			} catch (Exception $e) {

				$returnArray['success'] = 2;
				$returnArray['remark'] = "invalid request";
			}



			return  $returnArray;

		}



		function updateLogin( $type, $password, $newpassword  ) {
			global $a;

			$returnArray = array('success' => 2, 
				'data' => null,
				'remark' => "Invalid Current Password");

			$authentication = false;


			try {

				$returnArray['data']  =11;

				$result = selectFromTable (' adm_id AS id, adm_email AS username, adm_password AS password ', '   doc_admin   ',  ' adm_id = ' . decrypt($_SESSION[SYSTEM_NAME.'userid0']) . ' AND adm_delete = 0  AND adm_login = 1 AND adm_password = "' .   hash('sha256',   encrypt($password, KEY) )    .  '"   '    , $a );


				if(! is_null( $result))
					if( $result[0]['username'] == decrypt($_SESSION[SYSTEM_NAME.'userid']) &&   $result[0]['id'] == decrypt($_SESSION[SYSTEM_NAME.'userid0']) &&  $result[0]['password'] === hash('sha256',   encrypt($password, KEY) )    ){
						
						$authentication = true; 
					}
				} catch (Exception $e) {
					$authentication = false;
				}
				if( $authentication && ($password === $newpassword)   ) { 
					$returnArray['success'] = 21;
					$returnArray['remark'] = "password has been previously used. please choose a different one.";
					$authentication = false;

				} 
				if( $authentication   ) {


					$array =  array( 
						'adm_password' => hash('sha256',   encrypt($newpassword, KEY) )   , 
						"adm_date" => date("Y-m-d H:i:s")
					);

					try { 

						$result  = updateTable (' doc_admin ', $array,  ' adm_id = ' . decrypt($_SESSION[SYSTEM_NAME.'userid0']) . ' AND adm_delete = 0 AND adm_login = 1  '  , $a );  

						$returnArray['success'] = $result;
						$returnArray['remark'] = "password updated successfully";


					} catch (Exception $e) {

						$returnArray['success'] = 2;
						$returnArray['remark'] = "invalid data";
					}



				}  

				return  $returnArray;
			}
			function checkExistsOrNot ( $status, $table, $column, $value , $where = null) {

				global $a;

				$returnArray = array('success' => 2, 
					'data' => null,
					'remark' => " data doesn't exist");

				$authentication = false;


				try {
					if(is_null($where))
						$where = " $column = $value  ";

					$result = selectFromTable ('*', $table,   $where   , $a );
					$returnArray['success']  =1;
					$returnArray['data'] = $result;
					$returnArray['remark'] = " data exist";


				} catch (Exception $e) {

					$returnArray['success'] = 2;
					$returnArray['remark'] = "invalid request";
				}




				return  $returnArray;

			}






			

			function addSurveillance( $type , $data  ) {



				try {

					var_dump(json_decode($data));

				} catch (Exception $e) {

				}



			}

			function getNewUserCount( $type ) {

				global $a;

				$returnArray = array('success' => 0, 
					'data' => null ,
					'remark' => "Invalid request");



				try {


					$result = selectFromTable (' COUNT(*) AS count ', ' doc_user' , '  use_login = 0     '  , $a );

					$tmpAr = array( );

					if($result)
						foreach ($result as $key => $value) {

							array_push($tmpAr, array(  
								'count' => $value['count']  
							) );

						}



						$returnArray['success'] = 3;
						$returnArray['data'] =  $tmpAr; 
						$returnArray['remark'] = "data fetching success";


					} catch (Exception $e) {

						$returnArray['success'] = 2;
						$returnArray['remark'] = "invalid request";
					}



					return  $returnArray;

				}



				function getNewUser( $type , $from , $limit ) {

					global $a;

					$returnArray = array('success' => 0, 
						'data' => null ,
						'remark' => "Invalid request");



					try {


						$result = selectFromTable (' * ', ' doc_user' , '  use_login = 0   ORDER BY use_date DESC LIMIT  ' .  $limit . '  OFFSET ' . $from   , $a );

						$tmpAr = array( );

						if($result)
							foreach ($result as $key => $value) {

								array_push($tmpAr, array( 
									'index' => $from + 1, 
									'key' => indexMe ($value['use_id'] ),
									'name' => $value['use_name'] ,
									'reg_no' => $value['use_reg'] ,
									'email' => $value['use_email'] ,
									'mobile' => $value['use_mobile'] ,
									'time' => $value['use_date'] ,
									'type' => $value['use_type'] 
								) );

								$from++;
							}



							$returnArray['success'] = 3;
							$returnArray['data'] =  $tmpAr; 
							$returnArray['remark'] = "data fetching success";


						} catch (Exception $e) {

							$returnArray['success'] = 2;
							$returnArray['remark'] = "invalid request";
						}



						return  $returnArray;

					}




					function activeNewUser( $status , $key  ) {
						$nowkye = 0;
						if (is_numeric($key)) {
							$nowkye = unIndexMe($key);
						}

						global $a;

						$returnArray = array('success' => -2, 
							'data' => null,
							'remark' => "Invalid user ");

						try{

							$result = selectFromTable (' * ', ' doc_user ' , ' use_id = ' . $nowkye . ' AND use_delete = 0 AND use_login = 0 '   , $a );

							if($result){


								$array =  array(
									'use_login' => 1,  
									"use_date" => date("Y-m-d H:i:s")
								);


								$result  = updateTable (' doc_user ', $array,  ' use_id = ' . $nowkye . ' AND use_delete = 0 AND use_login = 0 '  , $a ); 
								$returnArray['success'] = $result;
								$returnArray['remark'] = "data updated successfully";



							}


						} catch (Exception $e) {

							$returnArray['success'] = 2;
							$returnArray['remark'] = "invalid data";
						}



						return  $returnArray;
						

					}



					function getExistingUser( $type , $from , $limit ) {
						global $a;

						$returnArray = array('success' => 0, 
							'data' => null ,
							'remark' => "Invalid request");



						try {


							$result = selectFromTable (' * ', ' doc_user' , '  use_login = 1   ORDER BY use_date DESC LIMIT  ' .  $limit . '  OFFSET ' . $from   , $a );

							$tmpAr = array( );

							if($result)
								foreach ($result as $key => $value) {

									array_push($tmpAr, array( 
										'index' => $from + 1, 
										'key' => indexMe ($value['use_id'] ),
										'name' => $value['use_name'] ,
										'reg_no' => $value['use_reg'] ,
										'email' => $value['use_email'] ,
										'mobile' => $value['use_mobile'] ,
										'delete' => $value['use_delete'] ,
										'time' => $value['use_date'] ,
										'type' => $value['use_type'] 
									) );

									$from++;
								}



								$returnArray['success'] = 3;
								$returnArray['data'] =  $tmpAr; 
								$returnArray['remark'] = "data fetching success";


							} catch (Exception $e) {

								$returnArray['success'] = 2;
								$returnArray['remark'] = "invalid request";
							}



							return  $returnArray;
						}


						function  deleteUser( $type , $key , $delete ) {

							if( ! is_null($key))
								$key  = unIndexMe( $key );
							else
								$key = 0;

							$delete = $delete == 0 ? 1 : 0;
							$deleteStatus = $delete == 0 ? 'activated' : 'deleted';


							global $a;

							$returnArray = array('success' => 2, 
								'data' => null,
								'remark' => "Invalid input");



							try { 



								$ifexistornot = checkExistsOrNot ( $type, ' doc_user ', '  use_id', "$key" ); 


								if(! is_null($ifexistornot['data'])) {	 

									$array = array(  
										"use_delete"     => $delete  , 
										"use_date" => date("Y-m-d H:i:s")
									);

									$result  = updateTable (' doc_user ', $array,  "  use_id	= " . $ifexistornot['data'][0]['use_id'] , $a ); 

									if( $ifexistornot['data'][0]['use_type'] == 'doctor')
										$tyo09 = $a->execute_query( " UPDATE  doc_user_details SET usd_delete = $delete  WHERE use_id =" . $ifexistornot['data'][0]['use_id'] );
									if( $ifexistornot['data'][0]['use_type'] == 'hospital')
										$tyo09 = $a->execute_query( " UPDATE  doc_hospital SET hos_delete = $delete  WHERE use_id =" . $ifexistornot['data'][0]['use_id'] );

									$returnArray['success'] = $result;  

									$returnArray['remark'] = "   user successfully " . $deleteStatus ;




								} 

							} catch (Exception $e) {

								$returnArray['success'] = 2;
								$returnArray['remark'] = "invalid request";
							}



							return  $returnArray;


						}


						function getSingeUser( $type , $key  ) {

							$nowkye = 0;
							if (is_numeric($key)) {
								$nowkye = unIndexMe($key);
							}


							global $a;

							$returnArray = array('success' => 0, 
								'data' => null,
								'remark' => "Invalid request");


							try { 

								$result  = selectFromTable (' * ', ' `doc_user`   ',  '  use_id = ' . $nowkye . ' AND   use_login = 1  ' , $a ); 

								if( isset($result[0])) {

									if($result[0]['use_type'] == 'doctor' ) {
										$result  = selectFromTable (' * ', ' `doc_user` u LEFT JOIN doc_user_details d ON d.use_id = u.use_id   ',  '  u.use_id = ' . $nowkye . ' AND   u.use_login = 1  ' , $a ); 
										if( isset($result[0])) {


											$returnArray['success'] = 3;
											$returnArray['data'] = array(


												
												
												'name' => $result[0]['use_name'],
												'mobile' => $result[0]['use_mobile'], 
												'email' => $result[0]['use_email'],
												'reg' => $result[0]['use_reg'],


												'address' => $result[0]['usd_address'],
												'hospital' => $result[0]['usd_hospital'],
												'hospital_type' => $result[0]['usd_hospital_type'],

												'district' => $result[0]['usd_district'], 
												'delete' => $result[0]['usd_delete'],
												'gender' => $result[0]['usd_gender'],
												'type' => $result[0]['use_type'],


												'image' => imageToString( $result[0]['use_image'] , 300, 300, 50 )

											);

											$returnArray['remark'] = "data fetching success";

										} 
									}


									else if($result[0]['use_type'] == 'hospital' ) {

										$result  = selectFromTable (' * ', ' `doc_user` u LEFT JOIN doc_hospital d ON d.use_id = u.use_id   ',  '  u.use_id = ' . $nowkye . ' AND   u.use_login = 1  ' , $a ); 
										if( isset($result[0])) {


											$returnArray['success'] = 3;
											$returnArray['data'] = array(


												'name' => $result[0]['use_name'],
												'mobile' => $result[0]['use_mobile'], 
												'email' => $result[0]['use_email'],
												'reg' => $result[0]['use_reg'],
												'type' => $result[0]['use_type'],


												'nname' => $result[0]['hos_nname'],
												'nmobile' => $result[0]['hos_nmobile'],
												'bed' => $result[0]['hos_bed'],
												'htype' => $result[0]['hos_type'],
												'area' => $result[0]['hos_area'],
												'city' => $result[0]['hos_city'], 
												'district' => $result[0]['hos_district'], 
												'pin' => $result[0]['hos_pin'], 
												'longitude' => $result[0]['hos_longitude'], 
												'latitude' => $result[0]['hos_latitude'], 
												'delete' => $result[0]['hos_delete'],  

												'image' => imageToString( $result[0]['use_image'] , 300, 300, 50 )

											);

											$returnArray['remark'] = "data fetching success";

										} 


									}

								}



							} catch (Exception $e) {

								$returnArray['success'] = 2;
								$returnArray['remark'] = "invalid request";
							}



							return  $returnArray;
						}






						function  getAddedDiseases( $type, $from, $limit  )  {




							global $a;

							$returnArray = array('success' => 0, 
								'data' => null ,
								'remark' => "Invalid request");


							try {




						// echo  ' SELECT * FROM doc_surveillance  WHERE  sur_status = 0 AND sur_added_by= '.decrypt($_SESSION[SYSTEM_NAME.'userid0']).' AND  DATE( sur_report_on ) = CURDATE()  ORDER BY sur_date ASC ';
								$result = selectFromTable (' *, DATE_FORMAT( sur_date , "%d-%m-%Y %r") AS  sur_date  ', ' doc_surveillance ' , ' sur_form IS NOT NULL AND sur_status = 1     ORDER BY sur_date DESC LIMIT ' . $limit . ' OFFSET ' . $from    , $a );
								

								$tmpAr = array( ); 
								if($result)
									foreach ($result as $key => $value) {
										$shjs = $value['sur_form'] ;
										try {
											$shjs = json_decode( $shjs );
											foreach ($shjs as $keyIn => $valueIn) { 
												$valueIn->date = $value['sur_date'];
												$nowAge = $valueIn->age;
												$nowAge = date('Y', strtotime($value['sur_report_on'])) - $nowAge;
												$nowAge = date("Y") - $nowAge;
												$valueIn->age = $nowAge;
												$valueIn->by_id = indexMe($value['sur_added_by']);
												$valueIn->by_name = 	$result = selectFromTable (' use_name ', ' doc_user ' , ' use_id=' . $value['sur_added_by']    , $a );


											}
											$shjs = json_encode($shjs);
										} catch (Exception $e) { var_dump($e->getMessage()); }
										array_push($tmpAr, array( 


											'id' =>  indexMe($value['sur_id']),  
											'data' =>  $shjs ,  
											'is_edit' => 1,
											'server' =>  1


										)); 

										$from++;
									}



									$returnArray['success'] = 3;
									$returnArray['data'] =   $tmpAr ; 
									$returnArray['remark'] = "data fetching success";


								} catch (Exception $e) {

									$returnArray['success'] = 2;
									$returnArray['remark'] = "invalid request";
								}



								return  $returnArray;


							}

							function getAddedFiles( $type, $from, $limit  ) {






								global $a;

								$returnArray = array('success' => 0, 
									'data' => null ,
									'remark' => "Invalid request");



								try {



									$result = selectFromTable (' * ', ' doc_attachment' , ' att_delete = 0 ' .  '   ORDER BY att_date DESC LIMIT  ' .  $limit . '  OFFSET ' . $from   , $a );




									$tmpAr = array( );


									if($result)
										foreach ($result as $key => $value) {

											$fullpath = $value['att_path'] . '/' . $value['att_name'];


//
											$extN =strtolower( pathinfo( $value['att_name'] , PATHINFO_EXTENSION) ); 
											$datacc = false;
											if( strtolower($extN) == 'pdf' || strtolower($extN) == 'doc' || strtolower($extN) == 'docx' || strtolower($extN) == 'odt' ) {
												try { 


													if( ! file_exists($fullpath ) ){
														$fullpath = '../assets/images/default/no.png'; 		
														$datacc = true;	
														$extN = 'image';
													} else{
														$datacc = true; 
														$extN = "application/pdf";
													}



												} catch (Exception $e) {
													$datacc = $e;
												}
											}





											array_push($tmpAr, array(  
												'index' =>$from+1,
												'key' => indexMe($value['att_id'] ), 
												'date' => $value['att_on_date'] , 
												'description' => $value['att_desc'] , 
												'delete' =>  $value['att_delete'] , 
												'type' => $extN ,
												'image' => $datacc  ,
												'by_id' => indexMe($value['att_added_by']),
												'by_name' =>  	$result = selectFromTable (' use_name ', ' doc_user ' , ' use_id=' . $value['att_added_by']    , $a )

											) );

										}



										$returnArray['success'] = 3;
										$returnArray['data'] =  $tmpAr; 
										$returnArray['remark'] = "data fetching success";


									} catch (Exception $e) {

										$returnArray['success'] = 2;
										$returnArray['remark'] = "invalid request";
									}



									return  $returnArray;





								}

								function downloadFilea( $type, $key   ) {


									global $a;

									$returnArray = array('success' => 0, 
										'data' => null ,
										'remark' => "Invalid request");



									try { 
										$syllabus = array();

										$ifexistornot = selectFromTable (' *  ', ' doc_attachment' , " att_delete = 0 AND  att_id = " . unIndexMe($key)    , $a ); 		 
										if($ifexistornot) 
											foreach ($ifexistornot as $key => $valueIn) {
												$fileh = false;

												$datacc = null;
												$extN = null;
												$fileEx = '';


												$fullpath = $valueIn['att_path'] . '/' . $valueIn['att_name'];
												if( !(! file_exists($fullpath ) || strlen($valueIn['att_name']) < 1 )){
													$datacc =  chunk_split(base64_encode(file_get_contents($fullpath))); 

													$extN = mime_content_type ( $fullpath);
													$fileh = true;
													$info = new SplFileInfo( $fullpath );
													$fileEx = $info->getExtension();
												}

												array_push($syllabus, array(
													'status' => $fileh,
													'type' =>  $extN,											
													"file" => $datacc,
													'name' => 'file',
													"extension" => $fileEx
												));
											}



											$returnArray['success'] = 3;
											$returnArray['data'] =  $syllabus[0]; 
											$returnArray['remark'] = "data fetching success";


										} catch (Exception $e) {

											$returnArray['success'] = 2;
											$returnArray['remark'] = "invalid request";
										}



										return  $returnArray;


									}



									function getAddedDiseasesFilterDate( $type , $from, $to  ) {




										global $a;

										$returnArray = array('success' => 0, 
											'data' => null ,
											'remark' => "Invalid request");


										try {




										// echo  ' SELECT * FROM doc_surveillance  WHERE  sur_status = 0 AND sur_added_by= '.decrypt($_SESSION[SYSTEM_NAME.'userid0']).' AND  DATE( sur_report_on ) = CURDATE()  ORDER BY sur_date ASC ';
											$result = selectFromTable (' *, DATE_FORMAT( sur_date , "%d-%m-%Y %r") AS  sur_date  ', ' doc_surveillance ' , " sur_form IS NOT NULL AND sur_status = 1  AND (sur_report_on BETWEEN '$from' AND '$to' )  ORDER BY sur_date DESC  "   , $a );

											$from = 0;
											$tmpAr = array( ); 
											if($result)
												foreach ($result as $key => $value) {
													$shjs = $value['sur_form'] ;
													try {
														$shjs = json_decode( $shjs );
														foreach ($shjs as $keyIn => $valueIn) { 
															$valueIn->date = $value['sur_date'];
															$nowAge = $valueIn->age;
															$nowAge = date('Y', strtotime($value['sur_report_on'])) - $nowAge;
															$nowAge = date("Y") - $nowAge;
															$valueIn->age = $nowAge;
															$valueIn->by_id = indexMe($value['sur_added_by']);
															$valueIn->by_name = 	$result = selectFromTable (' use_name ', ' doc_user ' , ' use_id=' . $value['sur_added_by']    , $a );


														}
														$shjs = json_encode($shjs);
													} catch (Exception $e) { var_dump($e->getMessage()); }
													array_push($tmpAr, array( 


														'id' =>  indexMe($value['sur_id']),  
														'data' =>  $shjs ,  
														'is_edit' => 1,
														'is_read' => $value['sur_read'],
														'server' =>  1


													)); 

													$from++;
												}



												$returnArray['success'] = 3;
												$returnArray['data'] =   $tmpAr ; 
												$returnArray['remark'] = "data fetching success";


											} catch (Exception $e) {

												$returnArray['success'] = 2;
												$returnArray['remark'] = "invalid request";
											}



											return  $returnArray;



										}


										function addNotification( $type, $expiry, $ttyp, $subject, $description, $district  ) {




											$dis_status = 0;


											global $a;
											$tmpArREvaner = array( ); 

											$returnArray = array('success' => -2, 
												'data' => null,
												'remark' => "Invalid user ");

											try{




												$array = array( 
													'notification_type' => $ttyp,
													'notification_subject' => $subject,
													'notification_body' => $description,
													'notification_to' => $district,
													'notification_expiry' => $expiry, 

													'notification_date' =>date("Y-m-d") 
												);




												$result = selectFromTable (' * ', ' doc_notification ' , '  notification_type = "' .  $ttyp  . '" AND  notification_subject = "' . $subject . '" AND notification_expiry = "' . $expiry . '" AND notification_delete = 0   '   , $a );

												if($result  ){ 



													$returnArray['success'] = 1;
													$returnArray['data'] = '2';
													$returnArray['remark'] = "already added";

												} else { 

													$result  = insertInToTable (' doc_notification  ', $array , $a , true);   


													$returnArray['success'] = 1;
													$returnArray['data'] = '1';
													$returnArray['remark'] = "notification successfully";
												}




												$returnArray['success'] = 1;
												$returnArray['data'] = '1';
												$returnArray['remark'] = "notification successfully";




											} catch (Exception $e) {

												$returnArray['success'] = 2;
												$returnArray['remark'] = "invalid data";
											}



											return  $returnArray;





										}





										function getNotification( $type , $from, $limit  ) {




											global $a;

											$returnArray = array('success' => 0, 
												'data' => null ,
												'remark' => "Invalid request");


											try {




										// echo  ' SELECT * FROM doc_surveillance  WHERE  sur_status = 0 AND sur_added_by= '.decrypt($_SESSION[SYSTEM_NAME.'userid0']).' AND  DATE( sur_report_on ) = CURDATE()  ORDER BY sur_date ASC ';
												$result = selectFromTable (' *, DATE_FORMAT( notification_date , "%d-%m-%Y %r") AS  date  ', ' doc_notification ' , ' notification_delete = 0  ORDER BY notification_date DESC LIMIT ' . $limit . ' OFFSET ' . $from    , $a );

												$from = 0;
												$tmpAr = array( ); 
												if($result)
													foreach ($result as $key => $value) {






														array_push($tmpAr, array( 
															'key' =>  indexMe($value['notification_id']),  
															'type' =>  $value['notification_type'], 
															'subject' => $value['notification_subject'],
															'description' => $value['notification_body'],
															'to' => $value['notification_to'],
															'expiry' => $value['notification_expiry'],
															'delete' => $value['notification_delete'],
															'date' =>  $value['notification_date']


														)); 

														$from++;
													}



													$returnArray['success'] = 3;
													$returnArray['data'] =   $tmpAr ; 
													$returnArray['remark'] = "data fetching success";


												} catch (Exception $e) {

													$returnArray['success'] = 2;
													$returnArray['remark'] = "invalid request";
												}



												return  $returnArray;



											}






											function  deleteNotification( $type , $key , $delete ) {

												if( ! is_null($key))
													$key  = unIndexMe( $key );
												else
													$key = 0;

												$delete = $delete == 0 ? 1 : 0;
												$deleteStatus = $delete == 0 ? 'activated' : 'deleted';


												global $a;

												$returnArray = array('success' => 2, 
													'data' => null,
													'remark' => "Invalid input");



												try { 



													$ifexistornot = checkExistsOrNot ( $type, ' doc_notification ', '  notification_id', "$key" ); 


													if(! is_null($ifexistornot['data'])) {	 

														$array = array(  
															"notification_delete"     => $delete  , 
															"notification_date" => date("Y-m-d H:i:s")
														);

														$result  = updateTable (' doc_notification ', $array,  "  notification_id	= " . $ifexistornot['data'][0]['notification_id'] , $a ); 



														$returnArray['success'] = $result;  

														$returnArray['remark'] = "   notification successfully " . $deleteStatus ;




													} 

												} catch (Exception $e) {

													$returnArray['success'] = 2;
													$returnArray['remark'] = "invalid request";
												}



												return  $returnArray;


											}

											?>