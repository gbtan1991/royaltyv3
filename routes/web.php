<?php


Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/login', function() {
    return view('auth.login');
});