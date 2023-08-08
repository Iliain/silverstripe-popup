# Silverstripe Popup

[![Latest Stable Version](http://poser.pugx.org/iliain/silverstripe-popup/v)](https://packagist.org/packages/iliain/silverstripe-popup) 
[![Total Downloads](http://poser.pugx.org/iliain/silverstripe-popup/downloads)](https://packagist.org/packages/iliain/silverstripe-popup) 
[![Latest Unstable Version](http://poser.pugx.org/iliain/silverstripe-popup/v/unstable)](https://packagist.org/packages/iliain/silverstripe-popup) 
[![License](http://poser.pugx.org/iliain/silverstripe-popup/license)](https://packagist.org/packages/iliain/silverstripe-popup) 
[![PHP Version Require](http://poser.pugx.org/iliain/silverstripe-popup/require/php)](https://packagist.org/packages/iliain/silverstripe-popup)

Adds a popup field to the CMS, to quickly build a popup form.

Thanks to sheadawson for his original Linkable module, I was able to mimic his use of entwine to set this up. 

## Installation (with composer)

	composer require iliain/silverstripe-popup

## Config

TODO
## Usage

You can implement a PopupField like so:

```PHP
// necessary config
$customLink = '/PopupForms/form';
$customBodyJS = <<<JS
    // custom js goes here
JS;

// method A
PopupField::create('PopupForm', 'I am a popup', $customLink, $customBodyJS);

// method B
PopupField::create('PopupForm', 'I am a popup')
    ->setFormURL($customLink)
    ->setFormCustomCode($customBodyJS);
```

You will need to provide your own URL to load the form HTML from, and JS to set what the popup will do/how it will submit. This will be inserted into the existing popup form code for you. Without it, the popup will open but fail to load any content/submit. 

An example of the custom JS:

```JS
// On Button Click
this.getDialog().on('click', 'button', function () {
    $(this).addClass('loading ui-state-disabled');
});

// On Submit
this.getDialog().on('submit', 'form', function () {
    const options = {};
    options.success = function (response) {
        const button = self.getDialog().find('button');
        $(button).removeClass('loading ui-state-disabled');
    };

    $(this).ajaxSubmit(options);

    return false;
});
```

See the [docs](/docs/example.md) for a full example

## TODO

* Add more customisation functions?
* Test multiple popups active on the same page
