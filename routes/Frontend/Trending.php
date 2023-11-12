<?php
/**
 * Created by NiNaCoder.
 * Date: 2019-08-01
 * Time: 20:33
 */
Route::get('trending/week', 'TrendingController@index')->name('trending.week');
Route::get('trending/month', 'TrendingController@index')->name('trending.month');
//new development
Route::get('trending', 'TrendingController@customer')->name('trending');
Route::get('newaddnewuser', 'TrendingController@newaddnewuser')->name('newaddnewuser');
