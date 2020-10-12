<?php

// Admin Routes
Route::group(['middleware' => ['web']], function () {
    Route::prefix(config('app.admin_url'))->group(function () {
        // Admin Routes
        Route::group(['namespace' => 'GGPHP\Shipping\Http\Controllers\Admin', 'middleware' => ['admin']], function () {
            // Sales Routes
            Route::prefix('sales')->group(function () {
                // Tracking Routes
                Route::get('tracking/{id}', 'TrackingController@view')->defaults('_config', [
                    'view' => 'ggphp-shipping::tracking.view',
                ]);
            });
        });
    });
});

// API Routes
Route::group(['prefix' => 'api'], function ($router) {
    Route::group(['namespace' => 'GGPHP\Shipping\Http\Controllers\API',
        'middleware' => ['locale', 'theme', 'currency']], function ($router)
    {
        Route::get('tracking/{id}', 'TrackingController@get')->defaults('_config', [
            'authorization_required' => true
        ]);
    });
});
