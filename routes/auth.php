<?php

//create a post
Route::get('posts/create',[
    'uses'  => 'CreatePostController@create',
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

Route::post('comments/{comment}/accept', [
    'uses' => 'CommentController@accept',
    'as'   => 'comments.accept'
]);

//subscribe method post
Route::post('post/{post}/subscribe', [
    'uses'  => 'SubscriptionController@subscribe',
    'as'    => 'posts.subscribe'
]);
//unsubscribe method post
Route::delete('post/{post}/unsubscribe', [
    'uses'  => 'SubscriptionController@unsubscribe',
    'as'    => 'posts.unsubscribe'
]);


