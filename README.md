# Validate
Input data validation library based on type (Bilioteca de validação de dados de entrada em função do tipo)


## Sintaxe
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

