<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssueController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/issues', [IssueController::class, 'create']);
Route::get('/issues/{id}', [IssueController::class, 'read']);
Route::put('/issues/{id}', [IssueController::class, 'update']);
Route::delete('/issues/{id}', [IssueController::class, 'delete']);
