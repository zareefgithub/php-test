<?php

namespace App\Http\Controllers;

use Http;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    /**
     * Further enhancement can be done by putting the API URL in a config file.
     * Also, we can use a service class to handle the API calls.
     */
    public function index()
    {
        $pokemons = Http::get('https://pokeapi.co/api/v2/pokemon')->json();
        $pokemons = $pokemons['results'];

        return view('pokemons.index', ['pokemons' => $pokemons]);
    }

    public function show($name)
    {
        $pokemon = Http::get('https://pokeapi.co/api/v2/pokemon/' . $name)->json();

        return view('pokemons.show', ['pokemon' => $pokemon]);
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $pokemons = Http::get('https://pokeapi.co/api/v2/pokemon')->json();
        $pokemons = $pokemons['results'];
        
        $pokemons = array_filter($pokemons, function ($pokemon) use ($search) {
            return strpos($pokemon['name'], $search) !== false;
        });

        return array_values($pokemons);
    }
}
