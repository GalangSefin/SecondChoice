<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JualController extends Controller
{
    public function index()
    {
        return view('jual.jual');  // Pastikan ada view jual.blade.php
    }
}
