<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags always come first -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>ЦУП панель администратора</title>
	
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
	<!-- Bootstrap core CSS -->
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="/css/mdb.min.css" rel="stylesheet">
	
	<style>
		.pointer{
			cursor:pointer;
		}
		html,
		body,
		header,
		.view {
			height: 100vh;
		}
		
		@media (max-width: 740px) {
			html,
			body,
			header,
			.view {
				height: 815px;
			}
		}
		
		@media (min-width: 800px) and (max-width: 850px) {
			html,
			body,
			header,
			.view  {
				height: 650px;
			}
		}
		
		.intro-2 {
			background: url("https://mdbootstrap.com/img/Photos/Horizontal/Nature/full page/img%20(11).jpg")no-repeat center center;
			background-size: cover;
		}
		.top-nav-collapse {
			background-color: #3f51b5 !important;
		}
		.navbar:not(.top-nav-collapse) {
			background: transparent !important;
		}
		@media (max-width: 768px) {
			.navbar:not(.top-nav-collapse) {
				background: #3f51b5 !important;
			}
		}
		@media (min-width: 800px) and (max-width: 850px) {
			.navbar:not(.top-nav-collapse) {
				background: #3f51b5!important;
			}
		}
		
		.card {
			background-color: rgba(229, 228, 255, 0.2);
		}
		.md-form label {
			color: #ffffff;
		}
		h6 {
			line-height: 1.7;
		}
		
		
		.card {
			margin-top: 30px;
			/*margin-bottom: -45px;*/
			
		}
		
		.md-form input[type=text]:focus:not([readonly]),
		.md-form input[type=password]:focus:not([readonly]) {
			border-bottom: 1px solid #8EDEF8;
			box-shadow: 0 1px 0 0 #8EDEF8;
		}
		.md-form input[type=text]:focus:not([readonly])+label,
		.md-form input[type=password]:focus:not([readonly])+label {
			color: #8EDEF8;
		}
		
		.md-form .form-control {
			color: #fff;
		}
	
	
	</style>

</head>

<body>


<!--Main Navigation-->
<header id="App">
	
	<nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar">
		<div class="container">
			<a class="navbar-brand" href="#"><strong>Админка</strong></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7"
			        aria-controls="navbarSupportedContent-7" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent-7">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<form action="admin/logout" method="post">
							<a class="nav-link"><button type="submit" class="btn btn-outline-dark btn-sm btn-rounded">Выйти</button></a>
						</form>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	
	<!--Intro Section-->
	<section class="view intro-2">
		<div class="mask rgba-stylish-strong h-100 d-flex justify-content-center align-items-center">
			<div class="container">
				<div class="row">
					<div class="col-xl-5 col-lg-6 col-md-10 col-sm-12 mx-auto mt-lg-5 pointer" >
						<div class="card wow fadeIn" data-wow-delay="0.3s" v-on:click="openModal">
							<div class="card-body">
								<h3 class="h3 text-center">Пользователи</h3>
								
							</div>
						</div>
					</div>
					
					<div class="col-xl-5 col-lg-6 col-md-10 col-sm-12 mx-auto mt-lg-5 pointer">
						<div class="card wow fadeIn" data-wow-delay="0.3s">
							<div class="card-body">
								<h3 class="h3 text-center">Каналы связи</h3>
							
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Окно</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">Х</button>
				</div>
				<div class="modal-body">
					<div class="container">
					
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
					<button type="button" class="btn btn-primary">Отправить</button>
				</div>
			</div>
		</div>
	</div>
</header>
<!--Main Navigation-->


<!--  SCRIPTS  -->
<!-- JQuery -->
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>
<script>
	new WOW().init();

</script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script>
	const app = new Vue({
		el:'#App',
		data:{
		
		},
		methods:{
			openModal(){
				$('#exampleModal').modal('show');
			}
		}
	})
</script>
</body>

</html>


