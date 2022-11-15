<?php
require_once './libs/Router.php';
require_once './app/controllers/movie-api.controller.php';
require_once './app/controllers/gender-api.controller.php';
require_once './app/controllers/auth-api.controller.php';
require_once './app/controllers/review-api.controller.php';

$router = new Router();

//MOVIES
$router->addRoute('movies', 'GET','MovieApiController','getAll');
$router->addRoute('movies/:ID','GET','MovieApiController','get');
$router->addRoute('movies','POST','MovieApiController','insert');
$router->addRoute('movies/:ID','PUT','MovieApiController','edit');
$router->addRoute('movies/:ID','DELETE','MovieApiController','delete');

//TOKEN
$router->addRoute("auth/token", 'GET', 'AuthApiController', 'getToken');

//GENDERS
$router->addRoute('genders','GET','GenderApiController','getAll');
$router->addRoute('genders/:ID','GET','GenderApiController','get');
$router->addRoute('genders','POST','GenderApiController','insert');
$router->addRoute('genders/:ID','PUT','GenderApiController','edit');
$router->addRoute('genders/:ID','DELETE','GenderApiController','delete');

//REVIEWS
$router->addRoute('reviews','GET','ReviewApiController','getAll');
$router->addRoute('reviews/:ID','GET','ReviewApiController','get');
$router->addRoute('reviews','POST','ReviewApiController','insert');
$router->addRoute('reviews/:ID','PUT','ReviewApiController','edit');
$router->addRoute('reviews/:ID','DELETE','ReviewApiController','delete');

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);