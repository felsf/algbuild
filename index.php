<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<head>
<title>Projeto Alg.</title>
</head>

<script src="scripts/js/angular.min.js"></script>
<script src="scripts/js/jquery-1.11.3.min.js"></script>
<script src="scripts/js/bootstrap.min.js"></script>
<script src="scripts/js/Chart.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<script>
var x = 0;
function teste() {
	document.getElementById('texter').value = x++;
}
</script>

<body ng-app="" onLoad="setInterval(function(){teste()}, 1000)">

<input type="text" ng-model="texter" id="texter">

<h3>{{texter}}</h3>

</body>