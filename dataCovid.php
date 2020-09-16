<?php
	$url = 'https://api.covid19api.com/total/country/peru'; // path del Json
	$data = file_get_contents($url); // poner el contenido en una variable
    $dataCovid = json_decode($data, true);
    
?>