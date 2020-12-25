<?php

Route::get('/pictures_form', 'PicturesController@form')->name('form');

Route::post('/pictures_save', 'PicturesController@save')->name('save');

Route::get('/images_show/{pict_id}', 'PicturesController@image')->name('image');

Route::get('/image_slice/{pict_id}/{slice_id}', 'PicturesController@slice')->name('slice');

Route::any('/slice_list_by_picture_id/{pict_id}/', 'PicturesController@slice_list')->name('slice_list');

Route::any('/download_slice/{slice_id}/', 'PicturesController@download_slice')->name('download_slice');