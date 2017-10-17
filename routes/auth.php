<?php

//create a post
Route::get('posts/create',[
    'uses' => 'CreatePostController@create',
    'as'    => 'posts.create',
]);

Route::post('posts/store', [
    'uses'  => 'CreatePostController@store',
    'as'    => 'posts.store',
]);

//comments
Route::post('posts/{post}/comment', [
    'uses'  => 'CommentController@store',
    'as'    => 'comments.store',
]);


