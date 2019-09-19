<?php

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


$router->group([
        'prefix' => 'api/v1',
    ], function ($router) {

    $router->post('/login', 'API\v1\LoginController@login');


    $router->group([
        'middleware' => 'jwt.auth'
    ], function ($router) {

        // WIDGET ENTITY
        $router->group([
            'prefix' => 'widgets'
        ], function ($router) {
        
            $router->get('/', 'API\v1\WidgetController@index');
            $router->post('/store', 'API\v1\WidgetController@store');
            $router->post('/{id}/update', 'API\v1\WidgetController@update');
        
        });

    }); // END MIDDLEWARE JWT.AUTH
    

});


$router->get('/{route:.*}/', function ()  {
    return view('app');
});