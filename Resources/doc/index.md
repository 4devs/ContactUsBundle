Getting Started With ContactUsBundle
===========================================

## Installation and usage

Installation and usage is a quick:

1. Download ContactUsBundle using composer
2. Enable the Bundle
3. Use the bundle


### Step 1: Download ContactUsBundle using composer

Add ContactUsBundle in your composer.json:

```js
{
    "require": {
        "fdevs/contact-us-bundle": "*"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update fdevs/contact-us-bundle
```

Composer will install the bundle to your project's `vendor/fdevs` directory.


### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new FDevs\ContactUsBundle\FDevsContactUsBundle(),
        new Misd\PhoneNumberBundle\MisdPhoneNumberBundle(),
    );
}
```

add javascripts on page

``` twig
{{ include 'FDevsContactUsBundle:Default:js.html.twig' }}
```
or

``` twig
<script src="{{ asset('bundles/fdevscontactus/js/jqBootstrapValidation.js') }}"></script>
<script src="{{ asset('bundles/fdevscontactus/js/contact_me.js') }}"></script>
```

add config

``` yaml
# app/config/config.yml
f_devs_contact_us:
    db_driver: 'mongodb'
    emails: ['andrey@company.com','victor@company.com']
    from: "mail@company.com"
```

add routing

``` yaml
# app/config/routing.yml
f_devs_contact_us:
    resource: "@FDevsContactUsBundle/Resources/config/routing.xml"
    prefix:   /{_locale}/
    defaults:
        _locale: en
    requirements:
        _locale: en|ru
```


### Step 3: Use the bundle

in your template

``` twig
{{ render(controller('FDevsContactUsBundle:Default:index')) }}
```
