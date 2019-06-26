<?php

namespace App\Http\Controllers\Web;

use App\Models\Species;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SpeciesResource;

class SpeciesController extends Controller
{
    public function __invoke ()
    {
        return view('species.index', [
            'species' => SpeciesResource::collection(Species::orderBy('display_name')->get())
        ]);
    }
}
