<?php

/**
 * @Author: indran
 * @Date:   2018-09-01 01:07:43
 * @Last Modified by:   indran
 * @Last Modified time: 2018-09-10 07:11:25
 */

?>
<?php include_once('global.php'); ?>
<?php include_once('root/functions.php'); ?>

<?php 

auth_use();

if (empty($_SESSION[ SYSTEM_NAME . '_token'])) {
	$_SESSION[ SYSTEM_NAME . '_token'] = bin2hex(random_bytes(33));
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="description" content="webstie">
	<meta name="author" content="indran">

	<base href="<?php echo DIRECTORY ; ?>">
	<title><?php  echo DISPLAY_NAME; ?></title>




	<link rel="apple-touch-icon" sizes="57x57" href="assets/images/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="assets/images/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="assets/images/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="assets/images/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="assets/images/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="assets/images/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="assets/images/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="assets/images/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="assets/images/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/images/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon/favicon-16x16.png">
	<link rel="manifest" href="assets/images/favicon/manifest.json">


	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="assets/images/favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">


	<meta name="csrf-token" content="<?php echo $_SESSION[ SYSTEM_NAME . '_token']; ?>">
	<meta name="to-dest" content="<?php if(isset($_SESSION['TO'])) echo $_SESSION['TO']; ?>">



	<link rel="stylesheet" type="text/css" href="assets/css/style.css">




	<style type="text/css">
	html,body {
		height: 100%;
	}

	body.my-login-page {
		background-color: #f7f9fb;
		font-size: 14px;
	}

	.my-login-page .brand {
		width: 90px;
		height: 90px;
		overflow: hidden;
		border-radius: 50%;
		margin: 0 auto;
		margin: 40px auto;
		box-shadow: 0 0 40px rgba(0,0,0,.05);
	}

	.my-login-page .brand img {
		width: 100%;
	}

	.my-login-page .card-wrapper {
		width: 400px;
	}

	.my-login-page .card {
		border-color: transparent;
		box-shadow: 0 0 40px rgba(0,0,0,.05);
	}

	.my-login-page .card.fat {
		padding: 10px;
	}

	.my-login-page .card .card-title {
		margin-bottom: 30px;
	}

	.my-login-page .form-control {
		border-width: 2.3px;
	}

	.my-login-page .form-group label {
		width: 100%;
	}

	.my-login-page .btn.btn-block {
		padding: 12px 10px;
	}

	.my-login-page .margin-top20 {
		margin-top: 20px;
	}

	.my-login-page .no-margin {
		margin: 0;
	}

	.my-login-page .footer {
		margin: 40px 0;
		color: #888;
		text-align: center;
	}
</style>
</head>

<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="assets/images/logo.jpg">
					</div>	
					<div class=" text-center pb-4"> 
						<a  class="login-a text-dark" ><b class="text-capitalize"><?php  echo DISPLAY_NAME; ?></b></a> 
					</div>
					<div class="card fat">
						<div class="card-body">

							<h4 class="card-title mb-2">User Register</h4>

							<ul class="nav nav-pills mb-3 nav-justified" id="myTab" role="tablist">
								<li class="nav-item pr-1">
									<a class="btn btn-outline-warning w-100 active cust-tab" id="doctor-tab" data-toggle="tab" href="#doctor" role="tab" aria-controls="doctor" aria-selected="true">NEW DOCTOR</a>
								</li>
								<li class="nav-item pl-1">
									<a class="btn btn-outline-warning w-100 cust-tab" id="hospital-tab" data-toggle="tab" href="#hospital" role="tab" aria-controls="hospital" aria-selected="false">NEW HOSPITAL</a>
								</li>

							</ul>
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="doctor" role="tabpanel" aria-labelledby="doctor-tab">


									<form  id="plzValidateThisFormMe" class="parsley" data-parsley-validate method="POST">



										<div class="form-group  has-feedback d-none">
											<p class="text-success">
												one of mobile number or email address is mandatory.
											</p>
										</div>



										<div class="form-group  has-feedback">
											<label for="name" >Doctor Name <span class="text-warning pl-2">*</span> </label>
											<input type="text" class="form-control" id="name" name="name"  nofill  required>  
										</div>

										<div class="form-group  has-feedback">
											<label for="registration_no" >Doctor  Registration number  <span class="text-warning pl-2">*</span></label>
											<input type="text" class="form-control" id="registration_no" name="registration_no"  nofill required >  
										</div>

										<div class="form-group  has-feedback">
											<label for="mobile" >Doctor Mobile number <span class="text-info pl-2" title="enter mobile no or email id">*</span> </label>
											<input type="text" data-parsley-type="integer" minlength="10" maxlength="10" class="form-control" id="mobile" name="mobile"  nofill >  
										</div>

										<div class="form-group  has-feedback">
											<label for="email" >Doctor Email <span class="text-info pl-2" title="enter mobile no or email id">*</span> </label>
											<input type="email" class="form-control" id="email" name="email"  nofill >  
										</div>


										<div class="form-group  has-feedback">
											<label for="password" >new password <span class="text-warning pl-2">*</span></label>
											<input type="password" class="form-control" id="password" name="password"  required nofill >  
										</div>


										<div class="form-group  has-feedback">
											<label for="password1" >confirm password <span class="text-warning pl-2">*</span></label>
											<input type="password" class="form-control" id="password1" data-parsley-equalto="#password" name="password1"  required nofill >  
										</div>


										<div class="form-group">
											<label>
												<input type="checkbox" name="aggree" value="1" required data-required-message="Please agree the Terms and Conditions"> I agree to the Terms and Conditions
											</label>
										</div>

										<div class="nowDosSh">
											
										</div>

										<div class="form-group no-margin">
											<button type="submit" class="btn btn-outline-primary btn-block">
												Register
											</button>
										</div>
										<div class="margin-top20 text-center">
											Already have an account? <a href="user-login">Login</a>
										</div>
									</form>

								</div>


								<div class="tab-pane fade" id="hospital" role="tabpanel" aria-labelledby="hospital-tab">

									<form  id="plzValidateThisFormHos" class="parsley" data-parsley-validate method="POST">



										<div class="form-group  has-feedback">
											<label for="hname" >Hospital Name <span class="text-warning pl-2">*</span> </label>
											<input type="text" class="form-control" id="hname" name="hname"  nofill  required>  
										</div>

										<div class="form-group  has-feedback">
											<label for="hregistration_no" >Hospital  Registration number  <span class="text-warning pl-2">*</span></label>
											<input type="text" class="form-control" id="hregistration_no" name="hregistration_no"  nofill required >  
										</div>


										<div class="form-group  has-feedback">
											<label for="hemail" >Hospital Email <span class="text-warning pl-2" title="enter  email id">*</span> </label>
											<input type="email" class="form-control" id="hemail" name="hemail"  nofill  required>  
										</div>

										<div class="form-group  has-feedback">
											<label for="nname" >Nodal Person Name <span class="text-warning pl-2" title="enter nodal person name">*</span> </label>
											<input type="text" class="form-control" id="nname" name="nname"  nofill  required>  
										</div>


										<div class="form-group  has-feedback">
											<label for="nmobile" >Nodal Person mobile <span class="text-warning pl-2" title="enter Nodal Person's mobile number">*</span> </label>
											<input type="text" data-parsley-type="integer" minlength="10" maxlength="10" class="form-control" id="nmobile" name="nmobile"  nofill  required>  
										</div>

										<div class="form-group  has-feedback">
											<label for="nbed" >Number of Beds <span class="text-warning pl-2" title="enter Nodal Person's mobile number">*</span> </label>
											<input type="text" data-parsley-type="integer" minlength="0" maxlength="10" class="form-control" id="nbed" name="nbed"  nofill  required>  
										</div>
										

										<div class="form-group  has-feedback">
											<label for="hpassword" >new password <span class="text-warning pl-2">*</span></label>
											<input type="password" class="form-control" id="hpassword" name="hpassword"  required nofill >  
										</div>


										<div class="form-group  has-feedback">
											<label for="hpassword1" >confirm password <span class="text-warning pl-2">*</span></label>
											<input type="password" class="form-control" id="hpassword1" data-parsley-equalto="#hpassword" name="hpassword1"  required nofill >  
										</div>


										<div class="form-group">
											<label>
												<input type="checkbox" name="haggree" value="1" required data-required-message="Please agree the Terms and Conditions"> I agree to the Terms and Conditions
											</label>
										</div>

										<div class="hnowDosSh">
											
										</div>
										<div class="form-group no-margin">
											<button type="submit" class="btn btn-outline-info btn-block">
												Register
											</button>
										</div>
										<div class="margin-top20 text-center">
											Already have an account? <a href="user-login">Login</a>
										</div>
									</form>
								</div>

							</div>

							

						</div>
					</div>
					<div class="footer">
						Copyright &copy; <?php echo THEME_OWN_BY; ?>
					</div>
				</div>
			</div>
		</div>
	</section>







	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/parsley.min.js"></script>

	

	<script type="text/javascript">
		$(document).ready(function(){ 

			// $('body').bootstrapMaterialDesign();

			var localusername = null;

			var config = {
				headers : {
					'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
					'X-Requested-With': 'XMLHttpRequest',   
					'CsrfToken': $('meta[name="csrf-token"]').attr('content')
				}
			}





			$("form.parsley").parsley({
				errorClass: 'has-danger',
				successClass: 'has-success',
				classHandler: function(ParsleyField) {
					return ParsleyField.$element.parents('.form-group');
				},
				errorsContainer: function(ParsleyField) {
					return ParsleyField.$element.parents('.form-group');
				},
				errorsWrapper: '<span class="invalid-feedback d-block">',
				errorTemplate: '<div></div>',
				trigger: 'change'
			});



			window.Parsley.addValidator('newpassword', {
				validateString: function(value, requirement) { 
					return ( $(requirement).val() == value )? false : true ;
				},
				messages: {
					en: 'enter a new password, the new password must be different from the old password' 
				}
			});


			$(document).on('click', '.cust-tab', function(event) {
				event.preventDefault();


				$(this).closest('ul').find('a.active').removeClass('active');
				$('.tab-pane.active').removeClass('active');
				$('.tab-pane.show').removeClass('show');

				$(this).addClass('active');
				tar = $(this).attr('href');
				$(tar).addClass('in show active');




			});


			$(document).on('submit', '#plzValidateThisFormMe', function( event) {
				event.preventDefault();
				$this = $(this);
				form = this;


				if((form.mobile.value+"").length < 1 && (form.email.value+"").length < 1 ){

					$('#email' ).parsley().addError('forcederror', {message: '	one of mobile number or email address is mandatory.' , updateClass: true});
					$(document).on('keyup', '#email, #mobile' , function(event) { 
						$( '#email' ).parsley().removeError('forcederror', {updateClass: true});
					});  
					return;
				}


				var dataString =   {action:'doctor-registration',  
				name: form.name.value,
				registration_no: form.registration_no.value,
				mobile: form.mobile.value,
				email: form.email.value,
				password: form.password.value,
			};


			$.ajax({
				url: 'login',
				type: 'POST',
				data:  jQuery.param(dataString)  ,
				dataType: 'JSON',
				headers : {
					'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
					'X-Requested-With': 'XMLHttpRequest',   
					'CsrfToken': $('meta[name="csrf-token"]').attr('content')
				},
				success: function(response, textStatus, jqXHR) {
					$('#alterMepassword').addClass('animated zoomOut');
					// response =$.parseJSON(response); 
					if(response.success  == 1){  
						// $('#alterMepassword').addClass('animated zoomOut');
						form.name.value = '';
						form.registration_no.value = '';
						form.mobile.value = '';
						form.email.value = '';
						form.password.value = '';
						form.password1.value = '';



						$('.nowDosSh').html('  <div id="alterMepassword" class="alert text-center alert-success alert-dismissable animated    "  >'+
							' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <p>' + response.remark  + '</p></div>');

						$('#alterMepassword').addClass('animated zoomIn');

						setTimeout (function(){
							location.href="user-login";
						}, 3000);

					} else if( response.success == -3 || response.success == -4 || response.success == -5|| response.success == -6) {

						
						$( response.data ).parsley().addError('forcederror', {message: response.remark , updateClass: true});
						$(document).on('keyup',  response.data  , function(event) { 
							$(  response.data  ).parsley().removeError('forcederror', {updateClass: true});
						});   
					} else {
						$('.nowDosSh').html('  <div id="alterMepassword" class="alert alert-danger alert-dismissable animated    "  >'+
							' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <p>' + response.remark  + '</p></div>');

						$('#alterMepassword').addClass('animated zoomIn');
					}
				},
				error: function(jqXHR, textStatus, errorThrown){
					console.log('Error'); 
				}
			});










		}); 





			$(document).on('submit', '#plzValidateThisFormHos', function( event) {
				event.preventDefault();
				$this = $(this);
				form = this;



				var dataString =   {action:'hospital-registration',  
				name: form.hname.value,
				registration_no: form.hregistration_no.value, 
				email: form.hemail.value,
				nname: form.nname.value,
				nmobile: form.nmobile.value,
				password: form.hpassword.value,
				bed: form.nbed.value
			};


			$.ajax({
				url: 'login',
				type: 'POST',
				data:  jQuery.param(dataString)  ,
				dataType: 'JSON',
				headers : {
					'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
					'X-Requested-With': 'XMLHttpRequest',   
					'CsrfToken': $('meta[name="csrf-token"]').attr('content')
				},
				success: function(response, textStatus, jqXHR) {
					$('#alterMepassword').addClass('animated zoomOut');
					// response =$.parseJSON(response); 
					if(response.success  == 1){  
						// $('#alterMepassword').addClass('animated zoomOut');
						form.hname.value = '';
						form.hregistration_no.value = '';

						form.hemail.value = '';
						form.hpassword.value = '';
						form.hpassword1.value = '';



						$('.hnowDosSh').html('  <div id="alterMepassword" class="alert text-center alert-success alert-dismissable animated    "  >'+
							' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <p>' + response.remark  + '</p></div>');

						$('#alterMepassword').addClass('animated zoomIn');

						setTimeout (function(){
							location.href="user-login";
						}, 3000);

					} else if( response.success == -3 || response.success == -4 || response.success == -5|| response.success == -6) {


						$( response.data ).parsley().addError('forcederror', {message: response.remark , updateClass: true});
						$(document).on('keyup',  response.data  , function(event) { 
							$(  response.data  ).parsley().removeError('forcederror', {updateClass: true});
						});   
					} else {
						$('.hnowDosSh').html('  <div id="alterMepassword" class="alert alert-danger alert-dismissable animated    "  >'+
							' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <p>' + response.remark  + '</p></div>');

						$('#alterMepassword').addClass('animated zoomIn');
					}
				},
				error: function(jqXHR, textStatus, errorThrown){
					console.log('Error'); 
				}
			});










		}); 







		});
	</script>
</body>
</html>