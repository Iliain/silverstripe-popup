<?php

namespace Iliain\Forms;

use SilverStripe\Forms\FormField;
use SilverStripe\View\Requirements;
use SilverStripe\ORM\FieldType\DBHTMLText;

class PopupField extends FormField
{
    protected$formCustomCode = null;

    protected $formURLCode = null;

    /**
     * Returns a button to trigger a popup
     *
     * @param string $name
     * @param null|string $title
     */
    public function __construct($name, $title = null, $formCustomCode = null, $formURLCode = null)
    {
        $this->setFormCustomCode($formCustomCode);
        $this->setFormURLCode($formURLCode);

        parent::__construct($name, $title);
    }

    public function setFormCustomCode($formCustomCode)
    {
        $this->formCustomCode = $formCustomCode;

        return $this;
    }

    public function setFormURLCode($formURLCode)
    {
        $this->formURLCode = $formURLCode;

        return $this;
    }

    public function getFormCustomCode()
    {
        return $this->formCustomCode;
    }

    public function getFormURLCode()
    {
        return $this->formURLCode;
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
            'customCode' => $this->getFormCustomCode(),
            'URLCode' => $this->getFormURLCode(),
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
                'type' => 'button',
                'data-dialog-title' => $this->Title()
            ]
        );

        $this->extend('updateAttributes', $attributes);

        return $attributes;
    }
}
