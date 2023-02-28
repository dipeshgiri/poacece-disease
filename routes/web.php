<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});


Route::get('/gallery', function () {
    return view('gallery');
});


Route::get('/about', function () {
    return view('about');
});


Route::get('/index', function () {
    return view('index');
});


Route::get('/nutrient', function () {
    return view('nutrient');
});



Route::post('/uploadfile', 'App\Http\Controllers\uploadfile@uploaddisease');

Route::post('/uploadfilenutrient','App\Http\Controllers\uploadfile@uploadnutrient');

