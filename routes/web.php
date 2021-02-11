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

$router->get('/', function(){
	return response(['link' => 'https://bit.ly/314jniD']);
});

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

$router->group(['prefix' => 'api/auth'], function() use ($router){
    $router->post('login', 'AuthController@login');
    $router->post('logout', 'AuthController@logout');
    $router->post('refresh', 'AuthController@refresh');
	$router->post('update', 'AuthController@update');
    $router->get('user', 'AuthController@me');
});

$router->group(['prefix' => 'admin', 'middleware' => ['auth']], function() use ($router){
	$router->post('{path}/upload', 'HomepageController@upload');

    $router->group(['prefix' => 'homepage'], function() use ($router){
    	$router->get('/', 'HomepageController@index');
    	$router->post('/foundation/{id}', 'KeywordController@update');

    	$router->group(['prefix' => 'carousel'], function() use ($router){
    		$router->get('/', 'CarouselController@table');
    		$router->post('create', 'CarouselController@create');
    		$router->post('update/{id}', 'CarouselController@update');
    		$router->delete('delete/{id}', 'CarouselController@delete');
    	});

    	$router->group(['prefix' => 'video'], function() use ($router){
    		$router->get('/', 'VideoController@table');
    		$router->post('create', 'VideoController@create');
    		$router->post('update/{id}', 'VideoController@update');
    		$router->post('publish/{id}', 'VideoController@publish');
    		$router->delete('delete/{id}', 'VideoController@delete');
    	});

		$router->post('about/update', 'HomepageController@aboutUpdate');

		$router->group(['prefix' => 'alumni'], function() use ($router){
    		$router->get('/', 'AlumniController@table');
    		$router->post('create', 'AlumniController@create');
    		$router->post('update/{id}', 'AlumniController@update');
    		$router->post('publish/{id}', 'AlumniController@publish');
    		$router->delete('delete/{id}', 'AlumniController@delete');
    	});

    	$router->group(['prefix' => 'company'], function() use ($router){
    		$router->get('/', 'CompanyController@table');
    		$router->post('create', 'CompanyController@create');
    		$router->post('update/{id}', 'CompanyController@update');
    		$router->delete('delete/{id}', 'CompanyController@delete');
    	});

    	$router->group(['prefix' => 'social'], function() use ($router){
    		$router->get('/', 'SocialController@table');
    		$router->post('create', 'SocialController@create');
    		$router->post('update/{id}', 'SocialController@update');
    		$router->delete('delete/{id}', 'SocialController@delete');
    	});

    	$router->group(['prefix' => 'footer'], function() use ($router){
    		$router->get('/', 'FooterController@table');
    		$router->post('create', 'FooterController@create');
    		$router->post('update/{id}', 'FooterController@update');
    		$router->delete('delete/{id}', 'FooterController@delete');
    	});

    	$router->group(['prefix' => 'section'], function() use ($router){
    		$router->get('/', 'SectionController@table');
    		$router->post('update/{id}', 'SectionController@update');
    	});
    });

    $router->group(['prefix' => 'profile'], function() use ($router){
        $router->get('{id}', 'ProfileController@getData');
        $router->get('council/get', 'ProfileController@council');
        $router->post('council/update', 'ProfileController@updateCouncil');
        $router->post('update/{id}', 'ProfileController@update');
        $router->post('img/create/{id}', 'ProfileController@createImg');
        $router->delete('img/delete/{id}', 'ProfileController@deleteImg');
    });
});
