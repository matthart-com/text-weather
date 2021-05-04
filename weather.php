<?php

/**
 * Text-Weather - A PHP back end for returning weather information
 * for a ZIP code received from an app.smarterwaytohire.com webhook.
 *
 * @package  weather-text
 * @author   Matt Hart <matt@smarterwaytohire.com>
 */

 // This webhook hits the openweathermap.org API to get the latest weather using
 // the ZIP code that the script requests.

 require_once(__DIR__ . '/config.php');

$raw = file_get_contents('php://input');
$json = json_decode($raw);
if (json_last_error() != JSON_ERROR_NONE) {
  header("HTTP/1.0 400 Invalid JSON");
  die();
}

// Confirm authorized caller
if (($json->apiKey ?? '') != SWTH_API_KEY) {
  header("HTTP/1.0 401 Not Authorized");
  die();
}

$zip = '';

// Find the zip code. Chat is sent FIFO, so looping through gets the latest.
$chat = $json->chat ?? [];
foreach ($chat as $c) {
  switch ($c->attribute) {
    case 'zip':
    {
      $zip = $c->text;
      break;
    }
    default:
      break;
  }
}

// Setup output
header("HTTP/1.0 200 Ok");
header('Content-Type: application/json');

// No zip code
if ($zip == '') {
  echo json_encode([]);
  die();
}

// Call the openweathermap API
$url = "https://api.openweathermap.org/data/2.5/weather?zip=$zip,us&units=imperial&appid=" . WEATHER_API_KEY;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close ($ch);

$wjson = json_decode($result);
if (json_last_error() != JSON_ERROR_NONE) {
  echo json_encode(['reply' => "Something went wrong retrieving weather for $zip zip code."]);
  die();
}

$weather = "$zip ($wjson->name) weather shows:\n" . $wjson->weather[0]->description . "\nThe temperature is " . round($wjson->main->temp) . " and feels like " . round($wjson->main->feels_like) . ".\nWeather provided by openweathermap.org";

// SWTH expects JSON results {"reply": "what to text"}
echo json_encode(['reply' => $weather]);

die();

?>
