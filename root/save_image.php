<?php

/**
 * @Author: indran
 * @Date:   2018-09-01 01:01:42
 * @Last Modified by:   indran
 * @Last Modified time: 2018-09-04 05:13:37
 */


function saveImageNow ($srcimage, $sitedirectory, $newWidth = 300) {




	$response = array("image" => $sitedirectory, "error" => true, "path" => $sitedirectory, "msg" => "Image converted succesfully");
	if(preg_match("/^data:image\/(\w+);base64,/", $srcimage) == 1){ 
		$filename               = md5($srcimage);
		$response["filename"]   = $filename ;

		list($type, $srcimage) = explode(';', $srcimage);
		list(, $srcimage)      = explode(',', $srcimage);

		$srcimage = base64_decode($srcimage);

		if(file_exists( $sitedirectory . '/' . $filename . '.png')  ){ 
			$response["image"] =    $filename . ".png";
			$response["msg"] = "Image retrieved from cache. Saved at: " . date("Y-m-d H:i:s" );
	    return $response;  // Kill and return response
	}

	try{ 

		if( file_exists($sitedirectory . '/' . $filename . '.png'))
			unlink($sitedirectory . '/' . $filename . '.png'); 

		file_put_contents($sitedirectory . '/' . $filename . '.png', $srcimage); 

		$response["image"] =  $filename . ".png";
		$response["path"] =  $sitedirectory;

		a9845735909847530485z ($newWidth, $sitedirectory . '/' .  $filename , $sitedirectory . '/' . $response["image"]) ;
		

		$response['error'] = false;



	} catch(ImagickException $e){
		$response["error"]  = true;
		$response["msg"]    = $e->getMessage();

	}



} 

return $response; 
}

function a9845735909847530485z ($newWidth, $targetFile, $originalFile) {


	
	$info = getimagesize($originalFile);
	$mime = $info['mime'];


	switch ($mime) {
		case 'image/jpeg':
		$image_create_func = 'imagecreatefromjpeg';
		$image_save_func = 'imagejpeg';
		$new_image_ext = 'jpg';
		break;

		case 'image/png':
		$image_create_func = 'imagecreatefrompng';
		$image_save_func = 'imagepng';
		$new_image_ext = 'png';
		break;

		case 'image/gif':
		$image_create_func = 'imagecreatefromgif';
		$image_save_func = 'imagegif';
		$new_image_ext = 'gif';
		break;


	}


	$img = $image_create_func($originalFile);
	list($width, $height) = getimagesize($originalFile);

	$newHeight = ($height / $width) * $newWidth;
	$tmp = imagecreatetruecolor($newWidth, $newHeight);
	imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

	if (file_exists($targetFile)) {
		unlink($targetFile);
	}
	$image_save_func($tmp, "$targetFile.$new_image_ext");

	$returnStatus = true;



}



function fileForUploadWithName ( $files, $path) {

	$returnAr  = array();
	if(isset( $files['file'])) {
		foreach($files['file']['name'] as $key=>$val){
			$upload_dir = TEMP_DIR;
			$upload_file = $upload_dir.$files['file']['name'][$key];
			$filename = $files['file']['name'][$key];




			if(move_uploaded_file($files['file']['tmp_name'][$key],$upload_file)){
				$newFile =   $files['file']['name'][$key];

				if (file_exists(  $path .'/'. $newFile )) 
					$newFile =   rand(1, 999) .$files['file']['name'][$key];
				$newFileT6 = '';


				try {
					$newFileT6 = chunk_split(base64_encode(file_get_contents($upload_file))); 
					$newFileT6 = md5($newFileT6) . '.' . strtolower( pathinfo( $newFile , PATHINFO_EXTENSION) ) ;
					$newFile = $newFileT6;

				} catch (Exception $e) {
					
				}



				if ( ! file_exists(  $path .'/'. $newFile )) 
					if(rename( $upload_file, $path .'/'. $newFile ) ){
						$arraySt = true;
					}


					array_push($returnAr,array( 'file' => $newFile, 'name' => $filename ) );

				}
			}

		}

		return $returnAr;

	}

	function fileForUpload ( $files, $path) {

		$returnAr  = array();
		if(isset( $files['file'])) {
			foreach($files['file']['name'] as $key=>$val){
				$upload_dir = TEMP_DIR;
				$upload_file = $upload_dir.$files['file']['name'][$key];
				$filename = $files['file']['name'][$key];




				if(move_uploaded_file($files['file']['tmp_name'][$key],$upload_file)){
					$newFile =   $files['file']['name'][$key];

					if (file_exists(  $path .'/'. $newFile )) 
						$newFile =   rand(1, 999) .$files['file']['name'][$key];
					$newFileT6 = '';


					try {
						$newFileT6 = chunk_split(base64_encode(file_get_contents($upload_file))); 
						$newFileT6 = md5($newFileT6) . '.' . strtolower( pathinfo( $newFile , PATHINFO_EXTENSION) ) ;
						$newFile = $newFileT6;

					} catch (Exception $e) {

					}



					if ( ! file_exists(  $path .'/'. $newFile )) 
						if(rename( $upload_file, $path .'/'. $newFile ) ){
							$arraySt = true;
						}


						array_push($returnAr, $newFile );

					}
				}

			}

			return $returnAr;

		}



		function saveVideoNow ( $files, $path) {




			$returnAr  = array();
			if(isset( $files)) {
				foreach($files['name'] as $key=>$val){
					$upload_dir = TEMP_DIR;
					$upload_file = $upload_dir.$files['name'][$key];
					$filename = $files['name'][$key];




					if(move_uploaded_file($files['tmp_name'][$key],$upload_file)){
						$newFile =   $files['name'][$key];

						if (file_exists(  $path .'/'. $newFile )) 
							$newFile =   rand(1, 999) .$files['name'][$key];
						$newFileT6 = '';


						try {
							$newFileT6 = chunk_split(base64_encode(file_get_contents($upload_file))); 
							$newFileT6 = md5($newFileT6) . '.' . strtolower( pathinfo( $newFile , PATHINFO_EXTENSION) ) ;
							$newFile = $newFileT6;

						} catch (Exception $e) {

						}



						if ( ! file_exists(  $path .'/'. $newFile )) 
							if(rename( $upload_file, $path .'/'. $newFile ) ){
								$arraySt = true;
							}


							array_push($returnAr, array('video' => $newFile , 'name' =>  $filename ) );

						}
					}

				}

				return $returnAr;
			}







			function  saveBlobsNow($blobs, $srcimage, $sitedirectory, $newWidth = 300 ) {

				$returnAr  = array();
				if(isset( $blobs )) {
					foreach($blobs['name'] as $key=>$val){


						$upload_dir = TEMP_DIR;
						$upload_file = $upload_dir.$blobs['name'][$key];
						$filename = $blobs['name'][$key];

						if($filename == $srcimage ){	
							if(move_uploaded_file($blobs['tmp_name'][$key],$upload_file)){ 				
								if (file_exists($upload_file)) {
									try {
										$im4534335 = file_get_contents( $upload_file); 
										$imdata =   'data:image/png' . ';base64,' .  base64_encode($im4534335); 								
										unlink($upload_file);
										$returnAr  = saveImageNow ($imdata, $sitedirectory, $newWidth );
									} catch (Exception $e) {

									}

								}
							} 
						}					
					}
				}
				return 	$returnAr;
			}
			function  saveBlobsNowNoBg($blobs, $srcimage, $sitedirectory) {

				$returnAr  = array('image' => null, 'name' => null);
				if(isset( $blobs )) {
					foreach($blobs['name'] as $key=>$val){ 


						$upload_dir = TEMP_DIR;
						$upload_file = $upload_dir.$blobs['name'][$key];
						$filename = $blobs['name'][$key];

						if($filename == $srcimage ){	

							$info = getimagesize($blobs['tmp_name'][$key]);
							if ($info !== FALSE) {

								if ( !( ($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG))) { 

									if(move_uploaded_file($blobs['tmp_name'][$key],$upload_file)){
										$newFile =   $blobs['name'][$key];

										if (file_exists(  $sitedirectory .'/'. $newFile )) 
											$newFile =   rand(1, 999) .$blobs['name'][$key];
										$newFileT6 = '';


										try {
											$newFileT6 = chunk_split(base64_encode(file_get_contents($upload_file))); 
											$newFileT6 = md5($newFileT6) . '.' . 'png' ;
											$newFile = $newFileT6;

										} catch (Exception $e) {

										}



										if ( ! file_exists(  $sitedirectory .'/'. $newFile )) 
											if(rename( $upload_file, $sitedirectory .'/'. $newFile ) ){
												$arraySt = true;
											}


											$returnAr =  array('image' => $newFile , 'name' =>  $filename ) ; 

										}
									}

								}

							}		


						}
					}
					return 	$returnAr;
				}




				function saveBlobsNowVideo ($blobs, $srcimage, $sitedirectory ) {

					$returnAr  = array();
					if(isset( $blobs )) {
						foreach($blobs['name'] as $key=>$val){


							$upload_dir = TEMP_DIR;
							$upload_file = $upload_dir.$blobs['name'][$key];
							$filename = $blobs['name'][$key];

							if($filename == $srcimage ){	


								if(move_uploaded_file($blobs['tmp_name'][$key],$upload_file)){
									$newFile =   $blobs['name'][$key];

									if (file_exists(  $sitedirectory .'/'. $newFile )) 
										$newFile =   rand(1, 999) .$blobs['name'][$key];
									$newFileT6 = '';


									try {
										$newFileT6 = chunk_split(base64_encode(file_get_contents($upload_file))); 
										$newFileT6 = md5($newFileT6) . '.' . 'mp4' ;
										$newFile = $newFileT6;

									} catch (Exception $e) {

									}



									if ( ! file_exists(  $sitedirectory .'/'. $newFile )) 
										if(rename( $upload_file, $sitedirectory .'/'. $newFile ) ){
											$arraySt = true;
										}


										array_push($returnAr, array('video' => $newFile , 'name' =>  $filename ) );

									}



								}					
							}
						}
						return 	$returnAr;
					}
					?>