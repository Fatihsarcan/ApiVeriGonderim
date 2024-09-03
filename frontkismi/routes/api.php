<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//Route::post('/upload-pdff', [PdfController::class, 'uploadPdf']);
Route::post('/send',[PdfController::class, 'sendPdf'] );

