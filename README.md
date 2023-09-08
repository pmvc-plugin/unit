[![Latest Stable Version](https://poser.pugx.org/pmvc-plugin/unit/v/stable)](https://packagist.org/packages/pmvc-plugin/unit) 
[![Latest Unstable Version](https://poser.pugx.org/pmvc-plugin/unit/v/unstable)](https://packagist.org/packages/pmvc-plugin/unit) 
[![CircleCI](https://circleci.com/gh/pmvc-plugin/unit/tree/main.svg?style=svg)](https://circleci.com/gh/pmvc-plugin/unit/tree/main)
[![License](https://poser.pugx.org/pmvc-plugin/unit/license)](https://packagist.org/packages/pmvc-plugin/unit)
[![Total Downloads](https://poser.pugx.org/pmvc-plugin/unit/downloads)](https://packagist.org/packages/pmvc-plugin/unit) 

A simple phpunit wrapper let it support phpunt 4.8.35, 6.5.5, 9.5.0
===============

## In another word.
You could use is cross php version 5.5 -> 8.x

## function mapping table

phpunit                   | PMVC/unit 
--------------------------|----------
__construct               | pmvc_init
setup                     | pmvc_setup
teardown                  | pmvc_teardown
assertContains            | haveString
assertStringContainsString| haveString
assertStringContainsString| haveString
getMockBuilder            | getPMVCMockBuilder
setMethods                | pmvc_onlyMethods
onlyMethods               | pmvc_onlyMethods


## Code example

### tests/include.php example
```php
<?php

$path = __DIR__ . '/../vendor/autoload.php';
include $path;

\PMVC\Load::plug(
    ['unit' => null],
    [__DIR__ . '/../../']
);
```

### Php TestCase code example
```php
<?php

namespace PMVC\PlugIn\hell_world;

use PMVC\TestCase;

class HelloWorldTest extends TestCase
{

}
```

### CI config example
* Simple plugin
   * https://github.com/pmvc/generator-php-pmvc-plugin/blob/master/generators/app/templates/_circleci/config.yml
* More php version
   * https://github.com/pmvc/pmvc/blob/master/.circleci/config.yml
* Real CircleCI example
   * https://app.circleci.com/pipelines/github/pmvc/pmvc?branch=master

## PHPUnit Tip
* Show event
```
phpunit --log-events-text php://stdout
```

* show deprecations
```
phpunit --display-deprecations --testdox
```

* trigger PMVC dev dump
   * https://github.com/pmvc-plugin/dev/blob/master/tests/DevWithPhpUnitTest.php

* Further integration with the [dev] plugin.
   * https://github.com/pmvc-plugin/dev#debug-with-cli


## Install with Composer
### 1. Download composer
   * mkdir test_folder
   * curl -sS https://getcomposer.org/installer | php

### 2. Install by composer.json or use command-line directly
#### 2.1 Install by composer.json
   * vim composer.json
```json
{
    "require": {
        "pmvc-plugin/unit": "dev-master"
    }
}
```
   * php composer.phar install

#### 2.2 Or use composer command-line
   * php composer.phar require pmvc-plugin/unit
   * or
      * composer require pmvc-plugin/unit

## Other Polyfills
   * https://github.com/Yoast/PHPUnit-Polyfills
