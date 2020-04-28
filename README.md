# Magento 2 Facebook Open Graph

Whit this module you can add the Facebook Open Graph data for products in your Magento 2 store


## Setup

You can install this module via Composer or manual setup.
To install it with composer you can insert this rows in your magento's composer.json
```
"require": {
	"ws/opengraph": "1.0.*"
    },
```
```
"repositories": {
	"m2_opengraph":{
            "type": "git",
            "url": "git@github.com:wallaceer/m2_opengraph.git"
        }
    }
```
  
After edited composer.json 
- launch composer update
- verify the module status with `bin/magento module:status | grep Ws_Opengraph`
- enable the module, if necessary, with `bin/magento module:enable Ws_Opengraph`
- run bin/magento setup:upgrade
    
For a manual installation:
* copy the module in your magento `app/code`
* run `bin/magento setup:upgrade`
* verify the module status with `bin/magento module:status | grep Ws_Opengraph`


In every case remember to launch the command `bin/magento setup:upgrade` for cleaning the cache


## Note
This module was developed with Magento 2.3.4 CE   