# Validate
Input data validation library based on type (Bilioteca de validação de dados de entrada em função do tipo)

## Install
```shell
composer require ngomafortuna/validate

```

## Sintaxe end use mode
```php
Validate::get([
    "index-of-array-to-validate" => 'type-data',
], $array);
```

Options of type-date
- s: string
- i: integer
- e: e-mail
- u: url
- b: boolean
- no action

Exemple
```php
use Ngomafortuna\Validate;

$cleanData = Validate::get([
    "title" => 's',
    "img" => 'i',	
    "link" => 'u'
], $_POST);

```

## Require
Necessary PHP 7.4 or more (Necessário PHP 7.4 ou superior)

## Test
```php
require_once PATH . '/vendor/autoload.php'; // use to correct PATH dirname(__FILE__, 2) 

use Ngomafortuna\Validate\Validate;

$validate = new Validate;

$data = [
    'full_name' => 'Rosa Fortuna <?php echo 123; ?>',
    'description' => 'Your description - Sua descrição',
    'edge' => 24,
    'genre' => 'F'
];

$cleanDate = $validate->get([
    'full_name' => 's',
    'description' => 's',
    'edge' => 'i',
    'genre' => 's'
], $data);

var_dump($cleanDate);

```

