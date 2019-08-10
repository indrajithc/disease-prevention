/*
* @Author: indran
* @Date:   2018-09-01 01:21:18
* @Last Modified by:   indran
* @Last Modified time: 2018-11-22 14:40:04
*/
var admin_app = angular.module( 'app-admin', ['ngRoute', 'ngAnimate',  
	'toastr', 'ngImgCrop' ,  'ngtimeago', 'ui.bootstrap', 'angular-img-cropper', 
	'dcbImgFallback',  'ngSanitize', 'angularUtils.directives.dirPagination', 'moment-picker', 
	'angular-loading-bar','ui.sortable', 'angular.filter'  ]);
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


admin_app.config([ '$routeProvider', '$locationProvider', function( $routeProvider, $locationProvider ) {
	$routeProvider
	.when('/admin-dashboard', {
		templateUrl: 'admin/pages/home.html',
		controller: 'admin_appController0'
	})
	.when('/admin-profile', {
		templateUrl: 'admin/pages/profile.html',
		controller: 'admin_appControllerProfile'
	})
	.when('/admin-settings', {
		templateUrl: 'admin/pages/settings.html',
		controller: 'admin_appControllerSettings'
	}) 
	.when('/admin-confirmation', {
		templateUrl: 'admin/pages/confirmation.html',
		controller: 'admin_appControllerConfirmation'
	}) 
	.when('/admin-user-existing', {
		templateUrl: 'admin/pages/user-existing.html',
		controller: 'admin_appControllerUserExisting'
	}) 
	.when('/admin-user-view', {
		templateUrl: 'admin/pages/user-view.html',
		controller: 'admin_appControllerUserView'
	}) 

	.when('/admin-reported-disease', {
		templateUrl: 'admin/pages/reported-disease.html',
		controller: 'admin_appControllerUseReportedDdisease'
	}) 
	.when('/admin-view-disease', {
		templateUrl: 'admin/pages/view-disease.html',
		controller: 'admin_appControllerUserViewDisease'
	}) 
	.when('/admin-reported-file', {
		templateUrl: 'admin/pages/reported-file.html',
		controller: 'admin_appControllerUserReportedFile'
	}) 
	.when('/admin-export-report', {
		templateUrl: 'admin/pages/export-report.html',
		controller: 'admin_appControllerUserExportReport'
	}) 
	.when('/admin-notification', {
		templateUrl: 'admin/pages/notification.html',
		controller: 'admin_appControllerUserNotification'
	}) 



	
	.otherwise({
		redirectTo: '/admin-dashboard'
	});

	$locationProvider.html5Mode({
		enabled: true,
		requireBase: false
	});

}]);
//admin_appControllerDoctorSingleView
admin_app.run( function($rootScope, cfpLoadingBar,  $location, $timeout, $window) {

	$rootScope.$on('$routeChangeStart', function() {
		cfpLoadingBar.start();
	});

	$rootScope.$on('$routeChangeSuccess', function() {
		cfpLoadingBar.complete(); 
		$window.currentUr = $location.path().replace('/', '').trim(); 
		angular.element( $('#jQuery_trigger')).trigger('click');
	});


});
admin_app.filter('active', [ function() {
	return function (object) {
		var array = [];
		angular.forEach(object, function (data) {
			if (data.delete == '0')
				array.push(data);
		});
		return array;
	};
}]);

// admin_app.run(function(editableOptions, editableThemes) {
// editableThemes.bs3.inputClass = 'input-sm';
// editableThemes.bs3.buttonsClass = 'btn-sm';
// editableOptions.theme = 'bs3';
// });


// public_app.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
// cfpLoadingBarProvider.includeSpinner = false;
// }]);
/*==================================================>>======================================================*/


admin_app .directive('inputType', ['$compile', function ($compile) {
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





// admin_app.directive('showTab',
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



admin_app.service('myservice', function() {
	this.value = null;
	this.name = null;
});

admin_app.config(function(toastrConfig) {
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



admin_app.filter('orderObjectBy', function(){
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


// admin_app.config(function(paginationTemplateProvider) {
// 	paginationTemplateProvider.setPath('assets/js/dirPagination.tpl.html');
// });

admin_app.directive('parsleyValidateInput', function($timeout) {
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



admin_app.directive('pdf', function() {
	return {
		restrict: 'E',
		link: function(scope, element, attrs) {
			var url = scope.$eval(attrs.src);
			element.replaceWith('<object width="100%" height="100%" type="application/pdf" data="' + url + '"></object>');
		}
	};
});


admin_app.factory('serverService', function($http) {
	return {
		post: function(data, $scope) { 
			return $http.post("ajax", data, config)
			.then(function  success(response) { 
				return  userAuthenticationAgent ( $scope, response); 
			}, function myError(response) { 
				console.log("error ");
			});
		}
	}
});


admin_app.filter('ageFilter', function() {
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




/* Directive */
admin_app
.directive('excelExport',
	function () {
		return {
			restrict: 'A',
			scope: {
				fileName: "@",
				data: "&exportData"
			},
			replace: true,
			template: '<button class="btn btn-outline-info btn-sm text-uppercase " ng-click="download()">Export to Excel <i class="fa fa-download"></i></button>',
			link: function (scope, element) {

				scope.download = function() {

					function datenum(v, date1904) {
						if(date1904) v+=1462;
						var epoch = Date.parse(v);
						return (epoch - new Date(Date.UTC(1899, 11, 30))) / (24 * 60 * 60 * 1000);
					};

					function getSheet(data, opts) {
						var ws = {};
						var range = {s: {c:10000000, r:10000000}, e: {c:0, r:0 }};
						for(var R = 0; R != data.length; ++R) {
							for(var C = 0; C != data[R].length; ++C) {
								if(range.s.r > R) range.s.r = R;
								if(range.s.c > C) range.s.c = C;
								if(range.e.r < R) range.e.r = R;
								if(range.e.c < C) range.e.c = C;
								var cell = {v: data[R][C] };
								if(cell.v == null) continue;
								var cell_ref = XLSX.utils.encode_cell({c:C,r:R});

								if(typeof cell.v === 'number') cell.t = 'n';
								else if(typeof cell.v === 'boolean') cell.t = 'b';
								else if(cell.v instanceof Date) {
									cell.t = 'n'; cell.z = XLSX.SSF._table[14];
									cell.v = datenum(cell.v);
								}
								else cell.t = 's';

								ws[cell_ref] = cell;
							}
						}
						if(range.s.c < 10000000) ws['!ref'] = XLSX.utils.encode_range(range);
						return ws;
					};

					function Workbook() {
						if(!(this instanceof Workbook)) return new Workbook();
						this.SheetNames = [];
						this.Sheets = {};
					}

					var wb = new Workbook(), ws = getSheet(scope.data());
					/* add worksheet to workbook */
					wb.SheetNames.push(scope.fileName);
					wb.Sheets[scope.fileName] = ws;
					var wbout = XLSX.write(wb, {bookType:'xlsx', bookSST:true, type: 'binary'});

					function s2ab(s) {
						var buf = new ArrayBuffer(s.length);
						var view = new Uint8Array(buf);
						for (var i=0; i!=s.length; ++i) view[i] = s.charCodeAt(i) & 0xFF;
							return buf;
					}

					saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), scope.fileName+'.xlsx');

				};

			}
		};
	}
	);



admin_app.controller( 'SystemControllerBoady',  function($timeout,$route, $location, $scope, $http, $filter , $window, myservice, toastr, cfpLoadingBar , serverService){
	$scope.exit =  function(){
		$window.location.href = 'exit';
	}

	$scope.newUserCount = 0;

	$scope.$watch(function () { return $window.currentUr  }, function(n,o){
		console.log(n);
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
	console.log(oldv , newv);
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
// 	console.log($scope.settings,  $scope.tmp1 );

// };

$scope.checkServer = () => {	
	getServerStatus();		
};

$scope.lockLogin = function() {


	var data = $.param({
		action:'admin-login',
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




$timeout( function(){ 
	cfpLoadingBar.start();



	var data = $.param({
		action: 'get-profile-basic'
	});

	serverService.post(data, $scope).then(function(response) {  

		// console.log(response);
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





	var data = $.param({
		action: 'get-new-user-count'
	});

	serverService.post(data, $scope).then(function(response) {   
		if(! (response === null || response === undefined) ){
			if(response.data){
				$scope.newUserCount = response.data[0].count;

			}
		}

	});



}, 9);










});






admin_app.controller( 'admin_appControllerProfile', function($timeout, $location, $scope, $http, $window, toastr, myservice, cfpLoadingBar , serverService){
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



$scope.adminProfileSubmit = () => {
	console.log($scope.profile);


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



		console.log(response);


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
	console.log( ($scope.enableCrop + '').length );
	console.log($scope.enableCrop);

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
          //console.log('Res image', $scope.resImageDataURI);
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

 // console.log(response);
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
				pushMe ($scope.profile , {phone: parseInt(response.data.phone) , landline: parseInt(response.data.landline) } );

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




admin_app.controller( 'admin_appControllerSettings', function($timeout, $scope, $http, $location, $filter, myservice, toastr, cfpLoadingBar, serverService){
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
			$scope.adminLogin.repassword.$invalid = true;
			$scope.adminLogin.$invalid = true;
		}
	});



$scope.$watch( 'login.newpassword', function(newdata) {
	$scope.misMPassword = null;
	var a =$scope.login.repassword ;
	var b = $scope.login.newpassword ;
	if ( a && b)
		if (a != b) {
			$scope.misMPassword = "Password mismatch";
			$scope.adminLogin.repassword.$invalid = true;
			$scope.adminLogin.$invalid = true;
		}
	});


$scope.$watch( 'login.password', function(newdata) {
	$scope.errorPassword = null;

});



$scope.$watch( 'login.newpassword', function(newdata) {
	$scope.errorNewPassword = null;
});

$scope.adminLoginSubmit = function () {


	if ($scope.login.newpassword != $scope.login.repassword) {
		$scope.misMPassword = "Password mismatch";
		$scope.adminLogin.repassword.$invalid = true;
		$scope.adminLogin.$invalid = true;
		return;
	}



	var exdata = {
		action: 'update-login',
		password: $scope.login.password,
		newpassword: $scope.login.repassword
	}
	var data = $.param(exdata);




	serverService.post(data, $scope).then(function(response) {  

		console.log(response);

		success = response.status;
		if(success == 1){


			toastr.success( 'successfully updated' );


			$scope.login = {dname: "test"};
		}

		if(success == 2){
			$scope.errorPassword = response.message;
			$scope.adminLogin.password.$invalid = true;
			$scope.adminLogin.$invalid = true;

		}

		if(success == 21){
			$scope.errorNewPassword = response.message;
			$scope.adminLogin.newpassword.$invalid = true;
			$scope.adminLogin.$invalid = true;

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





admin_app.controller( 'admin_appControllerConfirmation', function($timeout, $scope, $http, $location, $filter,$sce, myservice, toastr, cfpLoadingBar, serverService){
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
						console.log($scope.users);
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




admin_app.controller( 'admin_appControllerUserExisting', function($timeout, $scope, $http, $location, $filter,$sce, myservice, toastr, cfpLoadingBar, serverService){
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
						console.log($scope.users);
					}
				} 
			}); 
	};

	$scope.viewMe = ( user ) => {

		myservice.name = user.key;
		$location.path('admin-user-view');

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







admin_app.controller( 'admin_appControllerUserView', function($timeout, $scope, $http, $location, $filter,$sce, myservice, toastr, cfpLoadingBar, serverService){
	doCheckUser($scope, $http);

	$scope.userKey = myservice.name;
// myservice.name = null;
if( ! $scope.userKey ){
	toastr.warning('Select a user first ');
	$location.path('admin-user-existing');
}

$scope.user  = [];

var getUser = (userKey) => {

	var data = $.param({
		action: 'get-singe-user',
		key: userKey
	});


	serverService.post(data, $scope).then(function(response) {   

		if(response.status == 3) {  
			if(response.data){ 
				$scope.user = response.data;
				console.log($scope.user); 
			} else {

				toastr.warning('Select a user first ');
				$location.path('admin-user-existing');
			}

		} 
	}); 
};




$timeout( function(){
	getUser( $scope.userKey);

},1);
});








admin_app.controller( 'admin_appControllerUseReportedDdisease', function($timeout, $scope, $http, $location, $filter,$sce, myservice, toastr, cfpLoadingBar, serverService){
	doCheckUser($scope, $http);
	$scope.diseases = [];
	$scope.diseasesBase = [];
	$scope.diseasesBaseRoot = [];
	$scope.pageC = 5;

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
		$location.path('admin-view-disease');
	};

	$scope.openUSer =  ( disease) => {
		console.log(disease);
		myservice.name = disease.by_id;
		$location.path('admin-user-view');
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




admin_app.controller( 'admin_appControllerUserViewDisease', function($timeout, $scope, $http, $location, $filter,$sce, myservice, toastr, cfpLoadingBar, serverService){
	doCheckUser($scope, $http);

	$scope.disease = myservice.name;
	// myservice.name = null;
	if( ! $scope.disease ){
		toastr.warning('Select a Surveillance ');
		$location.path('admin-reported-disease');
	}

	$scope.openUSer =  ( disease) => {

		myservice.name = disease.by_id;
		$location.path('admin-user-view');
	};






	$timeout( function(){ 
	});
});




admin_app.controller( 'admin_appControllerUserReportedFile', function($timeout, $scope, $http, $location, $filter,$sce, myservice, toastr, cfpLoadingBar, serverService){

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


	$scope.openUSer =  ( disease) => {

		myservice.name = disease.by_id;
		$location.path('admin-user-view');
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




admin_app.controller( 'admin_appControllerUserExportReport', function($timeout, $scope, $http, $location, $filter,$sce, myservice, toastr, cfpLoadingBar, serverService){
	doCheckUser($scope, $http);
	$scope.diseases = [];
	$scope.diseasesBase = [];
	$scope.diseasesBaseRoot = [];
	$scope.pageC = 5;


	var exportToEx = () => {

		$scope.jsonToExport = [ ];



		angular.forEach( $scope.diseasesBase , function(value, key){ 
			console.log(value);
			$scope.jsonToExport.push({
				name   : value.name ,
				gender   : value.gender  ,
				age  : value.age ,
				contact : value.contact,
				address : value.address,
				district  : value.district , 
				block   : value.block  ,
				diagnosis : value.diagnosis,
				desc : value.desc,
				date  : value.date  
			});
		});


	// Prepare Excel data:
	$scope.fileName = "report";
	$scope.exportData = [];
  // Headers:
  $scope.exportData.push(["#", "NAME", "GENDER", "AGE", "CONTACT", "ADDRESS", "DISTRICT", "BLOCK", "DIAGNOSIS", "OTHER CONDITIONS ", "DATE" ]);
  // Data:
  angular.forEach($scope.jsonToExport, function(value, key) {
  	$scope.exportData.push([ (key+1) , value.name , value.gender , value.age , value.contact , value.address , value.district , value.block , value.diagnosis , value.desc , value.date]);
  });



};







$scope.getExportData = () => { 
	$scope.diseases = [];
	$scope.diseasesBase = [];
	$scope.diseasesBaseRoot = [];

	var data = $.param({
		action: 'get-added-diseases-filter-date',
		from:  $scope.dfrom,
		to:  $scope.dto
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
						exportToEx(); 
					}  else { 

					}


				});


			}  
		} 

		if( $scope.diseasesBase.length < 1){
			toastr.warning('no result found');
		}

	}); 


};




$timeout( function(){






},999);
});



admin_app.controller( 'admin_appControllerUserNotification', function($timeout, $window, $scope, $http, $location, $filter,$sce, myservice, toastr, cfpLoadingBar, serverService){
	doCheckUser($scope, $http);
	doCheckUser($scope, $http);


	$scope.districts = $window.getDistricts();


	$scope.expire = null;
	$scope.date = null;

	mydate = new Date(); 

	$scope.date = $filter('date')(mydate,'yyyy-MM-dd');
	var numberOfDaysToAdd = 7;
	newdate = mydate.setDate(mydate.getDate() + numberOfDaysToAdd); 




	$scope.notification = {
		expiry : $filter('date')(newdate,'yyyy-MM-dd') ,
		type : '',
		subject : '',
		description : '',
		district: [],
		wards:[]

	};
	$scope.buttonDisable = false;
$scope.operationStatus = 1; // fora add
$scope.singleFile = true;
$scope.files = [];


$scope.diseaseEach = {
	district: '',
	blocks: '',
	block: '',
	blocks: ''

};
$scope.getMyBlocks =   function(val){ 
	console.log(  val );
	return $window.getBlocks( val );  
};


$scope.addNow = () => {

	console.log($scope.diseaseEach);
	if ($scope.diseaseEach.district) {
		district = $scope.notification.district;
		if(district.indexOf( $scope.diseaseEach.district) !== -1) {

			toastr.warning('already added');

		} else {

			district.push( $scope.diseaseEach.district ); 
			pushMe( $scope.notification , {district: district });
		} 
	}	


	console.log($scope.notification);
};

$scope.temoveDist = (value) => {

	if (value) {
		district = $scope.notification.district;
		if(district.indexOf( value) !== -1) { 

			district.splice(district.indexOf( value), 1);   
			pushMe( $scope.notification , {district: district });

			toastr.success('removed');
		} else {

			toastr.warning('missing data');
		} 
	}	


	console.log($scope.notification);



};


$scope.addNewNotfi = () => {

	if ($scope.notification.district.length < 1) {
		toastr.warning(' select district ');
		return;
	}
	cfpLoadingBar.start();



	var data = $.param({
		action: 'add-notification',
		expiry:  $scope.notification.expiry,
		type:  $scope.notification.type,
		subject:  $scope.notification.subject,
		description:  $scope.notification.description,
		district:   JSON.stringify($scope.notification.district) 
	}); 



	serverService.post(data, $scope).then(function(response) {  


		console.log(response);
		if(! (response === null || response === undefined) )

			if(response.status == 1) { 


				$scope.notification = {
					expiry : $filter('date')(newdate,'yyyy-MM-dd') ,
					type : '',
					subject : '',
					description : '',
					district: [],
					wards:[]

				};

				toastr.success(response.message);
				$scope.notifications = [];

				getAddedDig(1);
			}  else {
				toastr.info( response.message );


			}

			cfpLoadingBar.complete();
		});



};

$scope.notifications = [];
var getAddedDig = ( $limit ) => { 

	var data = $.param({
		action: 'get-notification',
		from: $scope.notifications.length,
		limit: $limit
	});


	serverService.post(data, $scope).then(function(response) {   


			//console.log(response);


			if(response.status == 3) {  
				if(response.data){

					$json =  angular.fromJson(response.data); 

					if( $json.length > 0){
						angular.forEach( $json , function(value, key){  
							
							value['to'] = angular.fromJson( value.to);
							
							$scope.notifications.push(value);   
						});
						getAddedDig ( $limit );
					}  else { 
						console.log($scope.notifications);
					}
				} 
			} 
		}); 
};




$scope.deleteMe = ( notification )=> {



	var data = $.param({
		action: 'delete-notification',
		key: notification.key, 
		delete: notification.delete 
	});


	serverService.post(data, $scope).then(function(response) {    
		if(response.status == 1) {  


			angular.forEach( $scope.notifications, function(value, key){
				if( value.key == notification.key   )				
					value.delete = notification.delete == 0 ? 1 : 0;   
			}); 

			toastr.success( response.message);  

		}  else {
			toastr.error( response.message);
		}
	}); 

};



$timeout( function(){


	getAddedDig(1);



},999);
});




admin_app.controller( 'admin_appController0', function($timeout, $scope, $http, $location, $filter,$sce, myservice, toastr, cfpLoadingBar, serverService){
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
	// console.log(response);
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
				lockscreen: 'admin/pages/lockscreen.html',
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
		console.log("error here");
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
		console.log("server error 500");
	});
}
