<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssueController;

Route::get('/', function () {
    return view('api-client');
});

Route::get('api/issues/', [IssueController::class, 'index']);
Route::post('api/issues/create', [IssueController::class, 'create']);
Route::put('api/issues/update/{id}', [IssueController::class, 'update']);
Route::delete('api/issues/delete/{id}', [IssueController::class, 'delete']);
