<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');


$routes->get('/login','Login/Login::errorRequest',['var'=>1]);
$routes->get('/refresh', 'Login/Login::errorRequest',['var'=>2]);

$routes->post('/login','Login/Login::login');
$routes->post('/logout','Login/Login::logout',['filter'=>'auth']);
$routes->post('/refresh', 'Login/Login::RefreshAuth');
$routes->post('/methods','API/Client::getUserMethods');
$routes->post('/run','API/Client::run');
$routes->post('/report','API/Client::report');
$routes->post('/reportlist','API/Client::reportlist');

$routes->get('/admin','Admin/Index::index',['filter' => 'admin_auth']);
$routes->get('/admin/login','Admin/Index::login');
$routes->post('/admin/Auth','Admin/Index::Auth');
$routes->post('/admin/logout','Admin/Index::logout');

$routes->get('/api/getUsers','API/Admin::getUsers',['filter'=>'admin_auth']);
$routes->post('/api/updatePass','API/Admin::updateUser',['filter'=>'admin_auth']);
$routes->post('/api/addUser','API/Admin::createUser',['filter'=>'admin_auth']);
$routes->post('/api/deleteUser','API/Admin::delUser',['filter'=>'admin_auth']);

$routes->get('/api/getChanels','API/Admin::getChanels',['filter'=>'admin_auth']);
$routes->post('/api/newChanel','API/Admin::newChanel',['filter'=>'admin_auth']);
$routes->get('/api/getChanel','API/Admin::getChanel',['filter'=>'admin_auth']);
$routes->post('/api/editChanel','API/Admin::editChanel',['filter'=>'admin_auth']);
$routes->post('/api/deleteChanel','API/Admin::delChanel',['filter'=>'admin_auth']);

$routes->get('/test','');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
