<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::resource('users','User\UserController',['except' => ['create','edit']]);
Route::resource('countries','Country\CountryController',['except' => ['create','edit']]);
Route::resource('companies','Company\CompanyController',['except' => ['create','edit']]);
Route::resource('branches','Branch\BranchController',['except' => ['create','edit']]);
Route::resource('roles','Role\RoleController',['except' => ['create','edit']]);
Route::resource('functions','Functionality\FunctionalityController',['except' => ['create','edit']]);
Route::resource('routes','Route\RouteController',['except' => ['create','edit']]);
