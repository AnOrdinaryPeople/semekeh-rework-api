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

    $router->group(['prefix' => 'study-program'], function() use ($router){
        $router->get('/', 'StudyController@table');
        $router->get('edit/{id}', 'StudyController@edit');
        $router->post('update/{id}', 'StudyController@update');
    });

	$router->group(['prefix' => 'media'], function() use ($router){
        $router->group(['prefix' => 'agenda'], function() use ($router){
            $router->get('/', 'AgendaController@table');
            $router->post('create', 'AgendaController@create');
            $router->post('update/{id}', 'AgendaController@update');
            $router->get('edit/{id}', 'AgendaController@edit');
            $router->delete('delete/{id}', 'AgendaController@delete');
            $router->post('img/create/{id}', 'AgendaController@createImg');
            $router->delete('img/delete/{id}', 'AgendaController@deleteImg');
        });

        $router->group(['prefix' => 'prestation'], function() use ($router){
            $router->get('/', 'PrestationController@table');
            $router->post('create', 'PrestationController@create');
            $router->post('update/{id}', 'PrestationController@update');
            $router->delete('delete/{id}', 'PrestationController@delete');
        });

        $router->group(['prefix' => 'gallery'], function() use ($router){
            $router->get('/', 'GalleryController@table');
            $router->post('create', 'GalleryController@create');
            $router->delete('delete/{id}', 'GalleryController@delete');
        });
    });

	$router->group(['prefix' => 'employee'], function() use ($router){
        $router->get('/', 'EmployeeController@table');
        $router->post('create', 'EmployeeController@create');
        $router->post('update/{id}', 'EmployeeController@update');
        $router->delete('delete/{id}', 'EmployeeController@delete');
        $router->post('img/create', 'EmployeeController@createImg');
        $router->delete('img/delete/{id}', 'EmployeeController@deleteImg');
    });

	// $router->group(['prefix' => 'keyword'], function() use ($router){
    //     $router->get('/', 'KeywordController@table');
    //     $router->post('create', 'KeywordController@create');
    //     $router->post('update/{id}', 'KeywordController@update');
    //     $router->delete('delete/{id}', 'KeywordController@delete');
    // });

    // $router->group(['prefix' => 'meta'], function() use ($router){
    //     $router->get('/', 'MetaController@table');
    //     $router->post('create', 'MetaController@create');
    //     $router->post('update/{id}', 'MetaController@update');
    //     $router->delete('delete/{id}', 'MetaController@delete');
    // });

    $router->group(['prefix' => 'user'], function() use ($router){
        $router->get('/', 'UserController@table');
        $router->post('create', 'UserController@create');
        $router->post('update/{id}', 'UserController@update');
        $router->post('ban/{id}', 'UserController@ban');
    });

    $router->group(['prefix' => 'role'], function() use ($router){
        $router->get('/', 'RoleController@table');
        $router->get('create', 'RoleController@create');
        $router->get('edit/{id}', 'RoleController@edit');
        $router->post('store', 'RoleController@store');
        $router->post('update/{id}', 'RoleController@update');
        $router->delete('delete/{id}', 'RoleController@delete');
    });

    $router->get('audit', 'HomepageController@audit');
});
