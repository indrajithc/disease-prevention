<?php

/**
 * @Author: indran
 * @Date:   2018-09-01 01:06:09
 * @Last Modified by:   indran
 * @Last Modified time: 2018-09-01 13:47:04
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
							<h4 class="card-title">User Login</h4>
							<form id="login_post" class="parsley" data-parsley-validate method="POST">

								<div class="form-group">
									<label for="email">Username</label>

									<input id="username" type="text" class="form-control" name="username" value="" placeholder="E-Mail Address or Mobile Number" required autofocus>
								</div>

								<div class="form-group">
									<label for="password">Password
										<a href="forgot" class="float-right d-none">
											Forgot Password?
										</a>
									</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
								</div>

							<!-- 	<div class="form-group">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div> -->
								<div class="nowDosSh py-2 ">

								</div>
								<div class="form-group no-margin">
									<button type="submit" class="btn btn-outline-primary btn-block">
										Login
									</button>
								</div>
								<div class="margin-top20 text-center">
									Don't have an account? <a href="user-registration">Create One</a>
								</div>
							</form>
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
				errorTemplate: '<div></div>'
			});



			$(document).on('submit', '#login_post', function( event) {
				event.preventDefault();
				$this = $(this);
				form =this;


				var dataString =   {action:'user-login', 
				username:form.username.value, 
				password: form.password.value
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


					if(response.success == 1){

						$('#alterMepassword').addClass('animated zoomOut');

						localStorage.localusername = form.username.value;
						$toThe  = $('meta[name="to-dest"]').attr('content');

						if (typeof $toThe === "undefined") {
							location.href=".";
						} else {
							location.href= $toThe;
						}
					} else if(response.success  == -3){  


						$('.nowDosSh').html('  <div id="alterMepassword" class="alert text-center alert-warning alert-dismissable animated    "  >'+
							' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <p>' + response.remark  + '</p></div>');

						$('#alterMepassword').addClass('animated zoomIn');
					} else {  

						$('.nowDosSh').html('  <div id="alterMepassword" class="alert text-center alert-danger alert-dismissable animated    "  >'+
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