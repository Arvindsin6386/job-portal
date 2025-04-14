<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // THIS METHOD  WILL SHOWS OUR HOMEPAGES
    public function index(){
        return view('front.home');

    }
}
