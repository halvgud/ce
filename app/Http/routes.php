<?php

$app->group(['middleware' => 'auth','namespace' => 'App\Http\Controllers'], function() use ($app) {
	$app->get('menuItems/', ['uses' => 'MenuItemsController@getitems', ]);

	$app->get('descriptions/{type}', ['uses' => 'MenuItemsController@getDescriptions', ]);

	$app->group(['prefix' => 'stores','namespace' => 'App\Http\Controllers'], function() use ($app) {
		$app->post('/', ['uses' => 'StoresController@postStores', ]);
		$app->get('/{search}', ['uses' => 'StoresController@getStores', ]);
	});
});

$app->post('login/', ['uses' => 'LoginController@login', ]);