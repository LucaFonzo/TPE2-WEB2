<?php
require_once './libs/Router.php';
require_once './app/controllers/movie-api.controller.php';
require_once './app/controllers/gender-api.controller.php';

$router = new Router();

$router->addRoute('movies', 'GET','MovieApiController','getMovies');
$router->addRoute('movies/:ID','GET','MovieApiController','getMovie');
$router->addRoute('movies/:ID','DELETE','MovieApiController','deleteMovie');
$router->addRoute('movies','POST','MovieApiController','insertMovie');
$router->addRoute('movies/:ID','PUT','MovieApiController','editMovie');
$router->addRoute('genders','GET','GenderApiController','getGenders');
$router->addRoute('genders/:ID','GET','GenderApiController','getGender');
$router->addRoute('genders','POST','GenderApiController','insertGender');
$router->addRoute('genders/:ID','PUT','GenderApiController','editGender');

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);