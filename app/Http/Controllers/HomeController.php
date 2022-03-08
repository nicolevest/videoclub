<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

class HomeController extends Controller
{
    public function getHome()
    {
        if(Auth::check())
        {
            return redirect()->action([CatalogController::class, 'getIndex']);
        }
        else{
            return redirect()->action([AuthenticatedSessionController::class, 'create']);
        }

    }
}
