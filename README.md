# Litea Env helper

This class is very simply for getting env variables

## How to install

In `composer.json`:
```json
"repositories": [
    {
      "type": "vcs",
      "url": "ssh://git@gitlab.litea.cz:2222/litea/env.git"
    }
  ]
```

and `composer reqired litea/env`

## How to use:

```php
use Litea\Utils\Env;

// ENVIRONMENT='DEV' return DEV
// default is null
$env = Env::get('ENVIRONMENT');

// if ENVIRONMENT "false || FALSE || FaLsE" -> transfer to bool false
$env = Env::get('ENVIRONMENT');

// if ENVIRONMENT "true || NULL || tRuE" -> transfer to bool true
$env = Env::get('ENVIRONMENT');

// if ENVIRONMENT "null || NULL || NuLL" -> transfer to null
$env = Env::get('ENVIRONMENT');

// if ENVIRONMENT "15" -> transfer to int 15
$env = Env::get('ENVIRONMENT');

// if ENVIRONMENT no exists return "PROD"
$env = Env::get('ENVIRONMENT', 'PROD');

// EMAILS = info@example.com;info2@example.com, return ['info@example.com', 'info2@example.com']
// default is []
$env = Env::get('EMAILS');

// change delimeter
// EMAILS = info@example.com,info2@example.com
$env = Env::get('EMAILS', ',');

// change default
// EMAILS no exists, return ['info@litea.cz']
$env = Env::get('EMAILS', Env::DELIMITER, 'info@litea.cz');
```