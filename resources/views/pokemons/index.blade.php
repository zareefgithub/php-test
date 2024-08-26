<!DOCTYPE html>
<html>
<head>
    <title>Pokemons</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Pokemons</h1>
    <input type="text" id="search" placeholder="Type a name">
    <input type="button" id="searchButton" value="Search">
    <ul id="results">
        @foreach ($pokemons as $pokemon)
            <li><a href="{{ route('pokemons.show', ['name' => $pokemon['name']]) }}">{{ $pokemon['name'] }}</a></li>
        @endforeach
    </ul>
</body>
<script>
    document.getElementById('searchButton').addEventListener('click', function() {
        var search = document.getElementById('search').value;

        fetch('/pokemons/search', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ search: search })
        })
        .then(response => response.json())
        .then(data => {
            var resultsDiv = document.getElementById('results');
            resultsDiv.innerHTML = '';

            if (data.length > 0) {
                data.forEach(function(pokemon) {
                    var pokemonLi = document.createElement('li');
                    var pokemonLink = document.createElement('a');
                    
                    pokemonLink.textContent = pokemon.name;
                    pokemonLink.href = '/pokemons/' + encodeURIComponent(pokemon.name);

                    // Append the element to the 'li'
                    pokemonLi.appendChild(pokemonLink);

                    // Append the list element to results
                    resultsDiv.appendChild(pokemonLi);
                });
            } else {
                resultsDiv.textContent = 'No results found.';
            }
        })
        .catch(error => console.error('Error:', error));
    });

</script>
</html>