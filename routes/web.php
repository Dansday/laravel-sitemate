<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssueController;

Route::get('/', function () {
    return view('api-client');
});

Route::post('api/issues', [IssueController::class, 'create']);
Route::get('api/issues/{id}', [IssueController::class, 'read']);
Route::put('api/issues/{id}', [IssueController::class, 'update']);
Route::delete('api/issues/{id}', [IssueController::class, 'delete']);
