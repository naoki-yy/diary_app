<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class TopPageController extends Controller
{
    public function init(): View
    {
        return view('TopPage');
    }
}
