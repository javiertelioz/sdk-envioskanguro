# Envioskanguro - PHP SDK
API Envios Kanguro

# Install

#Example 


```php

<?php

// Autoload files using Composer autoload
require_once __DIR__ . '/vendor/autoload.php'; 

$token = 'your_token';

$api = new EnviosKanguro\Api($token, 'development');

var_dump($api->get('balance'));

```
