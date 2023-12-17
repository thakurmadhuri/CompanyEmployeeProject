<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;

Auth::routes(['register' => false]);
Route::group(['middleware' => ['auth']], function () {
	Route::get('/', function () {
		return view('home');
	});
	Route::resource('/companies', CompanyController::class)->except(['show']);
	Route::resource('/employees', EmployeeController::class)->except(['show']);
});