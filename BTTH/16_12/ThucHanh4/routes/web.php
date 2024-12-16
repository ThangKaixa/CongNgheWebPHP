<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssuesController;

Route::resource('issues', IssuesController::class);
