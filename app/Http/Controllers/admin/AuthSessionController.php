<?php

namespace App\Http\Controllers\admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthSessionController extends Controller
{
    //

    public function create(): View 
    {
        return view( 'admin.auth.login');
    }
}
