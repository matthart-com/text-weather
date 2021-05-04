# text-weather
Script and PHP back end integration with Smarterwaytohire.com to text a ZIP code and get the weather.

**Smarterwaytohire.com** is modern recruiting made simple! Candidates can text to apply at your business. Applications are simply scripts that you can setup to ask the right questions and confirm the answers. It's also a powerful texting chatbot that can integrate with other systems. Each sequence in a script can call a webhook with data attributes that you define.

This project shows how to setup a script with a "zip code" attribute and call a back end function that will return weather results.

1. Import `weather.json` script into your app.smarterwaytohire.com account.
2. If you don't have Webhooks enabled, contact support@smarterwaytohire.com to request Webhooks activation on your account.
3. Update `config.php` with the API Key from your SWTH account. You can find the key in Settings/Advanced Settings/API Info.
4. Update `config.php` with an API Key from openweathermap.org
5. Update the script in SWTH with your Webhook endpoint.

To test it, start an application in your SWTH account and then switch to the weather script. It also works if the weather script your default.
