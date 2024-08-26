<?php

use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(PokemonController::class)->group(function () {
    Route::get('/pokemons', 'index')->name('pokemons.index');
    Route::get('/pokemons/{name}', 'show')->name('pokemons.show');
    Route::post('/pokemons/search', 'search');
});