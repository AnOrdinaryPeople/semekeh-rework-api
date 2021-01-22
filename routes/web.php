<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('meta', 'WelcomeController@meta');
$router->get('navbar', 'WelcomeController@navbar');
$router->get('footer', 'WelcomeController@footer');
$router->get('welcome', 'WelcomeController@home');
$router->get('keyword', 'WelcomeController@keyword');
$router->get('social', 'WelcomeController@social');
$router->get('profile/{id}', 'WelcomeController@profile');
$router->get('study/{id}', 'WelcomeController@study');
$router->get('agenda', 'WelcomeController@agenda');
$router->get('agenda/{id}', 'WelcomeController@agendaDetail');
$router->get('prestation', 'WelcomeController@prestation');
$router->get('gallery', 'WelcomeController@gallery');
$router->get('employee', 'WelcomeController@employee');
$router->get('search', 'WelcomeController@search');
