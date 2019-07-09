<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class SpeciesController extends Controller
{
    public function __invoke ()
    {
        return view('species.index');
    }
}
