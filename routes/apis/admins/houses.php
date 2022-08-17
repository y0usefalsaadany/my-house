<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HouseController;

Route::prefix('admin')->controller(HouseController::class)->group(function (){
    Route::post('/addHouse','store');
    Route::get('/showHouse','showAll');
    Route::get('/showHouse/{id}','show');
    Route::put('/updateHouse/{id}','update');
    Route::delete('/deleteHouse/{id}','destroy');
});
