<?php
/**
 * Created by NiNaCoder.
 * Date: 2019-08-01
 * Time: 20:33
 */
Route::get('discover', 'DiscoverController@index')->name('discover');
Route::get('customer', 'DiscoverController@customer')->name('customer');
Route::get('/test', 'DiscoverController@test');
Route::get('/test1',function (){
    return view('test');
});

