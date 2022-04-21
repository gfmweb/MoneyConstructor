<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>ЦУП</title>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="css/mdb.min.css" rel="stylesheet">
	<!-- Your custom styles (optional) -->
	<style>
		html,
		body,
		header,
		.view {
			height: 100%;
		}
		@media (min-width: 560px) and (max-width: 740px) {
			html,
			body,
			header,
			.view {
				height: 650px;
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
	</style>
</head>

<body class="login-page">

<!-- Main Navigation -->
<header>
	
	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar">
		<div class="container">
			<a class="navbar-brand" href="#"><strong>ЦУП</strong></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7"
			        aria-controls="navbarSupportedContent-7" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent-7">
			
			</div>
		</div>
	</nav>
	<!-- Navbar -->
	
	<!-- Intro Section -->
	<section class="view intro-2">
		<div class="mask rgba-stylish-strong h-100 d-flex justify-content-center align-items-center">
			<div class="container">
				<div class="row">
					<div class="col-xl-5 col-lg-6 col-md-10 col-sm-12 mx-auto mt-5">
						
						<!-- Form with header -->
						<div class="card wow fadeIn" data-wow-delay="0.3s">
							<div class="card-body">
								<!-- Header -->
								<div class="form-header purple-gradient">
									<h3 class="font-weight-500 my-2 py-1"><i class="fas fa-user"></i> Вход:</h3>
								</div>
								<!-- Body -->
								<form method="post" action="/login">
									<div class="md-form">
										<i class="fas fa-user prefix white-text"></i>
										<input type="text" name="login" id="orangeForm-name" class="form-control">
										<label for="orangeForm-name">Логин</label>
									</div>
									<div class="md-form">
										<i class="fas fa-lock prefix white-text"></i>
										<input type="password" name="password" id="orangeForm-pass" class="form-control">
										<label for="orangeForm-pass">Пароль</label>
									</div>
									
									<div class="text-center">
										<button type="submit" class="btn purple-gradient btn-lg">Войти</button>
									</div>
								</form>
							</div>
						</div>
						<!-- Form with header -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Intro Section -->

</header>
<!-- Main Navigation -->

<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.js"></script>

<!-- Custom scripts -->
<script>

	new WOW().init();

</script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
	const config = {
		headers: { Authorization: `Bearer $2y$10$gZWFxnybUrbKiuyTU71zIO5f3EehZ5Sh9ExrriVnadf7my7ATiWMy` }
	};
	const bodyParameters = {
		key: "value"
	};
	axios.post(
			'/logout',
			bodyParameters,
			config
	).then(console.log).catch(console.log);
</script>


</body>

</html>

