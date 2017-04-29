
<!DOCTYPE HTML>
<html data-ng-app="UserApp">
<head>
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>-->
<!--ink href="web/css/bootstrap-3.1.1.min.css" rel='stylesheet' type='text/css' /> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">
<!-- Custom Theme files -->
<link href="web/css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Roboto:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
<!----font-Awesome----->
<link href="web/css/font-awesome.css" rel="stylesheet"> 
<!----font-Awesome----->

</head>
<body>
<div  id="test" data-ng-include="'template/User/header.html'" data-ng-controller="HeaderController" ></div>
<!--header-->


<div>
<div ui-view class="fade-in-up"></div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="web/js/jquery.min.js"></script>
<script src="web/js/bootstrap.min.js"></script>
        <script src="assets/angularjs/angular.min.js" type="text/javascript"></script>
        <script src="assets/angularjs/angular-sanitize.min.js" type="text/javascript"></script>
        <script src="assets/angularjs/angular-touch.min.js" type="text/javascript"></script>
        <script src="assets/angularjs/plugins/angular-ui-router.min.js" type="text/javascript"></script>
        <script src="assets/angularjs/plugins/ocLazyLoad.min.js" type="text/javascript"></script>
		<script src="assets/angularjs/plugins/ui-bootstrap-tpls.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/angularjs/ngMeta.js"></script>
		<script src="assets/angularjs/angular-ui-utils.min.js"></script>
		
		<script src="assets/angularjs/angular-cookies.js" type="text/javascript"></script>
		  <!-- BEGIN APP LEVEL ANGULARJS SCRIPTS -->
        <script src="js/user.js" type="text/javascript"></script>
       		 <script src="assets/angularjs/checklist-model.js" type="text/javascript"></script>
		
		 
<div data-ng-include="'template/User/footer.html'" data-ng-controller="FooterController" class="page-footer"> </div>
</body>
</html>