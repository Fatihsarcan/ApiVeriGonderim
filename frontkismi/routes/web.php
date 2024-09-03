<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Yonlendir;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/tamamlandi', function () {
    return view('welcome');
});
Route::get('/bla',[Yonlendir::class, 'store'] )->name("tamamlandi");