<?php

  // The weather.php script looks first for environment variables SWTH_API_KEY and WEATHER_API_KEY.
  // You can use that to "hide" your API keys from scripts like this.

  if (isset($_SERVER['SWTH_API_KEY'])) {
    define('SWTH_API_KEY',$_SERVER['SWTH_API_KEY']);
  } else {
    define('SWTH_API_KEY','YOUR_SMARTER_WAY_TO_HIRE_API_KEY');
  }
  if (isset($_SERVER['WEATHER_API_KEY'])) {
    define('WEATHER_API_KEY',$_SERVER['WEATHER_API_KEY']);
  } else {
    define('WEATHER_API_KEY','YOUR_OPENWEATHERMAP.ORG_API_KEY');
  }

 ?>
