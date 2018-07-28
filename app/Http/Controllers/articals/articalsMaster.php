<?php

namespace App\Http\Controllers\articals;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;

class articalsMaster extends Controller
{
    function index() {
        return View::make('articals.index');
    }
}
