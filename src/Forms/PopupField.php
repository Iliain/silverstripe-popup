<?php

namespace Iliain\Forms;

use SilverStripe\Forms\FormField;
use SilverStripe\View\Requirements;
use SilverStripe\ORM\FieldType\DBHTMLText;

class PopupField extends FormField
{
    protected $formURL = null;
    
    protected$formCustomCode = null;

    /**
     * Returns a button to trigger a popup
     *
     * @param string $name
     * @param null|string $title
     */
    public function __construct($name, $title = null, $formURL = null, $formCustomCode = null)
    {
        $this->setFormURL($formURL);
        $this->setFormCustomCode($formCustomCode);

        parent::__construct($name, $title);
    }

    public function setFormURL($formURL)
    {
        $this->formURL = $formURL;

        return $this;
    }

    public function setFormCustomCode($formCustomCode)
    {
        $this->formCustomCode = $formCustomCode;

        return $this;
    }

    public function getFormURL()
    {
        return $this->formURL;
    }

    public function getFormCustomCode()
    {
        return $this->formCustomCode;
    }

    /**
     * Return field
     *
     * @param array $properties
     * @return DBHTMLText
     */
    public function Field($properties = [])
    {
        $vars = [
            'buttonID' => $this->ID(),
            'URL' => $this->getFormURL(),
            'customCode' => $this->getFormCustomCode()
        ];

        Requirements::javascriptTemplate('iliain/silverstripe-popup:client/js/popup-field.js', $vars);
        
        return parent::Field($properties);
    }

    public function getAttributes()
    {
        $attributes = array_merge(
            parent::getAttributes(),
            [
                'class' => 'btn btn-info font-icon-torso popup-field-button',
                'type' => 'button'
            ]
        );

        $this->extend('updateAttributes', $attributes);

        return $attributes;
    }
}
