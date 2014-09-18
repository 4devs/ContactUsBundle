Getting Started With ContactUsBundle
===========================================

## Installation and usage

Installation and usage is a quick:

1. Download ContactUsBundle using composer
2. Enable the Bundle
3. Use the bundle
4. Use Contact list


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
    admin_service: 'sonata' # if needed
    emails: ['andrey@company.com','victor@company.com']
    from: "mail@company.com"

sonata_admin:
    dashboard:
        groups:
            label.contactUs:
                label_catalogue: FDevsContactUsBundle
                items:
                    - f_devs_contact_us.admin.contact_us
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

### Step 4: Use contact list

insert in page contact by contact Name
``` twig
{{ render(controller('f_devs_contact_us.controller.contact:contactAction',{'name':'contactName'})) }}
{# or #}
{{ render(controller('f_devs_contact_us.controller.contact:contactAction',{'name':'contactName','tplContact':'AcmeDemoBundle:Contact:contact.html.twig'})) }}
{# or #}
{{ render(controller('f_devs_contact_us.controller.contact:contactAction',{'name':'contactName','tplConnect':'AcmeDemoBundle:Contact:connect.html.twig'})) }}
```

insert in page contact list
``` twig
{{ render(controller('f_devs_contact_us.controller.contact:listAction')) }}
{# or #}
{{ render(controller('f_devs_contact_us.controller.contact:listAction',{'tplContact':'AcmeDemoBundle:Contact:contact.html.twig'})) }}
{{ render(controller('f_devs_contact_us.controller.contact:listAction',{'tplList':'AcmeDemoBundle:Contact:list.html.twig'})) }}
{{ render(controller('f_devs_contact_us.controller.contact:listAction',{'tplConnect':'AcmeDemoBundle:Contact:connect.html.twig'})) }}
{{ render(controller('f_devs_contact_us.controller.contact:listAction',{'tplList':'AcmeDemoBundle:Contact:list.html.twig','tplContact':'AcmeDemoBundle:Contact:contact.html.twig'})) }}
```

### Step 5: Add/replace Tpl to connect type

add template

``` twig
{# AcmeDemoBundle:Default:connect.html.twig #}
{% extends 'FDevsContactUsBundle:Contact:connect.html.twig' %}

{% block skype %}
    <script type="text/javascript" src="http://www.skypeassets.com/i/scom/js/skype-uri.js"></script>
    <div id="SkypeButton_Call_yourname_1">
      <script type="text/javascript">
        Skype.ui({
          "name": "dropdown",
          "element": "SkypeButton_Call_yourname_1",
          "participants": ["yourname"],
          "imageSize": 32
        });
      </script>
    </div>
{% endblock skype %}
```

add config
    
``` yaml
# app/config/config.yml
f_devs_contact_us:
    tpl:
        connect: "AcmeDemoBundle:Default:connect.html.twig"
```
