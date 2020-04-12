$('#search-form').submit((e) => {
    e.preventDefault();
    const searchValue = $('#search-input').val();
    $.get('getFilmsList.php', {searchString: searchValue})
    .done(res => {
        document.getElementById("film_list").innerHTML = res;
    })
})

$("#genre-filter").change((e) => {
    const genreValue = $('#genre-filter').val();
    const countryValue = $('#country-filter').val();
    $.get('filterByGenre.php', {genreValue, countryValue})
    .done(res => {
        document.getElementById("film_list").innerHTML = res;
    })
});

$("#country-filter").change((e) => {
    const genreValue = $('#genre-filter').val();
    const countryValue = $('#country-filter').val();
    $.get('filterByCountry.php', {genreValue, countryValue})
    .done(res => {
        document.getElementById("film_list").innerHTML = res;
    })
});