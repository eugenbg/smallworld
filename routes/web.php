<?php

use Illuminate\Support\Facades\Route;
use App\Models\Race;
use App\Models\Ability;
use App\Models\Artifact;

Route::get('/', function () {
    return view('app');
});

Route::get('/api/races', function () {
    return Race::with('edition')->get();
});

Route::get('/api/abilities', function () {
    return Ability::with('edition')->get();
});

Route::get('/api/artifacts', function () {
    return Artifact::with('edition')->get();
});
