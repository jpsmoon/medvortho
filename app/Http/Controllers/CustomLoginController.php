<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomLoginController extends Controller
{
    //

    public function showLoginForm(Request $request)
    {
         return view('auth.login');
    }
    public function doLoginForm(Request $request)
    {
        echo "<==>";
        print_r($request->all());exit;
    }
    
}
