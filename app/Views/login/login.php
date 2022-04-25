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
<header id="App">
	
	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar">
		<div class="container">
			<a class="navbar-brand" href="#"><strong>ЦУП</strong></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7"
			        aria-controls="navbarSupportedContent-7" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent-7">
			<ul class="nav mr-auto" v-if="user_token!==null && refresh_token!==null" >
				<li class="nav-item" v-on:click="logout" >
					Выйти
				</li>
				
				<li v-on:click="getAllowedMethods()"> Доступные методы</li>
			</ul>
			</div>
		</div>
	</nav>
	<!-- Navbar -->
	
	<!-- Intro Section -->
	<section class="view intro-2" >
		<div class="mask rgba-stylish-strong h-100 d-flex justify-content-center align-items-center">
			<div class="container">
				<div class="row">
					<template v-if="user_token==null && refresh_token==null">
					<div class="col-xl-5 col-lg-6 col-md-10 col-sm-12 mx-auto mt-5">
						
						<!-- Form with header -->
						<div class="card wow fadeIn" data-wow-delay="0.3s">
							<div class="card-body">
								<!-- Header -->
								<div class="form-header purple-gradient">
									<h3 class="font-weight-500 my-2 py-1"><i class="fas fa-user"></i> Вход:</h3>
								</div>
								<!-- Body -->
								<form method="post" action="/login" v-on:submit.prevent="autorize">
									<div class="md-form">
										<i class="fas fa-user prefix white-text"></i>
										<input type="text" name="login" v-model="login" id="orangeForm-name" class="form-control">
										<label for="orangeForm-name">Логин</label>
									</div>
									<div class="md-form">
										<i class="fas fa-lock prefix white-text"></i>
										<input type="password" name="password" v-model="password" id="orangeForm-pass" class="form-control">
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
					</template>
					<template v-else>
						<div class="col-xl-5 col-lg-8 col-md-10 col-sm-12 mx-auto mt-5" v-if="allowed.length > 0">
							<div class="card">
								<div class="container">
									<div class="row mt-4 mb-4 justify-content-between" >
										<div class="col-lg-5" v-for="method in allowed">
											<button class="btn btn-success btn-sm btn-rounded" v-on:click="openModal(method.source_id,method.source_name)">{{method.source_name}}</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<!-- Modal -->
						<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">{{active_name}}</h5>
										<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">Х</button>
									</div>
									<div class="modal-body">
										<div class="container">
											<div class="row mt-3 mb-3 justify-content-between">
												<div class="col-lg-6">
													<label>Телефон</label>
													<input type="text" class="form-control" v-model="client_tel"/>
												</div>
												<div class="col-lg-6">
													<label>Правила</label>
													<input type="text" class="form-control" v-model="active_rulles"/>
												</div>
											</div>
											<label>Сообщение</label>
											<textarea class="form-control" v-model="client_text"></textarea>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
										<button type="button" class="btn btn-primary" v-on:click="sendRequest()">Отправить</button>
									</div>
								</div>
							</div>
						</div>
					</template>
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
	const App = new Vue({
		el:'#App',
		data:{
			user_token:null,
			refresh_token:null,
			login:null,
			password:null,
			allowed:{},
			client_tel:null,
			client_text:null,
			active_method:null,
			active_name:null,
			active_rulles:null
		},
		methods:{
			autorize(){
				const self = this
				axios.post('/login',{login:this.login,password:this.password}).then(res=>{
					if(res.data.response.token){
						self.user_token = res.data.response.token
						self.refresh_token = res.data.response.refresh_token
						self.password = null
						localStorage.setItem('Authorize', JSON.stringify({token:self.user_token,refresh_token:self.refresh_token}))
					}
				})
			},
			makeRequest(uri, fields, step){
				const self = this
				const config = {
					headers: { Authorization: `Bearer `+this.user_token }
				};
				const bodyParameters = fields
				  axios.post(
						'/'+uri,
						bodyParameters,
						config
				).then(res=>{
					return res.data
				}).
				catch(res=>{
						if(step == 1){
						self.refreshMytoken().then(res=> {
							step = 2
							console.log('Повторить запрос')
							self.makeRequest(uri, fields, step)
						})}}
						
				);
				
			},
			refreshMytoken(){
				const self = this
				axios.post ('/refresh',{refresh:self.refresh_token}).then(res=>{
					self.user_token = res.data.response.token
					self.refresh_token = res.data.response.refresh_token
					localStorage.setItem('Authorize', JSON.stringify({token:self.user_token,refresh_token:self.refresh_token}))
				}).catch(res=> {
							self.refresh_token = null
							self.user_token = null
						}
				)
			},
			logout(){
				localStorage.clear()
				this.user_token = null
				this.refresh_token = null
				
			},
			getAllowedMethods(){
				const self = this
				const config = {
					headers: { Authorization: `Bearer `+this.user_token }
				};
				const bodyParameters = {}
				axios.post(
						'/methods',
						bodyParameters,
						config
				).then(res=>{
					self.allowed = res.data.response
					
				}).
				catch(res=>{
					self.refreshMytoken()
						}
				);
			},
			openModal(id,name){
				this.active_method = id
				this.active_name = name
				$('#exampleModal').modal('show')
			},
			sendRequest(){
				const config = {
					headers: { Authorization: `Bearer `+this.user_token }
				};
				const bodyParameters = {method:this.active_name,phone:this.client_tel,text:this.client_text,params:JSON.stringify(this.active_rulles)}
				axios.post(
						'/run',
						bodyParameters,
						config
				).then(res=>{
					console.log(res.data)
				})
			}
		},
		
		
		
		mounted(){
			let Authorize =  localStorage.getItem('Authorize')
			if(Authorize!==null) {
				Authorize = JSON.parse(Authorize)
				this.user_token = Authorize.token
				this.refresh_token = Authorize.refresh_token
			}
		}
	})
</script>

<script>

</script>


</body>

</html>

