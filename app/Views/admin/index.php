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
						<div class="card wow fadeIn" data-wow-delay="0.3s" v-on:click="openModal('users')">
							<div class="card-body">
								<h3 class="h3 text-center">Пользователи</h3>
								
							</div>
						</div>
					</div>
					
					<div class="col-xl-5 col-lg-6 col-md-10 col-sm-12 mx-auto mt-lg-5 pointer">
						<div class="card wow fadeIn" data-wow-delay="0.3s">
							<div class="card-body">
								<h3 class="h3 text-center" v-on:click="openModal('chanels')">Каналы связи</h3>
							
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
					<h5 class="modal-title" id="exampleModalLabel">{{ModalName}}</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">Х</button>
				</div>
				<div class="modal-body">
					<!-- Список пользователей -->
					<template v-if="currentPosition=='listUsers'">
						<div class="container">
						<div class="row justify-content-center">
							<div class="col-6"><button class="btn btn-rounded btn-sm btn-outline-deep-purple" v-on:click="action(CreateBTNaction,'new','new')" v-text="CreateBTNtxt"></button></div>
						</div>
						<div class="row mt-4 mb-4 shadow-sm" v-for="(item, index) in activeDATA">
							<div class="col-4">
							<h3 class="h3">	{{item.user_login}}</h3>
							</div>
							<div class="col-8">
								<div class="row justify-content-around mt-2">
								<i class="fas fa-lock pointer" title="Сменить пароль" v-on:click="action('setPass',index,item.user_id)"></i>
								<i class="fas fa-backspace pointer" title="Удалить пользователя" v-on:click="action('delUser',index,item.user_id)"></i>
								</div>
							</div>
						</div>
					</div>
					</template>
					<!-- /Список пользователей -->
					
					<!-- Смена пароля пользователя -->
					<template v-if="currentPosition == 'user'">
						<div class="container">
							<div class="row justify-content-between">
								<div class="col-8">
									<input type="text" class="form-control" v-model="newValue" placeholder="Новый пароль"/>
								</div>
								<div class="col-4">
									<button class="btn btn-rounded btn-outline-success btn-sm" v-on:click="action('updatePass','any',targetItem.item_id)">Установить</button>
								</div>
							</div>
						</div>
					</template>
					<!-- /Смена пароля пользователя -->
					
					<!--Создание пользователя  -->
					<template v-if="currentPosition == 'createUser'">
						<div class="container">
							<div class="row justify-content-around">
							<div class="col-6">
								<input type="text" class="form-control" v-model="newValue" placeholder="Новый логин"/>
							</div>
							<div class="col-4">
								<button class="btn btn-sm btn-rounded" v-on:click="action('addUser','new','new')">Зарегистрировать</button>
							</div>
							</div>
						</div>
					</template>
					<!--/Создание пользователя -->
					<!-- Каналы -->
					<template v-if="currentPosition=='listChanels'"	>
						<div class="container">
							<div class="row justify-content-center">
								<div class="col-6"><button class="btn btn-rounded btn-sm btn-outline-dark" v-on:click="action(CreateBTNaction,'new','new')" v-text="CreateBTNtxt"></button></div>
							</div>
							<div class="row mt-4 mb-4 shadow-sm" v-for="(item, index) in activeDATA">
								<div class="col-4">
									<h5 class="h3">	{{item.source_name}}</h5>
								</div>
								<div class="col-8">
									<div class="row justify-content-around mt-2">
										<i class="fa fa-pen pointer" title="Редактировать" v-on:click="action('editData',index,item.user_id)"></i>
										<i class="fas fa-backspace pointer" title="Удалить канал" v-on:click="action('delData',index,item.user_id)"></i>
									</div>
								</div>
							</div>
						</div>
					</template>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-rounded" data-dismiss="modal">Закрыть</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
	const app = new Vue({
		el:'#App',
		data:{
			ModalName:null,
			CreateBTNtxt:null,
			CreateBTNaction:null,
			activeDATA:[],
			currentPosition:'listUsers',
			targetItem:{},
			newValue:null
		},
		methods:{
			openModal(mode){
				const self = this
				if(mode=='users'){
					
					this.ModalName = 'Пользователи'
					this.CreateBTNtxt = 'Создать пользователя'
					this.CreateBTNaction = 'createUser'
					this.currentPosition = 'listUsers'
					axios.get('/api/getUsers').then(res=>{
						self.activeDATA = res.data
					}
					)
				}
				if(mode=='chanels'){
					
					this.ModalName = 'Каналы'
					this.CreateBTNtxt = 'Создать канал'
					this.CreateBTNaction = 'createChanel'
					this.currentPosition = 'listChanels'
					axios.get('/api/getChanels').then(res=>{
								self.activeDATA = res.data
							}
					)
				}
				$('#exampleModal').modal('show');
			},
			action (actName, index,itemID)
			{
				if(actName=='setPass'){
					this.newValue = null
					this.ModalName =  this.activeDATA[index].user_login
					this.currentPosition = 'user'
					this.targetItem = {'index':index,'item_id':itemID,'item_name':this.ModalName}
				}
				if(actName == 'updatePass'){
					axios.post('/api/updatePass',{user_id:itemID,value:this.newValue}).then(res=>{
						this.newValue = null
						this.ModalName = 'Пользователи'
						this.CreateBTNtxt = 'Создать пользователя'
						this.CreateBTNaction = 'user'
						this.currentPosition = 'listUsers'
					})
				}
				if(actName == 'createUser'){
					this.newValue = null
					this.ModalName =  'Создание пользователя'
					this.currentPosition = 'createUser'
				}
				if(actName == 'addUser'){
					const self = this
					axios.post('api/addUser',{newlogin:this.newValue}).then(res=>{
						self.openModal('users')
					})
				}
				if(actName == 'delUser'){
					const self = this
					let choise = confirm ('Удалить пользователя '+ this.activeDATA[index].user_login + ' ?')
					if(choise){
						axios.post('api/deleteUser',{id:itemID}).then(res=>{
							self.openModal('users')
						})
					}
					
				}
			}
		}
	})
</script>
</body>

</html>


