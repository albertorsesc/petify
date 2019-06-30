<?php

namespace App\Http\Controllers\Api;

use App\Models\Breed;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BreedResource;

class BreedController extends Controller
{
    public function index()
    {
        return BreedResource::collection(Breed::with('specie')->orderBy('name')->get());
    }
}
