<?php
    //We make the connection to API via CURL and we get the result into $response variable
    $url = "https://dogapi.dog/api/v2/breeds";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
    ]);
    $response = curl_exec($curl);
    curl_close($curl);

    //Decode the json-string that we have got from API to an associative array
    $breeds = json_decode($response, true);

    //We generate a new array with the breeds filtered
    $filteredBreeds = array_filter($breeds['data'], "filterBreed");
    foreach ($filteredBreeds as $breed){
        $attributes = $breed['attributes'];
        echo '<p><strong>Name:</strong> ' . $attributes['name'] . '</p><p><strong>Description:</strong> ' . $attributes['description'] . '</p><p><strong>Life:</strong> ' . $attributes['life']['min'] . '-' . $attributes['life']['max'] . ' years</p><p><strong>Male weight: </strong>' . $attributes['male_weight']['min'] . '-' . $attributes['male_weight']['max'] . ' kgs</p><p><strong>Female weight: </strong>' . $attributes['female_weight']['min'] . '-' . $attributes['female_weight']['max'] . ' kgs</p><br />';
    }

    //Function to filter breeds whose min life expectancy is more than 10 years
    function filterBreed($breed){
        return $breed['attributes']['life']['min'] > 10;
    }
?>
