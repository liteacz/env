# Litea Env helper

[![pipeline status](https://gitlab.litea.cz/litea/env/badges/master/pipeline.svg)](https://gitlab.litea.cz/litea/env/commits/master)

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

$env = Env::get('ENVIRONMENT') // get ENVIRONMENT and default is null
$env = Env::get('ENVIRONMENT') // if ENVIRONMENT "false || FALSE || FaLsE" -> transfer to bool false
$env = Env::get('ENVIRONMENT') // if ENVIRONMENT "true || NULL || tRuE" -> transfer to bool true
$env = Env::get('ENVIRONMENT') // if ENVIRONMENT "null || NULL || NuLL" -> transfer to null
$env = Env::get('ENVIRONMENT') // if ENVIRONMENT "15" -> transfer to int 15
$env = Env::get('ENVIRONMENT', 'PROD') // get ENVIRONMENT and default is PROD
```