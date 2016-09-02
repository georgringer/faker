# TYPO3 CMS Extension `faker`

[![Build Status](https://travis-ci.org/georgringer/faker.svg?branch=master)](https://travis-ci.org/georgringer/faker)

This extensions uses https://github.com/fzaninotto/Faker

## Requirements

- TYPO3 CMS 7.6+
- PHP 5.6 - 7
- License: GPL 2

## Manual

After installation you can run the faker by using 

```
./typo3/cli_dispatch.phpsh extbase faker:run --table=tx_news_domain_model_news --pid=113 --amount=20
```

### Configuration

You need to configure any table and field which should be filled by the Faker. 

TBD, until then check out the configuration inside the ext.