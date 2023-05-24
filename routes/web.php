<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\WebsiteImagesController;
use App\Http\Controllers\WebsiteTextsController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\WebsiteAccessController;
use App\Http\Controllers\MessageCommentController;


Route::post('/login', [LoginController::class, 'login']);

Route::get('/', [MainController::class, 'home']);

Route::group(['middleware' => ['auth:services','jwt']], function(){
    Route::get('/messages', [MessagesController::class, 'all']);
    Route::get('/messages/{id}', [MessagesController::class, 'get']);
    Route::get('/messages/{id}/viewed', [MessagesController::class, 'view']);
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


    Route::post('/messages/comment/create', [MessageCommentController::class, 'create']);
    Route::post('/messages/comment/{id}/update', [MessageCommentController::class, 'update']);
    Route::get('/messages/comment/{id}/delete', [MessageCommentController::class, 'delete']);

    Route::get('/website-access', [WebsiteAccessController::class, 'all']);
});

Route::post('/{api_key}/email/send', [EmailController::class, 'send']);

Route::get('/{api_key}/website-images/', [ApiController::class, 'images']);
Route::get('/{api_key}/website-texts/', [ApiController::class, 'texts']);
Route::post('/{api_key}/website-access', [ApiController::class, 'access']);
Route::post('/website-access-event', [ApiController::class, 'access_event']);


Route::get('/images/{client_id}/{filename}', [ApiController::class, 'getImage']);
