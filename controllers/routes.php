<?php
include_once 'config/static.php';
include_once 'controllers/main.php';
include_once 'function/main.php';

# GET
Router::url('/', 'get', function () { return view('home'); });
Router::url('login', 'get', 'AuthController::login');
Router::url('register', 'get', 'AuthController::register');
Router::url('dashboard', 'get', 'DashboardController::index');

# POST
Router::url('login', 'post', 'AuthController::saveLogin');
Router::url('register', 'post', 'AuthController::saveRegister');
Router::url('contacts/add', 'post', 'ContactController::saveAdd');
Router::url('contacts/edit', 'post', 'ContactController::saveEdit');

new Router();