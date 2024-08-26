<!DOCTYPE html>
<html>
<head>
    <title>Pokemon</title>
</head>
<body>
    <h1>{{ $pokemon['name'] }}</h1>
    <img src="{{ $pokemon['sprites']['front_default'] }}" alt="{{ $pokemon['name'] }}">
    <ul>
        <li>Height: {{ $pokemon['height'] }}</li>
        <li>Weight: {{ $pokemon['weight'] }}</li>
        <li>Species: {{ $pokemon['species']['name'] }}</li>
        <li>Base Experience: {{ $pokemon['base_experience'] }}</li>
        <li>Abilities:
            <ul>
                @foreach ($pokemon['abilities'] as $ability)
                    <li>{{ $ability['ability']['name'] }}</li>
                @endforeach
            </ul>
        </li>
    </ul>
    <a href="{{ route('pokemons.index') }}">Back</a>
</body>
</html>