<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
        hola controller
        hola como esta
     */
    public function index()
    {
        return view('home');
    }
}
