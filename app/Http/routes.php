<?php

$app->group(['middleware' => 'auth','namespace' => 'App\Http\Controllers'], function() use ($app) {
	$app->get('menuItems/', ['uses' => 'MenuItemsController@getitems', ]);

	//$app->get('descriptions/{type}', ['uses' => 'MenuItemsController@getDescriptions', ]);

	$app->group(['prefix' => 'store','namespace' => 'App\Http\Controllers'], function() use ($app) {
		$app->post('/', ['uses' => 'StoreController@postStore', ]);
		$app->get('/', ['uses' => 'StoreController@getStores', ]);
		$app->get('/{search}', ['uses' => 'StoreController@getStore', ]);
		$app->delete('/{id}', ['uses' => 'StoreController@delete', ]);
	});

	$app->group(['prefix' => 'user','namespace' => 'App\Http\Controllers'], function() use ($app) {
		$app->post('/', ['uses' => 'UserController@postUser', ]);
		$app->post('/edit', ['uses' => 'UserController@editUser', ]);
		$app->get('/', ['uses' => 'UserController@getUsers', ]);
		$app->get('search/{search}', ['uses' => 'UserController@getUserByName', ]);
		$app->get('/{id}', ['uses' => 'UserController@getUserById', ]);
		$app->delete('/{id}', ['uses' => 'UserController@delete', ]);
	});
	$app->group(['prefix' => 'car','namespace' => 'App\Http\Controllers'], function() use ($app) {
		$app->post('/', ['uses' => 'CarController@postCar', ]);
		$app->get('/', ['uses' => 'CarController@getCars', ]);
		$app->get('/{search}', ['uses' => 'CarController@getCar', ]);
		$app->delete('/{id}', ['uses' => 'CarController@delete', ]);
	});

	$app->group(['prefix' => 'customer','namespace' => 'App\Http\Controllers'], function() use ($app) {
		$app->post('/', ['uses' => 'CustomerController@postCustomer', ]);
		$app->get('/', ['uses' => 'CustomerController@getCustomers', ]);
		$app->get('/{search}', ['uses' => 'CustomerController@getCustomer', ]);
		$app->delete('/{id}', ['uses' => 'CustomerController@delete', ]);
	});
	$app->get('description/{type}', ['uses' => 'DescriptionController@get', ]);

});

$app->post('login/', ['uses' => 'LoginController@login', ]);