[![Latest Stable Version](https://poser.pugx.org/pmvc-plugin/unit/v/stable)](https://packagist.org/packages/pmvc-plugin/unit) 
[![Latest Unstable Version](https://poser.pugx.org/pmvc-plugin/unit/v/unstable)](https://packagist.org/packages/pmvc-plugin/unit) 
[![Build Status](https://travis-ci.org/pmvc-plugin/unit.svg?branch=master)](https://travis-ci.org/pmvc-plugin/unit)
[![License](https://poser.pugx.org/pmvc-plugin/unit/license)](https://packagist.org/packages/pmvc-plugin/unit)
[![Total Downloads](https://poser.pugx.org/pmvc-plugin/unit/downloads)](https://packagist.org/packages/pmvc-plugin/unit) 

A simple phpunit wrapper let it support phpunt 4.8.35, 6.5.5, 9.5.0
===============

## In another word.
You could use is cross php version 5.5 -> 8.x

## Install with Composer
### 1. Download composer
   * mkdir test_folder
   * curl -sS https://getcomposer.org/installer | php

### 2. Install by composer.json or use command-line directly
#### 2.1 Install by composer.json
   * vim composer.json
```
{
    "require": {
        "pmvc-plugin/unit": "dev-master"
    }
}
```
   * php composer.phar install

#### 2.2 Or use composer command-line
   * php composer.phar require pmvc-plugin/unit

