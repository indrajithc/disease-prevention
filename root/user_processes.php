<?php

/**
 * @Author: indran
 * @Date:   2018-09-01 01:01:29
 * @Last Modified by:   indran
 * @Last Modified time: 2018-11-22 14:45:37
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



		function setProfile($name , $mobile, $email , $reg , $address , $hospital, $hospital_type , $district ,  $delete,   $type ) {

			global $a;

			$returnArray = array('success' => -2, 
				'data' => null,
				'remark' => "Invalid input");

			try{



				$result = selectFromTable (' * ', 'doc_user ',  ' use_id != ' . decrypt($_SESSION[SYSTEM_NAME.'userid0']) . ' AND use_email = "'.$email.'" '  , $a );
				if( isset($result[0])) {
					return 	$returnArray = array('success' => -3, 
						'data' => null,
						'remark' => " email address already exists");

				}

				$result = selectFromTable (' * ', 'doc_user ',  ' use_id != ' . decrypt($_SESSION[SYSTEM_NAME.'userid0']) . ' AND use_mobile = "'.$mobile.'" '  , $a );
				if( isset($result[0])) {
					return 	$returnArray = array('success' => -3, 
						'data' => null,
						'remark' => " mobile number already exists");

				}



				$array =  array(
					'use_name' => $name, 
					'use_mobile' => $mobile, 
					'use_email' => $email 
				);


				$result  = updateTable (' doc_user  ', $array,  ' use_id = ' . decrypt($_SESSION[SYSTEM_NAME.'userid0']) . ' AND use_delete = 0 '  , $a ); 
				



				$array =  array( 
					'usd_address' => $address, 
					'usd_hospital' => $hospital, 
					'usd_hospital_type' => $hospital_type,  
					'usd_district' => $district, 
					
					"usd_date" => date("Y-m-d H:i:s")
				);


				$result = selectFromTable (' * ', 'doc_user_details ',  ' use_id = ' . decrypt($_SESSION[SYSTEM_NAME.'userid0']) . ' '  , $a );
				if( isset($result[0])) {

					$result  = updateTable (' doc_user_details  ', $array,  ' use_id = ' . decrypt($_SESSION[SYSTEM_NAME.'userid0']) . ' AND usd_delete = 0 '  , $a ); 

				} else {

					$array['use_id'] =   decrypt($_SESSION[SYSTEM_NAME.'userid0']) ;
					$result  = insertInToTable (' doc_user_details  ', $array, $a ); 

				}

				


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
				$result  = selectFromTable (' * ', ' `doc_user` u LEFT JOIN doc_user_details d ON d.use_id = u.use_id   ',  '  u.use_id = ' . decrypt($_SESSION[SYSTEM_NAME.'userid0']) . ' AND u.use_delete = 0 AND u.use_login = 1  ' , $a ); 
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




						'image' => imageToString( $result[0]['use_image'] , 300, 300, 50 )

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
			$sitedirectory = FILES . 'doctor/images';
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

						"use_image"     => $sitedirectory. '/' . $path['image']

					);
					$result  = updateTable (' doc_user ', $array,  ' use_id = ' . decrypt($_SESSION[SYSTEM_NAME.'userid0']) . ' AND use_delete = 0 AND use_login =  1  ' , $a ); 
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



				$result = selectFromTable (' * ', 'doc_user ',  ' use_id = ' . decrypt($_SESSION[SYSTEM_NAME.'userid0']) . ' AND use_delete = 0 AND  use_login = 1 '  , $a );
				if( isset($result[0])) {


					$returnArray['success'] = 3;
					$returnArray['data'] = array(
						'name' => $result[0]['use_name'],
						'mobile' => $result[0]['use_mobile'], 
						'email' => $result[0]['use_email'],
						'reg' => $result[0]['use_reg'],
						'image' => imageToString( $result[0]['use_image'] , 300, 300, 50 )
					);

					$returnArray['remark'] = "data fetching success";

				}



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

				$result = selectFromTable (' use_id AS id, use_email AS email, use_mobile AS mobile, use_password AS password ', '   doc_user   ',  ' use_id = ' . decrypt($_SESSION[SYSTEM_NAME.'userid0']) . ' AND use_delete = 0  AND use_login = 1 AND use_password = "' .   hash('sha256',   encrypt($password, KEY) )    .  '"   '    , $a );


				if(! is_null( $result))
					if(  ( $result[0]['mobile'] == decrypt($_SESSION[SYSTEM_NAME.'userid']) || $result[0]['email'] == decrypt($_SESSION[SYSTEM_NAME.'userid']) )  &&   $result[0]['id'] == decrypt($_SESSION[SYSTEM_NAME.'userid0']) &&  $result[0]['password'] === hash('sha256',   encrypt($password, KEY) )    ){
						
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
						'use_password' => hash('sha256',   encrypt($newpassword, KEY) )    
					);

					try { 

						$result  = updateTable (' doc_user ', $array,  ' use_id = ' . decrypt($_SESSION[SYSTEM_NAME.'userid0']) . ' AND use_delete = 0 AND use_login = 1  '  , $a );  

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







			function getDiagnosisList(  $type ) {
				global $a;

				$returnArray = array('success' => 0, 
					'data' => null ,
					'remark' => "Invalid request");



				try {


								// $result = selectFromTable (' * ', ' doc_user' , '  use_login = 1   ORDER BY use_date DESC LIMIT  ' .  $limit . '  OFFSET ' . $from   , $a );
					$string = 'Cholera,Leptospirosis,ADD (Acute Diarrhoeal diseases),Hepatitis A,Dengue,Japanese encephalitis,Malaria,H1N1,Typhoid,Gastroenteritis,Meningitis,ARDS (Acute rspiratory distress syndrome),Chickenpox,Measles,AES (Acute encephalitis syndrome),Pertussis / whooping cough,Diphtheria,Others';

					$result = explode(',', $string);


					$tmpAr = array( );
					$from  = 0;
					if($result)
						foreach ($result as $key => $value) {

							array_push($tmpAr, array(  
								'index' => $from ,
								'key' => strtolower(trim($value))  ,
								'name' => trim($value)  
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




				function getTodySurveillance( $type , $ido = 0) {


					global $a;

					$returnArray = array('success' => 0, 
						'data' => null ,
						'remark' => "Invalid request");

					$from = 0;

					try {




						$result = selectFromTable (' * ', ' doc_surveillance ' , '  sur_status = 0 AND sur_added_by= '.decrypt($_SESSION[SYSTEM_NAME.'userid0']).' AND  DATE( sur_report_on ) = CURDATE()  ORDER BY sur_date ASC '    , $a );


						if( ! $result) { 
							$diUs = insertInToTable ( ' doc_surveillance ', array( 'sur_added_by' => decrypt($_SESSION[SYSTEM_NAME.'userid0']) , "sur_report_on" => date("Y-m-d") ), $a,true );  
						}


						// echo  ' SELECT * FROM doc_surveillance  WHERE  sur_status = 0 AND sur_added_by= '.decrypt($_SESSION[SYSTEM_NAME.'userid0']).' AND  DATE( sur_report_on ) = CURDATE()  ORDER BY sur_date ASC ';
						$result = selectFromTable (' * ', ' doc_surveillance ' , '  sur_status = 0 AND sur_added_by= '.decrypt($_SESSION[SYSTEM_NAME.'userid0']).' AND  DATE( sur_report_on ) = CURDATE()  ORDER BY sur_date ASC '    , $a );

						if($ido > 0) {
							$result = selectFromTable (' * ', ' doc_surveillance ' , ' sur_status = 0 AND  sur_id '. unIndexMe( $ido ).'  AND sur_added_by= '.decrypt($_SESSION[SYSTEM_NAME.'userid0']).' AND  DATE( sur_report_on ) = CURDATE()  ORDER BY sur_date ASC '    , $a ); 

						}



						$tmpAr = array( ); 
						if($result)
							foreach ($result as $key => $value) {


								$tmpAr  = array( 


									'id' =>  indexMe($value['sur_id']),  
									'data' =>  $value['sur_form'] ,  
									'is_edit' => 1,
									'server' =>  1


								) ; 


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


					function updateTodaySurveillance( $type , $id, $dataa, $done  ) {

						$dis_status = 0;
						if($done == 'true')
							$dis_status = 1;

						$nowkye = 0;
						if (is_numeric($id)) {
							$nowkye = unIndexMe($id);
						}

						global $a;
						$tmpArREvaner = array( ); 

						$returnArray = array('success' => -2, 
							'data' => null,
							'remark' => "Invalid user ");

						try{

							


							$array = array(
								"sur_form" => $dataa,
								'sur_status' => $dis_status,
								

								'sur_report_on' =>date("Y-m-d"), 
								'sur_added_by' => decrypt($_SESSION[SYSTEM_NAME.'userid0']),
							);
							
							$result = selectFromTable (' * ', ' doc_surveillance ' , '  sur_added_by = ' . decrypt($_SESSION[SYSTEM_NAME.'userid0']) . ' AND  sur_id = ' . $nowkye . ' AND sur_delete = 0   '   , $a );

							if($result  ){ 

								$result  = updateTable (' doc_surveillance ', $array,  '  sur_added_by = ' . decrypt($_SESSION[SYSTEM_NAME.'userid0']) . '  AND  sur_id = ' . $nowkye . ' AND sur_delete = 0   '  , $a );  

							} else { 

								$result  = insertInToTable (' doc_surveillance  ', $array , $a , true);   
							}




							$returnArray['success'] = 1;
							$returnArray['data'] = '1';
							$returnArray['remark'] = "data updated successfully";




						} catch (Exception $e) {

							$returnArray['success'] = 2;
							$returnArray['remark'] = "invalid data";
						}



						return  $returnArray;

					}

					function deleteSingleTodaySurveillance( $type , $key  ) {


						global $a;



						$nowkye = 0;
						if (is_numeric($key)) {
							$nowkye = unIndexMe($key);
						}



						$returnArray = array('success' => 2, 
							'data' => null,
							'remark' => "invalid data ");

						$authentication = false;


						try {

							$returnArray['data']  =11;

							$result = selectFromTable (' * ', '   doc_disease   ',  ' dis_id = ' . $nowkye . ' AND dis_delete = 0  '   , $a );


							if(! is_null( $result)){

								$array =  array( 
									"dis_delete" => 1, 
									"dis_date" => date("Y-m-d H:i:s")
								);

								$result  = updateTable (' doc_disease ', $array,   ' dis_id = ' . $nowkye . ' AND dis_delete = 0  '  , $a );  




								$returnArray['success'] = $result;
								$returnArray['remark'] = "data successfully removed";


							}

						} catch (Exception $e) {
							$authentication = false;
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
							$result = selectFromTable (' *, DATE_FORMAT( sur_date , "%d-%m-%Y %r") AS  sur_date  ', ' doc_surveillance ' , ' sur_form IS NOT NULL AND sur_status = 1 AND sur_added_by= '.decrypt($_SESSION[SYSTEM_NAME.'userid0']).'    ORDER BY sur_date DESC LIMIT ' . $limit . ' OFFSET ' . $from    , $a );




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

						function addFile( $type,  $description, $files  ) {




							global $a;



							$sitedirectory = FILES . 'doctor/attachments'; 

							$returnArray = array('success' => 2, 
								'data' => null,
								'remark' => "Invalid input");
							$ty67 = '';
							$extN = '';



							$fileTEtrurn = array( null); 

							try {




								$upadedImages = array();

								if( !is_null($files)) 
									if(sizeof($files) > 0 ){
										$ty67 =  $files['file']['name'][0]; 
										$extN =  pathinfo( $ty67 , PATHINFO_EXTENSION); 

										$fileTEtrurn =  fileForUpload( $files, $sitedirectory);
									}



									$ifexistornot = array();

									$tmpIng = null;

									if (isset( $fileTEtrurn[0]) && !is_null( $fileTEtrurn[0])) {
										$tmpIng =  $fileTEtrurn[0]; 
									} 

									$array = array(    
										"att_desc"  => $description ,  
										"att_on_date" => date("Y-m-d"),

										"att_name"    => $tmpIng ,
										"att_path"    => $sitedirectory, 
										"att_added_by" => decrypt($_SESSION[SYSTEM_NAME.'userid0']) ,
										"att_date" => date("Y-m-d H:i:s")
									);



									$result  = insertInToTable ('doc_attachment', $array, $a );


									$returnArray['success'] = 1 ;
									$returnArray['remark'] = " file added ";




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



									$result = selectFromTable (' * ', ' doc_attachment' , ' att_delete = 0 AND att_added_by = '.decrypt($_SESSION[SYSTEM_NAME.'userid0']).' ' .  '   ORDER BY att_date DESC LIMIT  ' .  $limit . '  OFFSET ' . $from   , $a );




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
												'image' => $datacc  
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

										$ifexistornot = selectFromTable (' *  ', ' doc_attachment' , ' att_delete = 0  AND att_added_by = '.decrypt($_SESSION[SYSTEM_NAME.'userid0']).' AND  att_id = ' . unIndexMe($key)    , $a ); 		 
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



									function getNotification( $type , $from, $limit  ) {




										global $a;

										$returnArray = array('success' => 0, 
											'data' => null ,
											'remark' => "Invalid request");


										try {


											$usd_district = selectFromTable (' usd_district  ', '  doc_user_details ' , ' use_id = '.decrypt($_SESSION[SYSTEM_NAME.'userid0']).'  '     , $a ); 	

										// echo  ' SELECT * FROM doc_surveillance  WHERE  sur_status = 0 AND sur_added_by= '.decrypt($_SESSION[SYSTEM_NAME.'userid0']).' AND  DATE( sur_report_on ) = CURDATE()  ORDER BY sur_date ASC ';
											$result = selectFromTable (' *, DATE_FORMAT( notification_date , "%d-%m-%Y %r") AS  date  ', ' doc_notification ' , ' notification_delete = 0   AND CURRENT_TIMESTAMP <= notification_expiry   ORDER BY notification_date DESC LIMIT ' . $limit . ' OFFSET ' . $from    , $a );

											$from = 0;
											$tmpAr = array( ); 
											if($result)
												foreach ($result as $key => $value) {


													$isoka = false;

													$arrady = $value['notification_to'];

													try {

														$arrady = json_decode($arrady);


														foreach ($arrady as $key => $valueIn) {
															if($usd_district) {  
																if(strtolower(trim($valueIn)) == strtolower(trim($usd_district))  ) {

																	$isoka = true;

																}
															}
														}

													} catch (Exception $e) {

													}





													if ($isoka) {

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




										?>