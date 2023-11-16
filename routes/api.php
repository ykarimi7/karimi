<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\AuthController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'locale'], function() {

    /**
     * Backend Routes
     * Namespaces indicate folder structure
     */

    Route::group(['laroute' => false, 'prefix' => env('APP_ADMIN_PATH', 'admin'), 'namespace' => 'App\Http\Controllers\Backend', 'as' => 'backend.'], function() {
        Route::get('login', ['uses' => 'AdminAuthController@getLogin'])->name('login');
        Route::post('login', ['uses' => 'AdminAuthController@postLogin'])->name('login.post');
        Route::get('logout', ['uses' => 'AdminAuthController@getLogout'])->name('logout');
        Route::get('forgot-password', ['uses' => 'AdminAuthController@forgotPassword'])->name('forgot-password');
        Route::post('forgot-password', ['uses' => 'AdminAuthController@forgotPasswordPost'])->name('forgot-password.post');
        Route::post('reset-password', ['uses' => 'AdminAuthController@resetPasswordPost'])->name('reset-password.post');
        Route::get('reset-password/{token}', ['uses' => 'AdminAuthController@resetPassword'])->name('reset-password');
    });

    Route::group(['laroute' => false, 'middleware' => 'Admin', 'prefix' => env('APP_ADMIN_PATH', 'admin'), 'namespace' => 'App\Http\Controllers\Backend', 'as' => 'backend.'], function() {
        includeAdminModuleRouteFiles();
        includeRouteFiles(__DIR__.'/Backend/');
    });

    /* ----------------------------------------------------------------------- */

    /**
     * Frontend Routes
     * Namespaces indicate folder structure
     */


    /** Check if website is set to offline
     * If website is set to offline then check if user have permission to access the offline website or not
     * If no permission, display offline reason page
     * Set permission by use Usergroup and Roles in admin section
     */


    if(config('settings.site_offline'))
    {
        Route::group(['middleware' => 'auth'], function () {
            includeModuleRouteFiles();
            Route::group(['middleware' => 'role:allow_offline'], function() {
                Route::group(['namespace' => 'App\Http\Controllers\Frontend', 'as' => 'frontend.'], function () {
                    includeRouteFiles(__DIR__.'/Frontend/');
                });
            });
        });
    } else {
        includeModuleRouteFiles();
        Route::group(['namespace' => 'App\Http\Controllers\Frontend', 'as' => 'frontend.'], function () {
            includeRouteFiles(__DIR__.'/Frontend/');
        });
    }

    /**
     * added this routes to read api request from client if request sended to web Controllers
     * SABER
     */
    // Route::post('auth/signup', [AuthController::class , 'signup'])->name('api.auth.signup');
    // Route::post('auth/login', [AuthController::class , 'login'])->name('api.auth.login');



    /**End */

    Auth::routes();


});