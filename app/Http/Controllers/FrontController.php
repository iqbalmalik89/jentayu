<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    public function showJobForm()
    {
        return view('front/form');
    }
}
