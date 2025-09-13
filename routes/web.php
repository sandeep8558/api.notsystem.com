<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientAuthController;
use Illuminate\Support\Facades\Process;
    use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/migrate', function () {
    $result = Process::run('php artisan migrate');
    return $result->output();
});

Route::get('/git/pull', function () {
    $result = Process::run('git pull origin main');
    return $result->output();
});

Route::get('/composer/install', function () {
    $result = Process::run('composer install');
    return $result->output();
});

Route::get('/migrate/fresh', function () {
    $result = Artisan::call('migrate:fresh');
    return $result;
});