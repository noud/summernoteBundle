# Toinou97434/SummernoteBundle
This bundle provides a form type based on Summernote, a WYSIWYG editor. (A CKEditor and TinyMCE alternative and Open Source).

Requirements
------------
Minimum requirements for this bundle:
* Symfony 3.*
* Twitter Bootstrap 3.0 or 4
* JQuery 1.9 (caution, if you are using JQuery3 slim, this version doesn't support ajax and you need it)

Installation
------------
You have two ways to download this bundle:
* **First way**
Editing your application's `composer.json` file
```json
{
    "require": {
        // Your other bundles
        "toinou97434/summernotebundle": "dev-master"
    }
}
```
And making your composer.phar update manually:
```command
php composer.phar update
```
* **Second way**
By entering in your terminal directly this code:
```command
php composer.phar require "toinou97434/summernotebundle"
```
Composer will automatically add the bundle in your `composer.json` file and download it.

* Next you have to add Toinou97434/SummernoteBundle to your application's `AppKernel.php` file:
```php
new Toinou97434\SummernoteBundle\ToinouSummernoteBundle(),
```

* Add routing information to your application's `routing.yml`:
```yml
toinou_summernote:
    resource: "@ToinouSummernoteBundle/Resources/config/routing.yml"
    prefix:   /
```

Minimal Configuration
---------------------
This bundle is using Doctrine Entity system. You can edit the `SummernoteImage.php` to add fields as *uploadedAt*, *updatedAt* or combine with FOSUserBundle by adding a relation to your user class. You can submit all your edits to the community, you're welcome!

* After editing the class, you have to execute an update of your database to add images' entity:
```command
// The first line isn't required but I recommand to execute it and watch which edits the command will do...
php bin/console doctrine:schema:update --dump-sql
php bin/console doctrine:schema:update --force
```

* You need to download the package on summernote's website : http://summernote.org/
Extract his `dist` folder in your `web` folder. You can change it in your `config.yml` (more informations below).

* Please consider installing yourself the dependence of Summernote (Bootstrap + JQuery) in the page you'll use it. Please refer to [Bootstrap's Website](http://getbootstrap.com/getting-started/) and [JQuery's Website](http://jquery.com/download/) for more informations.
```html
<!-- include libraries(jQuery, bootstrap) -->
    <!-- Bootstrap 3 version -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css" rel="stylesheet">
    <!-- Bootstrap 4 version -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap 3 version -->
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <!-- Bootstrap 4 version -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
```

* For security reasons you need to create the folder manually where the picture will be storage. The default folder is `web/uploads/images/summernote`, you can change it in your `config.yml` (more informations below).

Additional Configuration
------------------------
Pepsit36/Summernote supports some configuration parameters. These parameters can be configured in config.yml. See below the default configuration.

* **width**: This is the width of Summernote widget (default: 0)
```yml
pepsit36_summernote:
    ...
    width: 0
```

* **height**: This is the height of Summernote widget.
```yml
pepsit36_summernote:
    ...
    height: 0
```

* **focus**: This will focus editable area after initializing Summernote widget.
```yml
pepsit36_summernote:
    ...
    focus: false
```

* **toolbar**: This will configure the toolbar of Summernote widget.
```yml
pepsit36_summernote:
    ...
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
pepsit36_summernote:
    ...
    styleTags: ['p', 'blockquote', 'pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6']
```

* **fontNames**: This will configure the font names available for Summernote widget.
```yml
pepsit36_summernote:
    ...
    fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica Neue', 'Helvetica', 'Impact', 'Lucida Grande', 'Tahoma', 'Times New Roman', 'Verdana']
```

* **fontSizes**: This will configure the font sizes available for Summernote widget.
```yml
pepsit36_summernote:
    ...
    fontSizes : ['8', '9', '10', '11', '12', '14', '18', '24', '36']
```

* **colors**: This will configure the colors available for Summernote widget.
```yml
pepsit36_summernote:
    ...
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
pepsit36_summernote:
    ...
    placeholder: ''
```

* **summernote_path**: This will configure the path of summernote's folder, if false the summernote's files will be not include. (default: false)
```yml
pepsit36_summernote:
    ...
    summernote_path: 'resources/summernote'
```

* **images_path**: This will configure the path where will be storage uploaded images.
```yml
pepsit36_summernote:
    ...
    images_path: 'uploads/images/summernote'
```

Usage
-----
Pepsit36/Summernote bundle provides a formtype. This example form uses it:

```php
class TestFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        ...
        $builder->add('test_content', SummernoteType::class);
        ...

    }
    ...

}
```

You also need to add some twig tags in your templates to import all CSS and JS needed to make summernote work: (form is your formview)
```twig
...
{# Pepsit36/Summernote CSS - usefull only if summernote_path is configurate with one path #}
{{ summernote_form_stylesheet(form) }}

{# Pepsit36/Summernote JS #}
{{ summernote_form_javascript(form) }}
```
