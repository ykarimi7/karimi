<?php
/**
 * Created by NiNaCoder.
 * Date: 2019-08-01
 * Time: 20:33
 */
Route::get('discover', 'DiscoverController@index')->name('discover');
//Route::get('customer', 'DiscoverController@customer')->name('customer');
Route::post('/newaddnewuser','ManagerUserController@newaddnewuser');
Route::post('newedituser{id}','ManagerUserController@newedituser')->name('newedituser');
Route::post('newedituser','ManagerUserController@newedituser')->name('newedituser');
Route::post('/newsearch','TrendingController@newsearch');



Route::get('/del{id}','ManagerUserController@del');
