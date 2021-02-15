<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class WelcomeController extends Controller
{
    public function register($id)
    {
       

        return view('login');
    }

    public function login($id)
    {
       
        return view('register');
    }
}