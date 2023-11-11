<?php
/**
 * Created by NiNaCoder.
 * Date: 2019-08-01
 * Time: 20:37
 */
Route::get('/', 'HomeController@index')->name('homepage');
//Route::get('/', 'HomeController@index');


Route::get('/sign-in', 'HomeController@index')->name('sign-in');
Route::get('/sign-up', 'HomeController@index')->name('sign-up');

Route::get('/adduser', 'ManagerUserController@adduser')->name('adduser');

Route::post('/addmanager{id}', 'ManagerUserController@addmanager')->name('addmanager');


