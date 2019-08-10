/*
* @Author: indran
* @Date:   2018-09-01 01:21:18
* @Last Modified by:   indran
* @Last Modified time: 2018-11-22 15:23:16
*/
var doctor_app = angular.module( 'app-doctor', ['ngRoute', 'ngAnimate',  
	'toastr', 'ngImgCrop' ,  'ngtimeago', 'ui.bootstrap', 'angular-img-cropper', 
	'dcbImgFallback',  'ngSanitize', 'angularUtils.directives.dirPagination', 'moment-picker', 
	'angular-loading-bar','ui.sortable', 'angular.filter' , 'xeditable' ]);
// simpleGrid ,,, 'ui.utils' 

var token = angular.element( document.querySelector( 'meta[name="csrf-token"]' ) );


var config = {
	headers : {
		'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
		'X-Requested-With': 'XMLHttpRequest',
		'CsrfToken': token.attr('content')
	}
}

var config2 = {
	headers : {
		'Content-Type': undefined,
		'X-Requested-With': 'XMLHttpRequest',
		'CsrfToken': token.attr('content')
	}
}


doctor_app.config([ '$routeProvider', '$locationProvider', function( $routeProvider, $locationProvider ) {
	$routeProvider
	.when('/doctor-dashboard', {
		templateUrl: 'doctor/pages/home.html',
		controller: 'doctor_appController0'
	})
	.when('/doctor-profile', {
		templateUrl: 'doctor/pages/profile.html',
		controller: 'doctor_appControllerProfile'
	})
	.when('/doctor-settings', {
		templateUrl: 'doctor/pages/settings.html',
		controller: 'doctor_appControllerSettings'
	}) 
	.when('/doctor-confirmation', {
		templateUrl: 'doctor/pages/confirmation.html',
		controller: 'doctor_appControllerConfirmation'
	}) 
	.when('/doctor-user-existing', {
		templateUrl: 'doctor/pages/user-existing.html',
		controller: 'doctor_appControllerUserExisting'
	}) 
	.when('/doctor-report-disease', {
		templateUrl: 'doctor/pages/report-disease.html',
		controller: 'doctor_appControllerReportDisease'
	}) 
	.when('/doctor-reported-disease', {
		templateUrl: 'doctor/pages/reported-disease.html',
		controller: 'doctor_appControllerReportedDisease'
	}) 

	.when('/doctor-view-disease', {
		templateUrl: 'doctor/pages/view-disease.html',
		controller: 'doctor_appControllerViewDisease'
	}) 


	.when('/doctor-report-file', {
		templateUrl: 'doctor/pages/report-file.html',
		controller: 'doctor_appControllerReportFile'
	}) 
	.when('/doctor-reported-file', {
		templateUrl: 'doctor/pages/reported-file.html',
		controller: 'doctor_appControllerReportedFile'
	}) 

	.when('/doctor-notification', {
		templateUrl: 'doctor/pages/notification.html',
		controller: 'doctor_appControllerNotification'
	}) 


	.when('/doctor-notification/:param1', {
		templateUrl: 'doctor/pages/notification.html',
		controller: 'doctor_appControllerNotification'
	}) 




	.otherwise({
		redirectTo: '/doctor-dashboard'
	});

	$locationProvider.html5Mode({
		enabled: true,
		requireBase: false
	});

}]);
//doctor_appControllerDoctorSingleView
doctor_app.run( function($rootScope, cfpLoadingBar,  $location, $timeout, $window) {

	$rootScope.$on('$routeChangeStart', function() {
		cfpLoadingBar.start();
	});

	$rootScope.$on('$routeChangeSuccess', function() {
		cfpLoadingBar.complete(); 
		$window.currentUr = $location.path().replace('/', '').trim(); 
		$timeout(function(){ 
			angular.element( $('#jQuery_trigger')).trigger('click');
		}, 1);
	});


});
doctor_app.filter('active', [ function() {
	return function (object) {
		var array = [];
		angular.forEach(object, function (data) {
			if (data.delete == '0')
				array.push(data);
		});
		return array;
	};
}]);

// doctor_app.run(function(editableOptions, editableThemes) {
// editableThemes.bs3.inputClass = 'input-sm';
// editableThemes.bs3.buttonsClass = 'btn-sm';
// editableOptions.theme = 'bs3';
// });


// public_app.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
// cfpLoadingBarProvider.includeSpinner = false;
// }]);
/*==================================================>>======================================================*/


doctor_app .directive('inputType', ['$compile', function ($compile) {
	return {
		restrict: 'E', 
		scope: true, 
		link: function (scope, element, attrs) { 

			$type = attrs.type;
			$class = attrs.class;
			$ngModel = attrs.ngModel; 
			$placeholder = attrs.placeholder;
			$required = attrs.required;
			$required = attrs.ngRequired;
			$title = attrs.title;
			dto = '';

			switch( $type){
				case 'number':
				dto = '<input type="number"  name="'+$type+'"  class="'+$class +'" ng-required ="'+$required+'" placeholder="'+$placeholder+
				'"  ng-model="'+$ngModel+'"  title="'+$title+'" >';
				break;
				case 'textarea':
				dto = '<textarea   name="'+$type+'"  class="'+$class +'" ng-required ="'+$required+'" placeholder="'+$placeholder+
				'"  ng-model="'+$ngModel+'"  title="'+$title+'" ></textarea>';
				break;
				case 'email':
				dto = '<input type="email"  name="'+$type+'"  class="'+$class +'" ng-required ="'+$required+'" placeholder="'+$placeholder+
				'"  ng-model="'+$ngModel+'"  title="'+$title+'" >';
				break; 
				case 'url':
				dto = '<input type="url"  name="'+$type+'"  class="'+$class +'" ng-required ="'+$required+'" placeholder="'+$placeholder+
				'"  ng-model="'+$ngModel+'"  title="'+$title+'" >';

				break;
				case 'mobile':
				dto = '<input type="number"  name="'+$type+'"  class="'+$class +'" ng-required ="'+$required+'" placeholder="'+$placeholder+
				'"  ng-model="'+$ngModel+'"  title="'+$title+'" minlength="10" maxlength="10" >';
				break;
				case 'landline':
				dto = '<input type="number"  name="'+$type+'"  class="'+$class +'" ng-required ="'+$required+'" placeholder="'+$placeholder+
				'"  ng-model="'+$ngModel+'"  title="'+$title+'" minlength="10" maxlength="15" >';
				break;
				case 'pin':
				dto = '<input type="number"  name="'+$type+'"  class="'+$class +'" ng-required ="'+$required+'" placeholder="'+$placeholder+
				'"  ng-model="'+$ngModel+'"  title="'+$title+'" minlength="6" maxlength="6" >';
				break;
				default:
				dto = '<input type="text"  name="'+$type+'"  class="'+$class +'" ng-required ="'+$required+'" placeholder="'+$placeholder+
				'"  ng-model="'+$ngModel+'"  title="'+$title+'" >';

			}



			var input = angular.element( dto );

			var compile = $compile(input)(scope);

			element.replaceWith(input);    

		}
	}
}]);





// doctor_app.directive('showTab',
// function () {
// return {
// link: function (scope, element, attrs) {
// element.bind('click', function(e) {
// e.preventDefault();
// $(element).tab('show');
// })

// }
// };
// });



doctor_app.service('myservice', function() {
	this.value = null;
	this.name = null;
});

doctor_app.config(function(toastrConfig) {
	angular.extend(toastrConfig, {
		allowHtml: false,
		closeButton: false,
		closeHtml: '<button>&times;</button>',
		timeOut: 7500,
		titleClass: 'toast-title',
		toastClass: 'toast'
	});
});
function pushMe($baseArr, $newArr) {
	angular.forEach($baseArr, function(value, newKey) {
		for (var key in $newArr) {
			if (key === 'length' || !$newArr.hasOwnProperty(key) ) continue;
			if( !($newArr[key] === undefined ||$newArr[key] === null ) )
				$baseArr[key] = $newArr[key];
		}
	});
}



doctor_app.filter('orderObjectBy', function(){
	return function(input, attribute) {
		if (!angular.isObject(input)) return input;

		var array = [];
		for(var objectKey in input) {
			array.push(input[objectKey]);
		}

		array.sort(function(a, b){
			a = parseInt(a[attribute]);
			b = parseInt(b[attribute]);
			return b - a;
		});
		return array;
	}
}); 


// doctor_app.config(function(paginationTemplateProvider) {
// 	paginationTemplateProvider.setPath('assets/js/dirPagination.tpl.html');
// });

doctor_app.directive('parsleyValidateInput', function($timeout) {
	return {
		link: function(scope, element, attrs) {
			element.on('remove', function() {
				return element.closest('form').parsley('removeItem', "#" + attrs.id);
			});
			return $timeout(function() {
				if (!attrs.id) {
					attrs.id = "input_" + (_.uniqueId());
					element.attr('id', attrs.id);
				}
				return element.closest('form').parsley('addItem', "#" + attrs.id);
			});
		}
	};
});

Object.size = function(obj) {
	var size = 0, key;
	for (key in obj) {
		if (obj.hasOwnProperty(key)) size++;
	}
	return size;
};



doctor_app.directive('pdf', function() {
	return {
		restrict: 'E',
		link: function(scope, element, attrs) {
			var url = scope.$eval(attrs.src);
			element.replaceWith('<object width="100%" height="100%" type="application/pdf" data="' + url + '"></object>');
		}
	};
});


doctor_app.factory('serverService', function($http) {
	return {
		post: function(data, $scope) { 
			return $http.post("ajax", data, config)
			.then(function  success(response) { 
				return  userAuthenticationAgent ( $scope, response); 
			}, function myError(response) { 
				//console.log("error ");
			});
		}
	}
});
doctor_app.run(['editableOptions', function(editableOptions) {
  editableOptions.theme = 'bs3'; // bootstrap3 theme. Can be also 'bs2', 'default'
}]);

doctor_app.filter('ageFilter', function() {
	function calculateAge(birthday) {

		birthday = new Date(birthday);
		var ageDifMs = Date.now() - birthday.getTime();
		var ageDate = new Date(ageDifMs);
		return Math.abs(ageDate.getUTCFullYear() - 1970);
	}
	function monthDiff(d1, d2) {
		if (d1 < d2){
			var months = d2.getMonth() - d1.getMonth();
			return months <= 0 ? 0 : months;
		}
		return 0;
	}       
	return function(birthdate) { 
		var age = calculateAge(birthdate);
		if (age == 0)
			return monthDiff(birthdate, new Date()) + ' months';
		return age;
	}; 
});



doctor_app.controller( 'SystemControllerBoady',  function($timeout,$route, $location, $scope, $http, $filter , $window, myservice, toastr, cfpLoadingBar , serverService){
	$scope.exit =  function(){
		$window.location.href = 'exit';
	}

	$scope.newUserCount = 0;

	$scope.$watch(function () { return $window.currentUr  }, function(n,o){
		//console.log(n);
		$scope.currentLin = n;
	} );

	$scope.hardOpen = (patha) => { 
		$window.location.href = patha;
	};

//$scope.networkIcon = network.actual ? 'assets/img/networkicons/' + network.actual + '.png' : 'assets/img/networkicons/default.png';
$scope.baseuser = {
	name: "user name",
	email: null,
	image: 'assets/images/default/image.png'

}

$scope.authentication = {username : null,
	lockscreen: null,
	password: null,
	isLock: false,
	invalidPassword: false,
	remark: "test"
};

$scope.$watch('authentication.isLock' , function(oldv , newv){ 
	//console.log(oldv , newv);
	if(oldv != newv){ 
		$route.reload();
	} 
});


$scope.logDataMin = [];


$scope.sort = function(keyname){
$scope.sortKey = keyname;   //set the sortKey to the param passed
$scope.reverse = !$scope.reverse; //if true make it false and vice versa
}


$scope.tinymceOptions = {
	selector: 'textarea',
	height: 500,
	theme: 'modern',
	plugins: 'print preview fullpage searchreplace autolink directionality  visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount tinymcespellchecker imagetools contextmenu colorpicker textpattern help',
	toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
	image_advtab: true,
	templates: [
	{ title: 'Test template 1', content: 'Test 1' },
	{ title: 'Test template 2', content: 'Test 2' }
	],
	content_css: [
	'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
	'//www.tinymce.com/css/codepen.min.css'
	]
};

$scope.b64toBlob = (b64Data, contentType, sliceSize) => {
	contentType = contentType || '';
	sliceSize = sliceSize || 512;

	var byteCharacters = atob(b64Data);
	var byteArrays = [];

	for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
		var slice = byteCharacters.slice(offset, offset + sliceSize);

		var byteNumbers = new Array(slice.length);
		for (var i = 0; i < slice.length; i++) {
			byteNumbers[i] = slice.charCodeAt(i);
		}

		var byteArray = new Uint8Array(byteNumbers);

		byteArrays.push(byteArray);
	}

	var blob = new Blob(byteArrays, {type: contentType});
	return blob;
};

$scope.guidKey = () => {
	return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
	s4() + '-' + s4() + s4() + s4();
};

var s4 = () => {
	return Math.floor((1 + Math.random()) * 0x10000)
	.toString(16)
	.substring(1);
};
// ===== expire



$scope.compare = ( expire, date, op ) => {
	reto = false;
	try{
		switch(op.trim()) {
			case '<': reto = new Date(expire) < new Date(date); break;
			case '<=': reto = new Date(expire) <= new Date(date); break;
			case '>': reto = new Date(expire) > new Date(date); break;
			case '>=': reto = new Date(expire) >= new Date(date); break;
			case '!=': reto = new Date(expire) != new Date(date); break;
			case '==': reto = new Date(expire) == new Date(date); break;
		} 
	}catch( e){ }  
	return  reto;
};

// $scope.changeDelete = ( keya)=> {
// 	$scope.settings[ keya ] = $scope.settings[ keya ] ? false : true;
// 	//console.log($scope.settings,  $scope.tmp1 );

// };

$scope.checkServer = () => {	
	getServerStatus();		
};

$scope.lockLogin = function() {


	var data = $.param({
		action:'user-login',
		username: $scope.authentication.username,
		password: $scope.authentication.password
	});

	$http.post("login", data, config)
	.then(function mySuccess(response) {
		response = userAuthenticationAgent($scope, response);

		if(response.status == -2) {
			$scope.authentication.invalidPassword = true;
		}

	}, function myError(response) {
		alert("server error 500");
	});




}



$scope.notifications = [];

$scope.getNotification = function($limit) {


	var data = $.param({
		action:'get-notification',
		from: $scope.notifications.length,
		limit: $limit
	});

	serverService.post(data, $scope).then(function(response) {   


		if(response.status == 3) {  
			if(response.data){

				$json =  angular.fromJson(response.data); 

				if( $json.length > 0){
					angular.forEach( $json , function(value, key){  

						value['to'] = angular.fromJson( value.to);

						$scope.notifications.push(value);   
					});
					$scope.getNotification ( $limit );
				}  else { 
					console.log($scope.notifications);
				}
			} 
		} 



	}, function myError(response) {
		alert("server error 500");
	});




};


$timeout( function(){ 
	cfpLoadingBar.start();



	var data = $.param({
		action: 'get-profile-basic'
	});

	serverService.post(data, $scope).then(function(response) {  

		// //console.log(response);
		if(! (response === null || response === undefined) )

			if(response.status == 3) {
				$scope.baseuser = {
					name: response.data.name ,
					email: response.data.email ,
					email: response.data.email ,
					mobile: response.data.mobile ,
					image: response.data.image
				}
			} else if(response.status == 2) {
				toastr.error( response.message );
			} else {
				toastr.info( response.message );


			}

			cfpLoadingBar.complete();


		});


	$scope.getNotification (9);




}, 9);










});






doctor_app.controller( 'doctor_appControllerProfile', function($timeout, $location, $scope, $http, $window, toastr, myservice, cfpLoadingBar , serverService){
	doCheckUser($scope, $http);


// iamge edit rpev start
$scope.size='big';
$scope.type='square';
$scope.imageDataURI='';
$scope.resImageDataURI='data:image/png;base64,iVBORw';
$scope.resImgFormat='image/png';
$scope.resImgQuality=1;
$scope.selMinSize=50;
$scope.resImgSize=300;
$scope.enableCrop=false;

$scope.logLimit = 30;
$scope.logOffset = 0;
$scope.logData = [];
$scope.moreLogR = true;
$scope.isLoadingLog = false;
//  image edit rpev end

//  profile user start
$scope.profile = [];
$scope.profile = {
	name: null,
	email: null,
	phone: null,
	image: null,
	landline: null,
	address: null,
	sex: null,
	facebook: null,
	twitter: null,
	instagram: null,
	description: null,

}
// profile uer  end



$scope.doctorProfileSubmit = () => {
	//console.log($scope.profile);


	var data = $scope.profile;
	pushMe(data, {action: 'set-profile' });
	var data = $.param(data);


	serverService.post(data, $scope).then(function(response) {  


		if(response.status == 1) {


			toastr.success( response.message );
		} else if(response.status == 2) {
			toastr.error( response.message );
		} else {
			toastr.info( response.message );


		}



		//console.log(response);


	});




	pushMe($scope.$parent.baseuser, {
		name: $scope.profile.name ,
		email: $scope.profile.email
	} );

}

$scope.openSocialNewTab = (locat) => {
	$window.open(locat, '_blank');
}


$scope.$watch('profile.image', function() {
	pushMe($scope.$parent.baseuser, {image: $scope.profile.image } );
});

var handleFileSelect=function(evt) {
	//console.log( ($scope.enableCrop + '').length );
	//console.log($scope.enableCrop);

	if(($scope.enableCrop + '').length > 2){
		$scope.enableCrop=true;
	}

	var file=evt.currentTarget.files[0];
	var reader = new FileReader();
	reader.onload = function (evt) {
		$scope.$apply(function($scope){
			$scope.imageDataURI=evt.target.result;
		});
	};
	reader.readAsDataURL(file);
};
angular.element(document.querySelector('#fileInputM')).on('change',handleFileSelect);
$scope.$watch('resImageDataURI',function(){
          ////console.log('Res image', $scope.resImageDataURI);
      });



$scope.fileNameChanged = () => {

}

$scope.doneImageCrop = () => {
	fvb =  angular.element( document.querySelector( '#opImageSrc' ) );

	$scope.imageDataURI = '';
	$scope.enableCrop= false;




	var data = $.param({
		action: 'update-dp' ,
		data: fvb.attr('src')
	});


	serverService.post(data, $scope).then(function(response) {  

 // //console.log(response);
 if(! (response === null || response === undefined) ) 
 	if(response.status == 1) { 
 		pushMe( $scope.profile, { image: response.data}); 
 	} else if(response.status == 2) {
 		toastr.error( response.message );
 	} else {
 		toastr.info( response.message ); 
 	} 

 });







}


$scope.clearImageNow = function (){
	$scope.imageDataURI = '';
	$scope.enableCrop= false;
}


$scope.uploadImgTriggen = function(){
	setTimeout(function() {
		document.getElementById('fileInputM').click()
	}, 0);
}

var getLog = () => { 

	return;
}

$scope.reformatDate = (dateStr) =>  {
	dArr = dateStr.split("-");
	return dArr[2]+ "-" +dArr[1]+ "-" +dArr[0] ;
}

$scope.moreLogs = () => {
	getLog();
}

$timeout( function(){
	cfpLoadingBar.start();
	var data = $.param({
		action: 'get-profile'
	});


	serverService.post(data, $scope).then(function(response) {  


		if(! (response === null || response === undefined) )

			if(response.status == 3) {
				$scope.profile = response.data;
				pushMe ($scope.profile , {phone: parseInt(response.data.phone) , experience: parseInt(response.data.experience) } );

			} else if(response.status == 2) {
				toastr.error( response.message );
			} else {
				toastr.info( response.message );


			}
			cfpLoadingBar.complete();
		});






	$scope.logLimit = 100;
	$scope.logOffset = 0;

	getLog();


},1);

});




doctor_app.controller( 'doctor_appControllerSettings', function($timeout, $scope, $http, $location, $filter, myservice, toastr, cfpLoadingBar, serverService){
	doCheckUser($scope, $http);

//  new variable xxx xzzz
$scope.login = { repassword: null,
	newpassword: null};




//  password change new password

$scope.$watch( 'login.repassword', function(newdata) {
	$scope.misMPassword = null;
	var a =$scope.login.repassword ;
	var b = $scope.login.newpassword ;
	if ( a && b)
		if (a != b) {
			$scope.misMPassword = "Password mismatch";
			$scope.doctorLogin.repassword.$invalid = true;
			$scope.doctorLogin.$invalid = true;
		}
	});



$scope.$watch( 'login.newpassword', function(newdata) {
	$scope.misMPassword = null;
	var a =$scope.login.repassword ;
	var b = $scope.login.newpassword ;
	if ( a && b)
		if (a != b) {
			$scope.misMPassword = "Password mismatch";
			$scope.doctorLogin.repassword.$invalid = true;
			$scope.doctorLogin.$invalid = true;
		}
	});


$scope.$watch( 'login.password', function(newdata) {
	$scope.errorPassword = null;

});



$scope.$watch( 'login.newpassword', function(newdata) {
	$scope.errorNewPassword = null;
});

$scope.doctorLoginSubmit = function () {


	if ($scope.login.newpassword != $scope.login.repassword) {
		$scope.misMPassword = "Password mismatch";
		$scope.doctorLogin.repassword.$invalid = true;
		$scope.doctorLogin.$invalid = true;
		return;
	}



	var exdata = {
		action: 'update-login',
		password: $scope.login.password,
		newpassword: $scope.login.repassword
	}
	var data = $.param(exdata);




	serverService.post(data, $scope).then(function(response) {  

		//console.log(response);

		success = response.status;
		if(success == 1){


			toastr.success( 'successfully updated' );


			$scope.login = {dname: "test"};
		}

		if(success == 2){
			$scope.errorPassword = response.message;
			$scope.doctorLogin.password.$invalid = true;
			$scope.doctorLogin.$invalid = true;

		}

		if(success == 21){
			$scope.errorNewPassword = response.message;
			$scope.doctorLogin.newpassword.$invalid = true;
			$scope.doctorLogin.$invalid = true;

		}

		if(success == 0){
			toastr.error('make sure that all details are correct, or refresh' );
		}



	});





}

// password change end end end

$timeout( function(){





},3);
});





doctor_app.controller( 'doctor_appControllerConfirmation', function($timeout, $scope, $http, $location, $filter,$sce, myservice, toastr, cfpLoadingBar, serverService){
	doCheckUser($scope, $http);
	$scope.users = [];

	var getNewUsers = ( $limit ) => { 

		var data = $.param({
			action: 'get-new-user',
			from: $scope.users.length,
			limit: $limit
		});


		serverService.post(data, $scope).then(function(response) {   

			if(response.status == 3) {  
				if(response.data)
					if(response.data.length > 0){
						angular.forEach( response.data, function(value, key){
							$scope.users.push(value);
						});
						getNewUsers ( $limit );
					}  else {
						//console.log($scope.users);
					}
				} 
			}); 
	};



	$scope.activeMe = ( user )=> {



		var data = $.param({
			action: 'active-new-user',
			key: user.key
		});


		serverService.post(data, $scope).then(function(response) {    
			if(response.status == 1) {  
				toastr.success( response.message);
				$index = $scope.users.indexOf(user);
				$scope.users.splice($index, 1);
			}  else {
				toastr.error( response.message);
			}
		}); 

	};

	$timeout( function(){
		// toastr.success('I don\'t need a title to live' );


		getNewUsers ( 1 );
	},1);
});




doctor_app.controller( 'doctor_appControllerUserExisting', function($timeout, $scope, $http, $location, $filter,$sce, myservice, toastr, cfpLoadingBar, serverService){
	doCheckUser($scope, $http);
	$scope.users = [];

	var getExistingUsers = ( $limit ) => { 

		var data = $.param({
			action: 'get-existing-user',
			from: $scope.users.length,
			limit: $limit
		});


		serverService.post(data, $scope).then(function(response) {   

			if(response.status == 3) {  
				if(response.data)
					if(response.data.length > 0){
						angular.forEach( response.data, function(value, key){
							$scope.users.push(value);
						});
						getExistingUsers ( $limit );
					}  else {
						//console.log($scope.users);
					}
				} 
			}); 
	};

	$scope.viewMe = () => {

	};

	$scope.deleteMe = ( user )=> {



		var data = $.param({
			action: 'delete-user',
			key: user.key, 
			delete: user.delete 
		});


		serverService.post(data, $scope).then(function(response) {    
			if(response.status == 1) {  


				angular.forEach( $scope.users, function(value, key){
					if( value.key == user.key   )				
						value.delete = user.delete == 0 ? 1 : 0;   
				}); 

				toastr.success( response.message);  

			}  else {
				toastr.error( response.message);
			}
		}); 

	};

	$timeout( function(){
		// toastr.success('I don\'t need a title to live' );


		getExistingUsers ( 1 );
	},1);


});






doctor_app.controller( 'doctor_appControllerReportDisease', function($timeout, $scope, $http, $window, $location, $filter,$sce, myservice, toastr, cfpLoadingBar, serverService){
	doCheckUser($scope, $http);
	$scope.diagnosis = [];
	$scope.disease = [];
	$scope.profile = [];


	$scope.districts = $window.getDistricts();
	var currentId = 0;
	var eachPas = () => {
		return  { 
			id: 0,
			date: new Date(),
			name : '',
			age : '',
			gender : '',
			district: '',
			blocks : [],
			block:'',
			diagnosis : '',
			desc : '',
			address : '',
			contact : '',
			plongitude : '',
			platitude : '',
			is_edit : false

		};
	}; 
	var doFirst = () =>{

		$scope.disease = [  ];
		$scope.disease_new = eachPas();

	};
	$scope.o_is_show = true;
	$scope.expaCol = ( index  ) => {
		$scope.o_is_show = false;
		var tert = true;
		angular.forEach( $scope.disease, function(value, key){  
			value.is_edit = value.is_edit ? false : true; 
			if(  key != index ){
				value.is_edit = false;
			}  
			if(value.is_edit) { 
				tert = false;
			}
		}); 
		console.log(tert);
		if(tert){
			$scope.o_is_show = true;
		}
	};

	$scope.expaColLast = () => {
		$scope.expaCol ( -1 );
		

	};

	$scope.remveADrft = ( samle ) => {

	};

	$scope.saveAsDrft = ( dataX ) => {
		updateDateB( false); 

		$scope.expaCol ( -1 );
	};

	$scope.$watch('disease_new.district', function(val){ 
		$scope.blocks = $window.getBlocks( val );  
	});
	$scope.getMyBlocks =   function(val){ 
		console.log(  val );
		return $window.getBlocks( val );  
	};

	$scope.saveData = () => {
		angular.element( $('#jQuery_trigger')).trigger('click');

		$formVa = true;

		if( ! $('#tprFrbd').parsley().validate() ){
			$formVa = false;
		}

		//console.log($formVa );
		angular.forEach( $scope.disease.each, function(value, key){     
			if( ! $('#feacForm-'+value.id).parsley().validate() ){
				$formVa = false;

			}
		});  
		if($formVa ){
			//console.log('successfully');
			updateDateB( true);

		}
	};

	var updateDateB = ( $done) => {

		console.log($scope.disease);
		$json = null;
		try {
			$json =  angular.toJson($scope.disease);
		} catch(err) { }
		

		if( ! $json) {
			toastr.error('invalid data');
			return;
		} 


		var data = $.param({
			action: 'update-today-surveillance',
			data: $json ,
			done: $done,
			id: currentId
		});


		serverService.post(data, $scope).then(function(response) {    
			//console.log(response);
			if(response.status == 1) {  
				if( $done ){
					
					doFirst();

					getTodaysSurveillance();
					toastr.success( response.message);  
				}  else { 


				}

			}  else {
				toastr.error( response.message);
			}
		}); 



	};

	$scope.$watch('disease', function(nev) {
		console.log(nev);
	});

	$scope.addMewF = ( form ) => {  
		if(! form.$valid){
			return;
		}
		nwer = $scope.disease; 

		nwer.push($scope.disease_new );
		$scope.disease = nwer;
		$scope.disease_new =  eachPas() ;
		updateDateB( false );
	};


	$scope.clearData = ( each ) => {

		nwer = $scope.disease; 

		$index = nwer.indexOf(each);
		//console.log($index);
		if($index  > -1){
			if(confirm('are you sure you want to clear data')){
				nwer[$index] = eachPasvD  ( nwer[$index].id, nwer[$index].user_id);  
				$scope.disease = nwer; 
				$scope.saveAsDrft( nwer[$index] );
			}
		}
	};

	$scope.removeData = ( each ) => {

		nwer = $scope.disease; 

		$index = nwer.indexOf(each);
		//console.log($index);
		if($index  > -1){
			if(confirm('are you sure you want to delete form')){



				nwer.splice($index, 1) ;  
				$scope.disease = nwer; 

				
				updateDateB( false); 

				$scope.expaCol ( -1 );



			}
		}
	};

	var getUserData = () => {

		cfpLoadingBar.start();
		var data = $.param({
			action: 'get-profile'
		});


		serverService.post(data, $scope).then(function(response) {  


			if(! (response === null || response === undefined) )

				if(response.status == 3) {
					$scope.profile = response.data;
					pushMe ($scope.profile , {phone: parseInt(response.data.phone) , experience: parseInt(response.data.experience) } );

					angular.forEach( $scope.disease, function(value, key){ 
						if(key == 'district' && ! $scope.disease[key]){ 
							$scope.disease[key] = $scope.profile.district;
						}
						if(key == 'hospital' && !$scope.disease[key]){
							$scope.disease[key] = $scope.profile.hospital;
						}
						if(key == 'hospital_type' && !$scope.disease[key]){
							$scope.disease[key] = $scope.profile.hospital_type;
						}
					});  




				} else if(response.status == 2) {
					toastr.error( response.message );
				} else {
					toastr.info( response.message );


				}

				cfpLoadingBar.complete();
			});




	};


	var getTodaysSurveillance = () => {

		var data = $.param({
			action: 'get-tody-surveillance'
		});





		serverService.post(data, $scope).then(function(response) {   

			if(response.status == 3) {  
				if(response.data) {

					doFirst();
					dDat = response.data;
					console.log(dDat);
					currentId = dDat.id; 
					try {
						if(dDat.data){ 
							$json =  angular.fromJson(dDat.data);  	
							$scope.disease = $json;
						}
					} catch (err){
						console.log( err );
					}

					console.log(currentId,$scope.disease);


					angular.forEach( $scope.disease, function(value, key){ 
						if(value.is_edit ){
							$scope.o_is_show = false; 
						}
					});
				}
				tyuo = true;
				if( $scope.disease) {  
					if($scope.disease.length)
						tyuo = false; 
				}  
				if (tyuo) { doFirst(); 
					$scope.o_is_show = true; }
				} 

				getUserData();
			}); 
	};


	var getDiagnosis = () => {

		var data = $.param({
			action: 'get-diagnosis-list'
		});





		serverService.post(data, $scope).then(function(response) {   

			if(response.status == 3) {  
				if(response.data)
					if(response.data.length > 0){
						angular.forEach( response.data, function(value, key){
							$scope.diagnosis.push(value);
						});  
					}   

					
				} 

				getTodaysSurveillance();
			}); 
	};

	$timeout( function(){ 
		getDiagnosis();

	},1);
});


doctor_app.controller( 'doctor_appControllerReportedDisease', function($timeout, $scope, $http, $location, $filter,$sce, myservice, toastr, cfpLoadingBar, serverService){
	doCheckUser($scope, $http);
	$scope.diseases = [];
	$scope.diseasesBase = [];
	$scope.diseasesBaseRoot = [];

	$scope.showDateOnly = (dateFiter)  => { 
		$timeout(function(){
			if(dateFiter == 0)
				$scope.diseases = $scope.diseasesBase;
			else
				$scope.diseases = $scope.diseasesBase.filter(function (obj) { 
					return obj.date == dateFiter;
				});  
		});

	};

	$scope.viewMe = (disease ) => {
		myservice.name = disease;
		$location.path('doctor-view-disease');
	};

	var getAddedDig = ( $limit ) => { 

		var data = $.param({
			action: 'get-added-diseases',
			from: $scope.diseasesBaseRoot.length,
			limit: $limit
		});


		serverService.post(data, $scope).then(function(response) {   





			if(response.status == 3) {  
				if(response.data){

					angular.forEach(response.data , function(valueOut, keyOut){
						$scope.diseasesBaseRoot.push(valueOut);
						
						$json =  angular.fromJson(valueOut.data); 
						console.log( $json  );
						if( $json ){
							angular.forEach( $json , function(value, key){ 

								console.log( value );
								$scope.diseasesBase.push(value);   
								$scope.diseases = $scope.diseasesBase;   

							});
							getAddedDig ( $limit );
						}  else { 
							console.log($scope.diseases);
						}
					});

					
				} 
			} 
		}); 
	};


	$timeout( function(){ 
		getAddedDig( 1);
	},1);
});




doctor_app.controller( 'doctor_appControllerViewDisease', function($timeout, $scope, $http, $location, $filter,$sce, myservice, toastr, cfpLoadingBar, serverService){
	doCheckUser($scope, $http);

	$scope.disease = myservice.name;
	// myservice.name = null;
	if( ! $scope.disease ){
		toastr.warning('Select a Surveillance ');
		$location.path('doctor-reported-disease');
	}

	//console.log($scope.userData);






	$timeout( function(){ 
	},999);
});






doctor_app.controller( 'doctor_appControllerReportFile', function($timeout, $scope, $http, $location, $filter,$sce, myservice, toastr, cfpLoadingBar, serverService){
	doCheckUser($scope, $http);


	$scope.expire = null;
	$scope.date = null;
	$scope.disease = {
		date :new Date() ,
		description: '',
		attachment:null
	};
	$scope.buttonDisable = false;
$scope.operationStatus = 1; // fora add
$scope.singleFile = true;
$scope.files = [];





// =================================================================
// =================================================================

$scope.tmp = {
	image: null
};


$scope.selectedfiles = [];


//============== DRAG & DROP =============
// source for drag&drop: http://www.webappers.com/2011/09/28/drag-drop-file-upload-with-html5-javascript/
var dropbox = document.getElementById("dropbox")
$scope.dropText = 'Drop files here...'

// init event handlers
function dragEnterLeave(evt) {
	evt.stopPropagation()
	evt.preventDefault()
	$scope.$apply(function(){
		$scope.dropText = 'Drop files here...'
		$scope.dropClass = ''
	})
}


if(dropbox) {
	dropbox.addEventListener("dragenter", dragEnterLeave, false)
	dropbox.addEventListener("dragleave", dragEnterLeave, false)
	dropbox.addEventListener("dragover", function(evt) {
		evt.stopPropagation()
		evt.preventDefault()
		var clazz = 'not-available'
		var ok = evt.dataTransfer && evt.dataTransfer.types && evt.dataTransfer.types.indexOf('Files') >= 0
		$scope.$apply(function(){
			$scope.dropText = ok ? 'Drop files here...' : 'Only files are allowed!'
			$scope.dropClass = ok ? 'over' : 'not-available'
		})
	}, false)
	dropbox.addEventListener("drop", function(evt) {
		//console.log('drop evt:', JSON.parse(JSON.stringify(evt.dataTransfer)))
		evt.stopPropagation()
		evt.preventDefault()
		$scope.$apply(function(){
			$scope.dropText = 'Drop files here...'
			$scope.dropClass = ''
		})
		var files = evt.dataTransfer.files
		if (files.length > 0) {
			$scope.$apply(function(){ 
				if($scope.singleFile)
					$scope.files = [];

				angular.forEach(files,  function(value, key){  
					$scope.files.push({
						name: value.name,
						image:  null,
						file:value,
						description: '',
						show: false
					});  
				});  
				varStartNow ();   
			})
		}
	}, false)

}
//============== DRAG & DROP =============




$scope.setImages = function(element) {
	$scope.$apply(function(scope) { 
		if($scope.singleFile)
			$scope.files = [];

		angular.forEach(element.files,  function(value, key){  
			$scope.files.push({
				name: value.name,
				image:  null,
				file:value,
				description: '',
				show: false
			});  
		});  
		varStartNow ();
	});
};









// =========================================

$scope.extensao = '';

$scope.type = null;


function dataURItoBlob(dataURI) { 
	var byteString;
	if (dataURI.split(',')[0].indexOf('base64') >= 0)
		byteString = atob(dataURI.split(',')[1]);
	else
		byteString = unescape(dataURI.split(',')[1]); 
	var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0]; 
	var ia = new Uint8Array(byteString.length);
	for (var i = 0; i < byteString.length; i++) {
		ia[i] = byteString.charCodeAt(i);
	}

	return new Blob([ia], {type:mimeString});
}

var showImage = function (imagem) {

	$scope.extensao = ''; 
	if (imagem.toLowerCase().indexOf('image/jpeg') > 0) {
		$scope.type = 'image/jpeg';
		$scope.extensao = '.jpg';
	} else
	if (imagem.toLowerCase().indexOf('image/png') > 0) {
		$scope.type = 'image/png';
		$scope.extensao = '.png';
	} else
	if (imagem.toLowerCase().indexOf('application/pdf') > 0) {
		$scope.type = 'application/pdf';
		$scope.extensao = '.pdf';
	} else
	if (imagem.toLowerCase().indexOf('application/msword') > 0) {
		$scope.type = 'application/msword';
		$scope.extensao = '.doc';
	} else {
		$scope.type = 'application/octet-stream';
		$scope.extensao = '.docx';
	}

	var decodedImage = dataURItoBlob(imagem);
	var blob = new Blob([decodedImage], { type: $scope.type });
	var fileURL = URL.createObjectURL(blob);







	tempIndex = $scope.files.indexOf($scope.currentCrop);
	$ty = {
		name: $scope.currentCrop.name,
		image: $sce.trustAsResourceUrl(fileURL),
		file:$scope.currentCrop.file,
		type: $scope.extensao,
		show: true
	};
	//console.log($ty);
	//console.log($scope.files);
	$scope.files[tempIndex ] =$ty; 
	//console.log($scope.files);


	varStartNow();


}




var uploadAction = (file) => { 

	//console.log(file);


	if(file === undefined)
		return;


	var photofile = file;
	var reader = new FileReader();


	$scope.extensao = file.name; 

	reader.onload = function (e) {  

		$scope.$apply(function($scope){
			showImage( e.target.result); 
		});

	};
	reader.readAsDataURL(photofile);


};

$scope.currentCrop  = [];

var varStartNow = () => {



	$scope.currentCrop  = [];
	tempIndex = -1;

	angular.forEach( $scope.files , function(value, key){  
		if(! value.show && tempIndex == -1){
			$scope.currentCrop = value;
			uploadAction ($scope.currentCrop.file );
			tempIndex = $scope.files.indexOf(value);
		}
	});  



};




$scope.removeMeM = (file) => { 
	tempIndex = $scope.files.indexOf(file);
	if(tempIndex > -1 ){ 
		$scope.files.splice(tempIndex, 1);
	}
};




// =================================================================
// =================================================================

$scope.progressVisible = false;
$scope.progress = 0; 
function uploadProgresses(evt, $scope) {
	$scope.progressVisible = true;
	$scope.progress = Math.round(evt.loaded * 100 / evt.total);

}




$scope.uploadFile = () =>  {



	if ( true ) {
		//console.log($scope.disease); 


		if(Object.size($scope.files ) < 1){
			toastr.warning( " no file added !! " );
			return;
		}

		var form_data = new FormData();
		$imagesN = [];
		angular.forEach($scope.files, function(file){ 
			form_data.append('file[]', file.file);


		}); 


		angular.forEach( $scope.disease, function(value, key){ 
			//console.log(key, value); 
			form_data.append(key, value);
		}); 



		form_data.append('action', 'add-file'); 


		$scope.buttonDisable = true;

		$http.post("ajax", form_data,

		{
			headers : {
				'Content-Type': undefined,
				'X-Requested-With': 'XMLHttpRequest',
				'CsrfToken': token.attr('content')
			},

			uploadEventHandlers: { progress: function(e) {
				uploadProgresses(e, $scope);
			}
		}


	}
	)
		.then(function mySuccess(response) {

			$scope.buttonDisable = false;
			response = userAuthenticationAgent($scope, response);
			//console.log(response); 

			success = response.status;
			if(success == 1){


				$scope.progressVisible = false;
				$scope.progress = 0;

				$scope.files =[];
				toastr.success( response.message );

				editCropedImg = false; 

				$scope.disease = {
					date :new Date() ,
					description: '',
					attachment:null
				};

			} else if(success == 2){

				toastr.warning( response.message );

			} else {
				toastr.error( response.message );
			}



		}, function myError(response) {
			//console.log(response);
		});







	}



};





$timeout( function(){


},999);
});


doctor_app.controller( 'doctor_appControllerReportedFile', function($timeout, $scope, $http, $location, $window, $filter,$sce, myservice, toastr, cfpLoadingBar, serverService){

	doCheckUser($scope, $http);
	$scope.diseases = [];
	$scope.diseasesBase = [];

	$scope.showDateOnly = (dateFiter)  => { 
		$timeout(function(){
			if(dateFiter == 0)
				$scope.diseases = $scope.diseasesBase;
			else
				$scope.diseases = $scope.diseasesBase.filter(function (obj) { 
					return obj.date == dateFiter;
				});  
		});

	};

	$scope.viewMe = (disease ) => {


		var data = $.param({
			action: 'download-file', 
			key: disease.key
		});
		serverService.post(data, $scope).then(function(response) { 

			if(response.data.status ){ 
				var file =  $scope.$parent.b64toBlob( response.data.file, response.data.type);  
				var isChrome = !!window.chrome && !!window.chrome.webstore;
				var isIE = /*@cc_on!@*/false || !!document.documentMode;
				var isEdge = !isIE && !!window.StyleMedia; 
				if (isChrome){
					var url = window.URL || window.webkitURL; 
					var downloadLink = angular.element('<a></a>');
					downloadLink.attr('href',url.createObjectURL(file));
					downloadLink.attr('target','_self');
					downloadLink.attr('download', response.data.name+'.'+response.data.extension);
					downloadLink[0].click();
				}
				else if(isEdge || isIE){
					window.navigator.msSaveOrOpenBlob(file, response.data.name+'.'+response.data.extension); 
				}
				else {
					var fileURL = URL.createObjectURL(file);
					window.open(fileURL);
				} 
			} else {
				toastr.warning("sorry this file doesn't exist !!");
			}
		});  


	};

	var getAddedDig = ( $limit ) => { 

		var data = $.param({
			action: 'get-added-files',
			from: $scope.diseasesBase.length,
			limit: $limit
		});


		serverService.post(data, $scope).then(function(response) {   


			//console.log(response);


			if(response.status == 3) {  
				if(response.data){

					$json =  angular.fromJson(response.data); 

					if( $json.length > 0){
						angular.forEach( $json , function(value, key){ 

							$scope.diseasesBase.push(value);   
							$scope.diseases = $scope.diseasesBase;   

						});
						getAddedDig ( $limit );
					}  else { 
					}
				} 
			} 
		}); 
	};


	$timeout( function(){ 
		getAddedDig( 1);
	},1);


});




doctor_app.controller( 'doctor_appControllerNotification', function($timeout, $scope, $http, $location, $filter,$sce, myservice, toastr, cfpLoadingBar, serverService){
	doCheckUser($scope, $http);
	$scope.notifications = $scope.$parent.notifications;
	$scope.notification = [];

	var url = $location.path().split('/');
	$scope.firstParameter = url[2]; 

	console.log($scope.firstParameter);



	$timeout( function(){ 

		angular.forEach( $scope.notifications , function(value, key){ 

			if (value.key == $scope.firstParameter) {
				$scope.notification = value;
			} 

		});
		console.log($scope.notification);


	},999);
});


doctor_app.controller( 'doctor_appController0', function($timeout, $scope, $http, $location, $filter,$sce, myservice, toastr, cfpLoadingBar, serverService){
	doCheckUser($scope, $http);
	$timeout( function(){ 
		


	},999);
});






function getFormattedDate() {
	var date = new Date();
	var str = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate() + " " +  date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();

	return str;
}

function userAuthenticationAgent ($scope, response){
	returnResponse = null;
	loname = null;
	// //console.log(response);
	try {
		response = response.data;
		response =angular.fromJson(response);
		returnResponse = { status: response.success ,  data:response.data,  message: response.remark};
		if(response.success == -1 ){
			try{
				loname = localStorage.localusername;
			} catch (err){
				alert("something went wrong, manually reload the page !");
			}

			returnResponse = { status: response.success ,  data:[],  message: response.remark};

			$scope.$parent.authentication = {username : loname,
				lockscreen: 'doctor/pages/lockscreen.html',
				isLock: true,
				password: null,
				invalidPassword: false,
				remark: 'user session timeout'
			};
		}else if(response.success == 1 ){
			try{
				loname = localStorage.localusername;
			} catch (err){
				alert("something went wrong, manually reload the page !");
			}
			$scope.authentication = {username : loname,
				isLock: false,
				lockscreen: null,
				password: null,
				invalidPassword: false,
				remark: 'access granted'
			};
		}

	}
	catch(err) {
		//console.log("error here");
	}

	return returnResponse;
}

function doCheckUser($scope,$http) {
	$scope.authentication = {lockscreen : null};
	var data = $.param({
		action: 'check-user'
	});

	$http.post("ajax", data, config)
	.then(function mySuccess(response) {
		response = userAuthenticationAgent($scope, response);
	}, function myError(response) {
		alert("server error 500");
	});
}
