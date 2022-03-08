<?php
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;

Route::get('/',[HomeController::class,"getHome"]);

Route::get('catalog',[CatalogController::class,"getIndex"])
->middleware(['auth']);

Route::get('catalog/show/{id}', [CatalogController::class, "getShow"])
->whereNumber("id")->middleware(["auth"]);

Route::get('catalog/create',[CatalogController::class,"getCreate"])
->middleware(['auth']);

Route::get('catalog/edit/{id}', [CatalogController::class, "getEdit"])
->whereNumber("id")->middleware(["auth"]);


Route::put("catalog/edit/{id}", [CatalogController::class, "putEdit"])->middleware(['auth']);

Route::get("login",[AuthenticatedSessionController::class,'create']); // controlador y método

Route::get("signup",[RegisteredUserController::class,'create']); // controlador y método
//
Route::post("catalog/create", [CatalogController::class, "postCreate"])->middleware(['auth']);                   //solo accesible cuando el usuario está auth

require __DIR__.'/auth.php';
