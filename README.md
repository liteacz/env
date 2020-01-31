# Litea Env helper

[![pipeline status](https://gitlab.litea.cz/litea/env/badges/master/pipeline.svg)](https://gitlab.litea.cz/litea/env/)
[![coverage report](https://gitlab.litea.cz/litea/env/badges/master/coverage.svg)](https://gitlab.litea.cz/litea/env/)

This class is very simply for getting env variables

## How to install

`composer reqired litea/env`

## How to use:

```php
use Litea\Utils\Env;

$env = Env::get('ENVIRONMENT'); // get ENVIRONMENT and default is null
$env = Env::get('ENVIRONMENT'); // if ENVIRONMENT "false || FALSE || FaLsE" -> transfer to bool false
$env = Env::get('ENVIRONMENT'); // if ENVIRONMENT "true || NULL || tRuE" -> transfer to bool true
$env = Env::get('ENVIRONMENT'); // if ENVIRONMENT "null || NULL || NuLL" -> transfer to null
$env = Env::get('ENVIRONMENT'); // if ENVIRONMENT "15" -> transfer to int 15
$env = Env::get('ENVIRONMENT', 'PROD'); // get ENVIRONMENT and default is PROD

// Or get array
$env = Env::getArray('EMAILS'); // in EMAILS is abc@litea.cz;ccc@litea.cz return ['abc@litea.cz', 'ccc@litea.cz']

$env = Env::getArray('EMAILS' [deafult = null, [delimeter = ';']]);
```