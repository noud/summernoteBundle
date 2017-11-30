# Toinou97434/SummernoteBundle
This bundle provides a form type based on Summernote, a WYSIWYG editor. (A CKEditor and TinyMCE alternative and Open Source).

I had trouble installing the Pepsit36's SummernoteBundle on my Symfony 3.3.11 project so I decided to create a bundle and use his code in order to make it work in my project.
You have to know that this bundle isn't really mine but an adaptation of Pepsit36's work.

[Pepsit36/SummernoteBundle](https://github.com/Pepsit36/SummernoteBundle)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/c8aad407-e2d4-45db-89fd-1ac30c87f81b/mini.png)](https://insight.sensiolabs.com/projects/c8aad407-e2d4-45db-89fd-1ac30c87f81b)

Requirements
------------
Minimum requirements for this bundle:
* Symfony 3.*
* Twitter Bootstrap 3.0 or 4
* JQuery 1.9 (caution, if you are using JQuery3 slim, this version doesn't support ajax and you need it)

Installation
------------
**Step 1 : Downloading & installation**
You have two ways to download and install the bundle:
* **First way:** by editing your `composer.json` file and proceding to an update:
```json
{
    "require": {
        "Toinou97434/summernotebundle": "dev-master"
    }
}
```
and making your composer update:
```command
php composer.phar update
```

* **Second way:** by using composer.phar directly:
```command
php composer.phar require Toinou97434/summernotebundle
```
Composer will automatically add the bundle in your composer.json file and download it.

**Step 2 : Enable the bundle**
In your `AppKernel.php` add the following lines in order to activate the bundle:
```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Toinou\SummernoteBundle\ToinouSummernoteBundle(),
    );
}
```

**Step 3 : Import ToinouSummernoteBundle routing file**
```yml
# app/config/routing.yml
toinou_summernote:
    resource: "@ToinouSummernoteBundle/Resources/config/routing.yml"
    prefix:   /
```

**Step 4 : Entity**
This bundle is using Doctrine ORM system for the image upload system.
Even if you will not use the image upload system, you have to edit your database...

You can edit the `Entity/SummernoteImage.php` to add fields as *uploadedAt*, *updatedAt* or combine with FOSUserBundle by adding a relation to your user class. You can submit all your edits to the community, you're welcome!
After editing (or not) the class, you have to update your database schema:
```command
php bin/console doctrine:schema:udpate --dump-sql
php bin/console doctrine:schema:update --force
```
*The first line is not required but I highly recommand to execute it before forcing the database update... It will prevent any problems*

**Step 5 : Downloading the package**
This bundle isn't provided with Summernote included, you have to download it directly on [summernote's website](https://summernote.org).
After extraction of the archive, copy/paste the dist folder in the bundle or folder you want in your application. Add it by using Assets or Assetic in your template.
Or you can change it in your `config.yml` (more informations below).

**Step 6 : Bootstrap and JQuery**
The Summernote editor works with [Bootstrap](https://getbootstrap.com/) and [JQuery](http://jquery.com/download/), you have to use these libraries to make the editor work.

**Step 7 : Upload folder**
For security reasons you need to create the folder manually where the picture will be stored. The default folder is `web/uploads/images/summernote`, you can change it in your `config.yml` (more informations below).


The bundle is finally installed in your application!

Usage
-----
This bundle provides a form type you have to use with textarea.
Just add a summernote type in your form:
```php
// src/AppBundle/Form/YourFormType.php

namespace AppBundle\Form;

//...
use Toinou\SummernoteBundle\Form\Type\SummernoteType;

class YourFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add( "yourField",SummernoteType::class ); //Symfony 3
    }
}
```

In your twig template you have to import the CSS and JS needed to make summernote work:
```Twig
...
{# Toinou97434/Summernote CSS - usefull only if summernote_path is configurate with one path #}
{{ summernote_form_stylesheet(form) }}

{# Toinou97434/Summernote JS #}
{{ summernote_form_javascript(form) }}
```

Configurations
--------------
The bundle comes with customisable parameters. You can configure these parameters in the `app/config/config.yml` file.
**Initialisation:** By adding `toinou_summernote` in your `config.yml` file.
* **width and height:** (default: 0)
```yml
toinou_summernote:
    width: 0
    height: 0
```

* **focus:** This will focus on the editable area after initialisation of the Summernote widget.
```yml
toinou_summernote:
    focus: false
```

* **toolbar**: This will configure the toolbar of Summernote widget.
```yml
toinou_summernote:
    toolbar:
        - { name: 'style', buttons: ['style'] }
        - { name: 'fontsize', buttons: ['fontsize'] }
        - { name: 'font', buttons: ['bold', 'italic', 'underline', 'clear'] }
        - { name: 'fontname', buttons: ['fontname'] }
        - { name: 'color', buttons: ['color'] }
        - { name: 'para', buttons: ['ul', 'ol', 'paragraph'] }
        - { name: 'height', buttons: ['height'] }
        - { name: 'table', buttons: ['table'] }
        - { name: 'insert', buttons: ['link', 'picture', 'hr'] }
        - { name: 'view', buttons: ['fullscreen', 'codeview'] }
        - { name: 'help', buttons: ['help'] }
```

* **styleTags**: This will configure the style tags available for Summernote widget.
```yml
toinou_summernote:
    styleTags: ['p', 'blockquote', 'pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6']
```

* **fontNames**: This will configure the font names available for Summernote widget.
```yml
toinou_summernote:
    fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica Neue', 'Helvetica', 'Impact', 'Lucida Grande', 'Tahoma', 'Times New Roman', 'Verdana']
```

* **fontSizes**: This will configure the font sizes available for Summernote widget.
```yml
toinou_summernote:
    fontSizes : ['8', '9', '10', '11', '12', '14', '18', '24', '36']
```

* **colors**: This will configure the colors available for Summernote widget.
```yml
toinou_summernote:
    colors:
        - ['#000000', '#424242', '#636363', '#9C9C94', '#CEC6CE', '#EFEFEF', '#F7F7F7', '#FFFFFF']
        - ['#FF0000', '#FF9C00', '#FFFF00', '#00FF00', '#00FFFF', '#0000FF', '#9C00FF', '#FF00FF']
        - ['#F7C6CE', '#FFE7CE', '#FFEFC6', '#D6EFD6', '#CEDEE7', '#CEE7F7', '#D6D6E7', '#E7D6DE']
        - ['#E79C9C', '#FFC69C', '#FFE79C', '#B5D6A5', '#A5C6CE', '#9CC6EF', '#B5A5D6', '#D6A5BD']
        - ['#E76363', '#F7AD6B', '#FFD663', '#94BD7B', '#73A5AD', '#6BADDE', '#8C7BC6', '#C67BA5']
        - ['#CE0000', '#E79439', '#EFC631', '#6BA54A', '#4A7B8C', '#3984C6', '#634AA5', '#A54A7B']
        - ['#9C0000', '#B56308', '#BD9400', '#397B21', '#104A5A', '#085294', '#311873', '#731842']
        - ['#630000', '#7B3900', '#846300', '#295218', '#083139', '#003163', '#21104A', '#4A1031']
```

* **placeholder**: This will configure the placeholder.
```yml
toinou_summernote:
    placeholder: ''
```

* **summernote_path**: This will configure the path of summernote's folder, if false the summernote's files will be not include. (default: false)
```yml
toinou_summernote:
    summernote_path: 'resources/summernote'
```

* **images_path**: This will configure the path where images will be stored after uploading.
```yml
toinou_summernote:
    images_path: 'uploads/images/summernote'
```

* **language**: This will configure summernote's language.
```yml
toinou_summernote:
    language: 'fr_FR'
```

Contributions
-------------
You are welcome!
