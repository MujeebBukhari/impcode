<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProController extends Controller
{
    public function index()
    {
      return view('product');
    }
}
