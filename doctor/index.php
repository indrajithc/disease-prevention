<?php

/**
 * @Author: indran
 * @Date:   2018-09-01 01:06:19
 * @Last Modified by:   indran
 * @Last Modified time: 2018-11-22 15:18:28
 */
?>
<?php include_once('../global.php'); ?>
<?php include_once('../root/functions.php'); ?>
<?php
auth_login();
?>
<!DOCTYPE html>
<html  lang="en"  ng-app="app-doctor">
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


	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">


  <link rel="stylesheet" type="text/css" href="assets/plugins/ngImgCrop-master/scss/ng-img-crop.css"/>

  <link rel="stylesheet" type="text/css" href="assets/css/angular-toastr.min.css">

  <link rel="stylesheet" type="text/css" href="assets/css/angular-moment-picker.min.css"/>
  <link rel="stylesheet" type="text/css" href="assets/css/loading.css">
  <link rel="stylesheet" href="assets/css/loading-bar.min.css"  type="text/css" media="all" / >
  <link rel="stylesheet" href="assets/css/xeditable.min.css"  type="text/css" media="all" / >

  <!-- Custom Scrollbar-->
  <link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.css">

  <link rel="stylesheet" href="assets/css/style.blue.css" id="theme-stylesheet">

  <link rel="stylesheet" href="assets/css/custom.css">






    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->



        <style type="text/css">
        [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak {
          display: none !important;
        }

        main.ng-enter {
          transition:0.5s linear all;
          opacity:0;
        }

        main.ng-enter.ng-enter-active {
          opacity:1;
        }
      </style>



      <script src="assets/js/jquery.min.js"></script>

      <script src="assets/lib/angular.min.js"></script>
      <script src="assets/lib/angular-route.min.js"></script>
      <script src="assets/lib/angular-animate.min.js"></script>

      <script src="assets/lib/angular-sanitize.min.js"></script>

      <script src="assets/lib/angular.dcb-img-fallback.min.js"></script>

      <script src="assets/lib/ngtimeago.min.js"></script>


      <script type="text/javascript"  src="assets/js/dirPagination.js"></script>
      <script type="text/javascript"  src="assets/lib/angular-ui-router.js"></script>


      <script type="text/javascript" src="assets/plugins/ngImgCrop-master/js/ng-img-crop.js"></script>
      <script type="text/javascript" src="assets/plugins/ngImgCrop-master/js/angular-img-cropper.js"></script>


      <script type="text/javascript" src="assets/plugins/ui-bootstrap/ui-bootstrap-tpls-3.0.3.min.js"></script>


      <script type="text/javascript"  src="assets/js/moment-with-locales.js"></script>
      <script type="text/javascript"  src="assets/js/angular-moment-picker.min.js"></script>

      <script src="assets/js/moment.min.js"></script>


      <script type="text/javascript"   src="assets/js/sortable.js"></script>



      <script type="text/javascript"   src="doctor/js/app.js"></script>

    </head>
    <body ng-controller="SystemControllerBoady" ng-cloak>

      <div class="preloader">
        <div class="loader">
          <div class="loader__figure"></div>
          <p class="loader__label"><?php  echo DISPLAY_NAME; ?></p>
        </div>
      </div>
      <button id="jQuery_trigger" class="d-none"></button>
      <!-- Side Navbar -->
      <nav class="side-navbar custSCroll">
        <div class="side-navbar-wrapper">
         <!-- Sidebar Header    -->
         <div class="sidenav-header d-flex align-items-center justify-content-center">
          <!-- User Info-->
          <div class="sidenav-header-inner text-center">
            <img ng-src="{{baseuser.image}}" alt="person" class="img-fluid rounded-circle">
            <h2 class="h5">{{baseuser.name}}</h2><span>Doctor</span>
          </div>
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-logo">
           <a href="." class="brand-small text-center">  
            <strong class="text-primary">
             <i class="material-icons" style=" font-size: 2.4rem; ">
              local_hospital
            </i>
          </strong>
        </a>

      </div>
    </div>
    <!-- Sidebar Navigation Menus-->
    <div class="main-menu">
      <h5 class="sidenav-heading">Main</h5>
      <ul id="side-main-menu" class="side-menu list-unstyled">                  
        <li ng-class="{'active' : currentLin == 'doctor-dashboard' }" ><a href="doctor-dashboard"> <i class="icon-home"></i>Home                             </a></li>
        <li  ng-class="{'active' : currentLin == 'doctor-profile' }"><a href="doctor-profile"> <i class="icon-user"></i>Profile                             </a></li> 
        <li  ng-class="{'active' : currentLin == 'doctor-settings' }"><a href="doctor-settings"> <i class="fas fa-cog"></i>Settings                             </a></li> 
        <li>
          <a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="fas fa-plus"></i>  Report
          </a> 

          <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
            <li><a href="doctor-report-disease">New  </a></li>
            <li><a href="doctor-reported-disease">Reported</a></li> 
          </ul>
        </li>

        <li>
          <a href="#fileDrop" aria-expanded="false" data-toggle="collapse"> <i class="far fa-file-alt"></i>  Report Files
          </a> 

          <ul id="fileDrop" class="collapse list-unstyled ">
            <li><a href="doctor-report-file">New  </a></li>
            <li><a href="doctor-reported-file">Reported</a></li> 
          </ul>
        </li>

      </ul>
    </div>

  </div>
</nav>
<div class="page">
  <!-- navbar-->
  <header class="header">
   <nav class="navbar ">
    <div class="container-fluid">
     <div class="navbar-holder d-flex align-items-center justify-content-between">
      <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="." class="navbar-brand">
       <div class="brand-text d-none d-md-inline-block"> <?php  echo DISPLAY_NAME; ?></div></a></div>
       <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
        <!-- Notifications dropdown-->


        <li class="nav-item dropdown"> <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-bell"></i><span class="badge badge-warning mr-1">{{notifications.length}}</span></a>
          <ul aria-labelledby="notifications" class="dropdown-menu">
           <li><a rel="nofollow" href="#" class="dropdown-item"> 
            <div class="notification d-block justify-content-between">
              <div class="notification-content w-100"><i class="fa fa-bell"></i>You have {{notifications.length}} new alerts </div>
              <div class="notification-time w-100"><small title="{{notifications[0].date}}">{{notifications[0].date | timeago }} </small></div>
            </div></a></li>
            <li ng-repeat="vala in notifications track by $index">
              <a rel="nofollow" href="doctor-notification/{{vala.key}}" class="dropdown-item border mb-1"> 
                <div class="notification d-block justify-content-between">
                  <div class="notification-content w-100"><strong class="text-primary text-uppercase">{{vala.type}}</strong> 
                    <p class="text-justify">{{vala.subject}}</p>
                  </div>

                  <div class="w-100 notification-time"><small>{{vala.date | timeago }}</small></div>
                </div>
              </a>
            </li>

            <li><a rel="nofollow" href="doctor-notification" class="dropdown-item all-notifications text-center"> <strong> <i class="fa fa-bell"></i>view all notifications                                            </strong></a></li>
          </ul>
        </li>
        <?php if(false): ?>
          <!-- Messages dropdown-->
          <li class="nav-item dropdown"> <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-envelope"></i><span class="badge badge-info">10</span></a>
            <ul aria-labelledby="notifications" class="dropdown-menu">
             <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
              <div class="msg-profile"> <img src="img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>
              <div class="msg-body">
               <h3 class="h5">Jason Doe</h3><span>sent you a direct message</span><small>3 days ago at 7:58 pm - 10.06.2014</small>
             </div></a></li>
             <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
               <div class="msg-profile"> <img src="img/avatar-2.jpg" alt="..." class="img-fluid rounded-circle"></div>
               <div class="msg-body">
                <h3 class="h5">Frank Williams</h3><span>sent you a direct message</span><small>3 days ago at 7:58 pm - 10.06.2014</small>
              </div></a></li>
              <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                <div class="msg-profile"> <img src="img/avatar-3.jpg" alt="..." class="img-fluid rounded-circle"></div>
                <div class="msg-body">
                 <h3 class="h5">Ashley Wood</h3><span>sent you a direct message</span><small>3 days ago at 7:58 pm - 10.06.2014</small>
               </div></a></li>
               <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong> <i class="fa fa-envelope"></i>Read all messages    </strong></a></li>
             </ul>
           </li>
         <?php endif; ?>
         <!-- Log out-->
         <li class="nav-item"><a href="exit" ng-click=" hardOpen('exit');" class="btn btn-sm  btn-light logout"> <span class="d-none d-sm-inline-block">Logout</span><i class="fa fa-sign-out"></i></a></li>
       </ul>
     </div>
   </div>
 </nav>
</header>




<main ng-view></main> 


<div ng-show="authentication.isLock" ng-include="authentication.lockscreen" check-lock></div>


<footer class="main-footer">
 <div class="container-fluid">
  <div class="row">
   <div class="col-sm-6">
    <p>Copyright &copy; <?php echo THEME_OWN_BY; ?></p>
  </div>
  <div class="col-sm-6 text-right">

  </div>
</div>
</div>
</footer>
</div>
<!-- JavaScript files-->




<script src="assets/js/angular-filter.min.js"></script>
<script src="assets/js/parsley.min.js"></script>


<script src="assets/js/popper.min.js"> </script>
<script src="assets/js/bootstrap-material-design.min.js"> </script>

<script src="assets/js/jquery.mCustomScrollbar.concat.min.js"> </script>
<script src="assets/js/jquery.cookie.js"> </script>
<script src="assets/js/xeditable.min.js"> </script>

<script type="text/javascript" src="assets/js/district-block.js"></script>

<script type="text/javascript" src="assets/js/loading-bar.min.js"></script>
<script src="assets/js/angular-toastr.tpls.min.js"></script>



<script src="assets/js/front.js"> </script> 
<script type="text/javascript">

  (function($){
    $(window).on("load",function(){
      $(".custSCroll").mCustomScrollbar({
        axis:"y"
      });

      $('body').bootstrapMaterialDesign();
    });
  })(jQuery);

  $(window).on('load', function() {

   $('body').bootstrapMaterialDesign(); 

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


 });


  $(document).ready(function($) {


    $(".preloader").fadeOut();


    function  doParsl () {

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

    };

    doParsl ();


    $(document).on('click', '#jQuery_trigger', function(event) {
      event.preventDefault();  
      $('body').bootstrapMaterialDesign(); 
      doParsl ();
    });

    





    $(document).on('click', '.nav-tabs a', function (e) {
      e.preventDefault();
      $this = $(this);
      href = $(this).attr('nr-href');
      $(href).closest('.tab-content').find('.tab-pane.active').removeClass('active'); 
      $(href).addClass('active');  
      $this.closest('.nav-tabs').find('.nav-item.active').removeClass('active'); 
      $this.closest('.nav-item').addClass('active');
          // console.log($this.closest('.nav-item').attr('class'));
        });

    $(document).on('click', '.panel a.panel-title', function (e) {
      e.preventDefault();
      $this = $(this); 
      $this.toggleClass('collapsed');
      href = $(this).attr('nr-href');


      $this.closest('.panel-group').find('a.panel-title').attr('aria-expanded', "false"); 

      if($this.hasClass('collapsed'))
        $this.attr('aria-expanded', "false");  
      else
        $this.attr('aria-expanded', "true");  

      $this.closest('.panel-group').find('.panel-collapse').removeClass('show');  

      $this.closest('.panel-group').find('.panel-collapse').addClass('collapsed'); 
      $(href).toggleClass('showed');
      if($(href).hasClass('showed')){ 
        $(href).removeClass('collapsed');
        $(href).addClass('show');    
      } else {

        $(href).addClass('collapsed');
        $(href).removeClass('show');    
      }

    });

    // $(document).on('click', '*[data-toggle="collapse"]', function (e) {
    //   e.preventDefault();
    //   $this = $(this); 
    //   $this.toggleClass('collapsed');
    //   href = $(this).attr('nr-href');

    //   $paraRoot = $(href).attr('data-parent');

    //   console.log(  $paraRoot );

    //   $( $paraRoot ).find('*[data-toggle="collapse"]').attr('aria-expanded', "false"); 




    //   if($this.hasClass('collapsed'))
    //     $this.attr('aria-expanded', "false");  
    //   else
    //     $this.attr('aria-expanded', "true");  


    //   $( $paraRoot ).find('.collapse').removeClass('show');  

    //   $( $paraRoot ).find('*[data-toggle="collapse"]').addClass('collapsed'); 
    //   $(href).toggleClass('showed');
    //   if($(href).hasClass('showed')){ 
    //     $(href).removeClass('collapsed');
    //     $(href).addClass('show');    
    //   } else {

    //     $(href).addClass('collapsed');
    //     $(href).removeClass('show');    
    //   }

    // });
  });


</script>
</body>

<script type="text/ng-template" id="non-lockscreen.html">
  <p></p>
</script>



</html>