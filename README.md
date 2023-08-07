# Silverstripe Popup

Adds a popup field to the CMS, to quickly build a popup form.

Thanks to sheadawson for his original Linkable module, I was able to mimic his use of entwine to set this up. 

## Installation (with composer)

	composer require iliain/silverstripe-popup

## Config

TODO
## Usage

You can implement a PopupField like so:

```PHP
PopupField::create('PopupForm', 'I am a popup')
    ->setFormCustomCode($customBodyJS)
    ->setFormURLCode($customLinkJS)
```

You will need to provide your own JS to set the URL (the URL where the form data is loaded from) as well as the body (what the popup will do/how it will submit). These will be inserted into the existing popup form code for you. Without them, the popup will open but fail to load any content/submit. 

An example of the two:

### FormCustomCode
```JS
// On Button Click
this.getDialog().on('click', 'button#Form_testForm_action_doSubmit', function () {
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

### FormURLCode
```JS
this.setURL('/path/to/testForm');
```

See the [docs](/docs/example.md) for a examples

## TODO

* Add more customisation functions?
* Test multiple popups active on the same page
