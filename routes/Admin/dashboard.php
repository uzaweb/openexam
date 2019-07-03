<?php

Route::group ( [ 
		'prefix' => 'admin',
		'middleware' => 'web' 
], function () {	
    Route::group ( [
            'prefix' => 'openexam',
            'namespace' => 'Uzaweb\Openexam\Http\Controllers\Admin',
            'middleware' => 'admin'
    ], function () {
    		//Get http home,ajax home    		
            Route::get ( '/', [
                    'as' => 'admin.openexam.dashboard.index',
                    'uses' => 'DashboardController@index'
            ] );
            
            //Get http home,ajax home    		
            Route::get ( '/get', [
                    'as' => 'admin.openexam.dashboard.get',
                    'uses' => 'DashboardController@get'
            ] );
            
            //Do Create posts
    		Route::post ( '/store', [
    		        'as' => 'admin.openexam.dashboard.store',
                    'uses' => 'DashboardController@store'
    		] );
    		
    		//Do Edit posts
    		Route::get( '/edit/{itemid}', [
    		    'as' => 'admin.openexam.dashboard.edit',
    		    'uses' => 'DashboardController@edit'
    		] );
    		
    		//Do Update posts
    		Route::post( '/update/{itemid}', [
    		        'as' => 'admin.openexam.dashboard.update',
                    'uses' => 'DashboardController@update'
    		] );
            
            //Do Delete posts
    		Route::post( '/destroy/{itemid}', [
    		        'as' => 'admin.openexam.dashboard.destroy',
                    'uses' => 'DashboardController@destroy'
    		] );    		
    });
    
} );