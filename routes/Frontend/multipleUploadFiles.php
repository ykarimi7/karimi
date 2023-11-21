<?php

use Illuminate\Support\Facades\Route;

Route::get('multiple-uploads/index', 'UploadMultipleFilesController@index')->name('files.multiple.uploads.view');
Route::get('multiple-uploads/create', 'UploadMultipleFilesController@multipleUploadsCreate')->name('files.multiple.uploads.create');
Route::post('multiple-uploads/store', 'UploadMultipleFilesController@multipleUploads')->name('files.multiple.uploads.store');
