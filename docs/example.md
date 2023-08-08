# Example

## routes.yml

A quick route to handle the popup form and submission

```YAML
SilverStripe\Control\Director:
  rules:
    'PopupForms//$Action': 'TestController'
```

## TestController.php

This is what's used to create the form code and handle the submission

```PHP
<?php

use SilverStripe\Forms\Form;
use SilverStripe\Control\Controller;

class TestController extends Controller
{
    private static $allowed_actions = [
        'form',
        'formAction'
    ];

    public static function form()
    {
        $form = Form::create();

        // construct form

        return $form;
    }

    public static function formAction($request)
    {
        // do something with the form data

        return 'done';
    }
}
```

## Page.php

You'll want to add this to the getCMSFields (or equivalent) function

```PHP
$customBodyJS = <<<JS
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
JS;

$customLink = '/PopupForms/form';

// Clean out newline characters from PHP
$customBodyJS = str_replace(array("\r", "\n"), '', $customBodyJS);

PopupField::create('PopupForm', 'I\'m a popup')
    ->setFormURL($customLink)
    ->setFormCustomCode($customBodyJS);
```