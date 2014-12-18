[![License](https://poser.pugx.org/timitao/behatdbalextension/license.svg)](https://packagist.org/packages/timitao/behatdbalextension)
[![Latest Stable Version](https://poser.pugx.org/timitao/behatdbalextension/v/stable.svg)](https://packagist.org/packages/timitao/behatdbalextension)
[![Latest Unstable Version](https://poser.pugx.org/timitao/behatdbalextension/v/unstable.svg)](https://packagist.org/packages/timitao/behatdbalextension) 
[![Total Downloads](https://poser.pugx.org/timitao/behatdbalextension/downloads.svg)](https://packagist.org/packages/timitao/behatdbalextension)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/31b5fdd5-a66a-4f71-b9e0-b517694a3cbf/mini.png)](https://insight.sensiolabs.com/projects/31b5fdd5-a66a-4f71-b9e0-b517694a3cbf)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/timitao/behatdbalextension/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/timitao/behatdbalextension/?branch=master)
[![Build Status](https://travis-ci.org/timiTao/BehatDbalExtension.svg?branch=master)](https://travis-ci.org/timiTao/BehatDbalExtension)

Behat Dbal Extension
==============

## Installing extension

The easiest way to install is by using [Composer](https://getcomposer.org):

```bash
$> curl -sS https://getcomposer.org/installer | php
$> php composer.phar require timitao/behatdbalextension='*'
```

or composer.json

    "require": {
        "timitao/behatdbalextension": "*"
    },
    
## Configuration

Check file ``behat.yml.dist``

It is standard as for
    
    http://symfony.com/doc/current/cookbook/doctrine/dbal.html
    
## Context test

My example of test connection with given Context ``Behat\DbalExtension\ContextFeatureContext``
 
      Scenario: test
        Given Dbal load file 'file.sql'
        And Dbal truncate table "test"
        And Dbal load data to table "test" :
          | id | name  | name2 |
          | 1  | test1 | 3     |
          | 2  | test2 | 4     |
        And Dbal run sql "DELETE FROM `test` WHERE id > 1"
        And Dbal expect to have in table "test" at least:
          | name  | name2 |
          | test1 | 3     |

## Versioning
 
Staring version ``0.8.1``, will follow [Semantic Versioning v2.0.0](http://semver.org/spec/v2.0.0.html).

## Contributors

* Tomasz Kunicki [TimiTao](http://github.com/timiTao) [lead developer]
