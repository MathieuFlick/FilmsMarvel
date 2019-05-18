<?php

function getMovieData($movieName, $movieDate) {
    $config = [
        "api_key" => "22972907f1af5f1bea5407c86e476d65",
        "movie_poster" => "http://image.tmdb.org/t/p/",
        "search" => [
            "api_url" => "https://api.themoviedb.org/3/search/movie",
        ],
        "movie" => [
            "api_url" => "https://api.themoviedb.org/3/movie",
        ]
    ];

    $parameters = [
        "api_key" => $config["api_key"],
        "query" => $movieName,
        "language" => "fr-FR",
        "primary_release_year" => $movieDate,
        "include_adult" => "true"
    ];

    $build_parameters = http_build_query($parameters);
    $build_url = $config['search']['api_url'] . '?' . $build_parameters;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $build_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);      

    $results = json_decode($output);
    $movieID = $results->results[0]->id;
    echo '<script>console.log("TMDB ID: ' . $movieID . '")</script>';
    $movieURL = $config['movie']['api_url'].'/'.$movieID. '?language=fr_FR&api_key=' . $config['api_key'];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $movieURL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $movieData = json_decode($output, JSON_PRETTY_PRINT);
    $movieResults['infos'] = $movieData;
    
    $casting_ch = curl_init();
    curl_setopt($casting_ch, CURLOPT_URL, "https://api.themoviedb.org/3/movie/".$movieID."/credits?api_key=". $config['api_key']);
    curl_setopt($casting_ch, CURLOPT_RETURNTRANSFER, 1);
    $casting_output = curl_exec($casting_ch);
    curl_close($casting_ch);
    $casting_data = json_decode($casting_output, JSON_PRETTY_PRINT);

    for ($i=0; $i <= 10; $i++) { 
        $movieResults['casting'][$i] = $casting_data['cast'][$i];
    } 

    return $movieResults;
}
?>