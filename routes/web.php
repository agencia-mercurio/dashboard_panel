<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\WebsiteImagesController;
use App\Http\Controllers\WebsiteTextsController;
use App\Http\Controllers\EmailController;

Route::post('/login', [LoginController::class, 'login']);

Route::group(['middleware' => ['auth:services','jwt']], function(){
    Route::get('/messages', [MessagesController::class, 'all']);
    Route::get('/messages/{id}', [MessagesController::class, 'get']);
    Route::post('/messages/{id}/viewed', [MessagesController::class, 'view']);
    Route::post('/messages/viewed', [MessagesController::class, 'viewMultiple']);
    Route::post('/messages/create', [MessagesController::class, 'create']);
    Route::put('/messages/update', [MessagesController::class, 'update']);
    Route::delete('/messages/delete', [MessagesController::class, 'destroy']);

    Route::get('/website-images', [WebsiteImagesController::class, 'all']);
    Route::get('/website-images/{id}', [WebsiteImagesController::class, 'get']);
    Route::post('/website-images/create', [WebsiteImagesController::class, 'create']);
    Route::post('/website-images/update', [WebsiteImagesController::class, 'update']);

    Route::get('/website-texts', [WebsiteTextsController::class, 'all']);
    Route::get('/website-texts/{key}', [WebsiteTextsController::class, 'get']);
    Route::post('/website-texts/create', [WebsiteTextsController::class, 'create']);
    Route::post('/website-texts/update', [WebsiteTextsController::class, 'update']);

    Route::post('/email/send', [EmailController::class, 'send']);
    
});