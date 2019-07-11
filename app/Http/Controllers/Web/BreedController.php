<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class BreedController extends Controller
{
    public function __invoke()
    {
        return view('breeds.index');
    }
}
