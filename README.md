# PHP-btce-public-api-client
PHP Class for BTC-e exchange public API.

### Usage: 

Pass method of an API and array of currency pairs to constructor, and retrieve data.

### Available methods:

* info
* ticker
* depth
* trades

You may check available pairs on site.

### example.php:

```php
require_once('BTCeApiClient.php');

$class = new BTCePublicApiClient('info',array('btc_usd','ltc_usd','eth_usd'));

$data = $class->send();
```
