<?php

namespace Zhanang19\FormComponent;

use Collective\Html\FormFacade as Form;
use Illuminate\Support\Arr;

class FormBuilder
{
    /**
     * Render input tag.
     *
     * @param string $name
     * @param mixed|null $value
     * @param string $type
     * @param array $attributes
     * @return string
     */
    public function input($name, $value = null, $type = 'text', $attributes = [])
    {
        $generalInputType = [
            'text',
            'textarea',
            'tel',
            'email',
            'number',
            'search',
            'range',
            'date',
            'color',
            'month',
            'date',
            'datetime',
            'datetimeLocal',
            'time',
            'url',
            'week',
        ];

        if (in_array($type, $generalInputType)) {
            $input = Form::{$type}($name, $value, $attributes);
        } elseif (in_array($type, ['password', 'file'])) {
            $input = Form::{$type}($name, $attributes);
        } else {
            $input = Form::text($name, $value, $attributes);
        }

        return $input;
    }

    /**
     * Render select tag.
     *
     * @param string $name
     * @param mixed|null $value
     * @param array $options
     * @param array $attributes
     * @return string
     */
    public function select(string $name, $value = null, $options = [], $attributes = [])
    {
        return Form::select($name, $options, $value, $attributes);
    }

    /**
     * Render checkbox tag.
     *
     * @param string $name
     * @param mixed|null $value
     * @param array $values
     * @param array $attributes
     */
    public function checkbox($name, $value, $values = [], $attributes = [])
    {
        $isChecked = Arr::exists($values, $value);

        return Form::checkbox($name, $value, $isChecked, $attributes);
    }

    /**
     * Render radio tag.
     *
     * @param string $name
     * @param mixed $value
     * @param bool $isChecked
     * @param array $attributes
     */
    public function radio($name, $value, $isChecked = false, $attributes = [])
    {
        return Form::radio($name, $value, $isChecked, $attributes);
    }
}
