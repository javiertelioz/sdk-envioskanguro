# Envioskanguro - PHP SDK
We help you integrate your business so you can manage your logistics more easily.


# Install
```shell
composer require javiertelioz/sdk-envioskanguro

```

## How do I use it?
To continue you need a ```token```. For more information please contact [Envios kanguro](https://envioskanguro.com/)

### Create an instance
Ej:

```php
// Autoload files using Composer autoload
require_once __DIR__ . '/vendor/autoload.php'; 

$token = 'your_token';

$api = new EnviosKanguro\Api($token, 'development');

```

# Examples

#### Making GET calls

```php

$response = $api->get('balance');

```

#### Making POST calls

```php

#this body will be converted into json for you
$body = [
    'identifier' => '#455',
    'destination' => [
        'name' => 'Nombre detinatario',
        'email' => 'email@destinatario.com',
        'home_phone' => '123-456-789',
        'cell_phone' => '123-456-789',
        'street' => 'Nombre de la calle',
        'street_number' => 'numero de la calle',
        'colony' => 'Colonia',
        'city' => 'Delegacion o municipio',
        'state' => 'Estado',
        'zip' => '54954',
        'references_1' => 'Calle uno',
        'references_2' => 'Calle dos',
        'notes' => 'Observaciones',
    ],
    'origin' => [
        'name' => 'Nombre contacto',
        'email' => 'email@contacto.com',
        'home_phone' => '123-456-789',
        'cell_phone' => '123-456-789',
        'street' => 'Nombre de la calle',
        'street_number' => 'numero de la calle',
        'colony' => 'Colonia',
        'city' => 'Delegacion o municipio',
        'state' => 'Estado',
        'zip' => '54954',
        'references_1' => 'Calle uno',
        'references_2' => 'Calle dos',
        'notes' => 'Observacione',
    ],
    'items' => [
        [
            'identifier' => 'sku1',
            'description' => 'nombre',
            'quantity' => '1',
            'weight' => '5',
            'length' => '10',
            'width' => '20',
            'height' => '15',
        ]
    ]
];

$response = $api->post('rate', $body);

```

#### Making PUT calls

```php

#this body will be converted into json for you
$body = [ 
    'rate_id' => 191
];

$response = $api->put('rate/{quote_id}', $body);
```

#### Making DELETE calls
```php
$response = $api->delete('/rate/123')
```
