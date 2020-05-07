<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
        hola controller
        hola como esta
        Rama juantio
        Hola
     */
    public function index()
    {
        return view('home');
    }
}
