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

//votes

Route::post('posts/{post}-{slug}/upvote', [
    'uses'  => 'VotePostController@upvote',
])->where('post', '\d+');

Route::post('posts/{post}-{slug}/downvote', [
    'uses'  => 'VotePostController@downvote',
])->where('post', '\d+');

Route::delete('posts/{post}-{slug}/vote', [
    'uses'  => 'VotePostController@undoVote',
])->where('post', '\d+');

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

Route::get('mis-posts/{category?}', [
    'uses' => 'ListPostController',
    'as'    => 'posts.mine'
]);


