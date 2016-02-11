# README

The bundle provides a [KCFinder](http://kcfinder.sunhater.com/) for [CKEditor](http://ckeditor.com/) integration for your Symfony Project

## Documentation

### Installation

This package require [kcfinder] but the composer can't load it if it's on require so add it manualy to you composer.json file:

``` php
// composer.json
"sunhater/kcfinder": "dev-master"
```

        
Require the bundle in your composer.json file:

```
$ composer require ikadoc/kcfinder-bundle --no-update
```

Register the bundle:

``` php
// app/AppKernel.php

public function registerBundles()
{
    return array(
        new Ikadoc\KCFinderBundle\IkadocKCFinderBundle(),
        // ...
    );
}
```

Install the bundle:

```
$ composer update ikadoc/kcfinder-bundle
```

Add routing:

```
// app/config/routing.yml
kcfinder:
    resource: "@IkadocKCFinderBundle/Resources/config/routing.yml"
    prefix: /admin
```


### Configuration

The bundle allow to change base_path to kcfinder folder and you can define as many configs you want. The list of all config options are available
[here](http://kcfinder.sunhater.com/install).

``` yaml
ikadoc_kc_finder:
    base_path : "%kernel.root_dir%/../vendor/sunhater/kcfinder"
    config:
        disabled : false
        uploadURL: "/uploads/"
        uploadDir: "%kernel.root_dir%/../web/uploads/"
```


## License

The Ikadoc KCFinder Bundle is under the MIT license. For the full copyright and license information, please read the
[LICENSE](/LICENSE) file that was distributed with this source code.
