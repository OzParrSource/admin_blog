<?php

Route::group(['prefix' => 'admin', 'middleware'=>['web','auth'] ], function() {

    Route::resource('blog', 'Ozparr\AdminBlog\Controllers\BlogController');

    Route::get('blog/{id}/destroy', [
        'uses' => 'Ozparr\AdminBlog\Controllers\BlogController@destroy',
        'as' => 'blog.destroy'
    ]);
    Route::post('blog/imgUpload', [
        'uses' => 'Ozparr\AdminBlog\Controllers\BlogController@imgUpload',
        'as' => 'blog.imgUpload'
    ]);

    Route::get('blog/detach/tags', [
        'uses' => 'Ozparr\AdminBlog\Controllers\BlogController@detachTagas',
        'as' => 'blog.detachTagas'
    ]);

});