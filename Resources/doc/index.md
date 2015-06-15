Getting Started With ContactUsBundle
===========================================

## Installation and usage

Installation and usage is a quick:

1. Download ContactUsBundle using composer
2. Enable the Bundle
3. Send user message by email
4. Save message to mongodb
5. Save message to your custom database
5. Custom message model and form


### Step 1: Download ContactUsBundle using composer

Add ContactUsBundle in your composer.json:

```js
{
    "require": {
        "fdevs/contact-us-bundle": "*",
        "misd/phone-number-bundle": "~1.0"
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


in your template

``` twig
{{ render(controller('FDevsContactUsBundle:Default:index')) }}
```

### Step 3: Send user message by email

####install [Symfony Swiftmailer Bundle](https://github.com/symfony/SwiftmailerBundle)
 
####add config

``` yaml
# app/config/config.yml
f_devs_contact_us:
    email:
        from: %mailer_user%
        emails: ['andrey@4devs.org','victor@4devs.org']
```


### Step 4: Save message to mongodb

#### install [Doctrine MongoDB ODM](https://github.com/doctrine/DoctrineMongoDBBundle)
 
#### add config

``` yaml
# app/config/config.yml
f_devs_contact_us:
    database:
        db_driver: 'mongodb'
```

#### use sonata admin bundle

add config

``` yaml
# app/config/config.yml
f_devs_contact_us:
    database:
        db_driver: 'mongodb'
        admin_service: 'sonata'
        
sonata_admin:
    dashboard:
        groups:
            label.contactUs:
                label_catalogue: FDevsContactUsBundle
                items:
                    - f_devs_contact_us.admin.contact_us
```

### Step 5: Save message to your custom database

create service

```php
<?php

namespace AppBundle\ModelManager;

use FDevs\ContactUsBundle\Model\ModelManagerInterface;

class MessageManager implements ModelManagerInterface
{
}
```

```xml
<service id="app.model.message_manager" class="AppBundle\ModelManager\MessageManager"/>
```

add config

``` yaml
# app/config/config.yml
f_devs_contact_us:
    database:
        model_manager:        app.model.message_manager
```

### Step 6: Custom message model and form

if you needed send email

```php
<?php

namespace AppBundle\Model;

use FDevs\ContactUsBundle\Model\EmailInterface;

class Message implements EmailInterface
{
}
```

if you don't need send email

```php
<?php

namespace AppBundle\Model;

use FDevs\ContactUsBundle\Model\MessageInterface;

class Message implements MessageInterface
{
}
```

add config

``` yaml
# app/config/config.yml
f_devs_contact_us:
    class:                AppBundle\Model\Message
    form_type:            contact_us_message #form type
    form_action:          app_contact_us_form #route name
```
