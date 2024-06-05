<?php
$apikey = '47098e27938265c66f06140926079818';
$query = urlencode($_GET["q"]);

$url = "https://gnews.io/api/v4/search?q=".$query."&lang=en&country=us&max=10&apikey=$apikey";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($ch);
curl_close($ch);

echo $data;
?>