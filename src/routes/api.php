<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('event', 'EventController');

Route::resource(
	'bounce', 
	'BounceController',
	['only' => ['store']]
);

Route::resource(
	'click', 
	'ClickController',
	['only' => ['store']]
);

Route::resource(
	'deferred', 
	'DeferredController',
	['only' => ['store']]
);

Route::resource(
	'delivered', 
	'DeliveredController',
	['only' => ['store']]
);

Route::resource(
	'dropped', 
	'DroppedController',
	['only' => ['store']]
);

Route::resource(
	'open', 
	'OpenController',
	['only' => ['store']]
);

Route::resource(
	'processed', 
	'ProcessedController',
	['only' => ['store']]
);

Route::resource(
	'spamreport', 
	'ProcessedController',
	['only' => ['store']]
);

Route::resource(
	'unsubscribe', 
	'UnsubscribeController',
	['only' => ['store']]
);
