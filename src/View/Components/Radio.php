<?php

namespace Zhanang19\FormComponent\View\Components;

use Illuminate\Support\Facades\View;
use Illuminate\View\Component;
use Zhanang19\FormComponent\FormBuilder;
use Zhanang19\FormComponent\Util;

class Radio extends Component
{
    /**
     * @var \Zhanang19\FormComponent\Util
     */
    public $util;

    /**
     * @var \Zhanang19\FormComponent\FormBuilder
     */
    public $formBuilder;

    /**
     * Form theme.
     *
     * @var string|null
     */
    public $theme;

    /**
     * Form name.
     *
     * @var string
     */
    public $name;

    /**
     * Form label.
     *
     * @var string|null
     */
    public $label;

    /**
     * Slot for label.
     *
     * @var string
     */
    public $labelSlot;

    /**
     * Slot for help text.
     *
     * @var string
     */
    public $helpTextSlot;

    /**
     * Form value.
     *
     * @var mixed|null
     */
    public $value;

    /**
     * Form options.
     *
     * @var array
     */
    public $options;

    /**
     * Create a new component instance.
     *
     * @param mixed $name
     * @param mixed|null $value
     * @param array $options
     * @param string $label
     * @param string|null $theme
     */
    public function __construct(Util $util, FormBuilder $formBuilder, $name, $value = null, $options = [], $label = null, $theme = null)
    {
        $this->util = $util;
        $this->formBuilder = $formBuilder;
        $this->name = $name;
        $this->value = $value;
        $this->options = $options;
        $this->label = $this->util->generateLabelText($name, $label);
        $this->theme = $theme;
    }

    /**
     * Generate wrapper class.
     *
     * @param string|null $additionalClass
     */
    public function wrapperClass($additionalClass = null)
    {
        $wrapperClass = $this->attributes->get('wrapper-class');
        $this->attributes->offsetUnset('wrapper-class');

        $this->util->getWrapperClass($wrapperClass, $additionalClass);
    }

    /**
     * Render checkbox input tag.
     *
     * @param array $additionalAttributes
     * @return string
     */
    public function form($additionalAttributes = [])
    {
        $attributes = collect($this->attributes->merge($additionalAttributes));

        $value = $attributes->get('value');
        $isChecked = $this->value == $value;

        $input = $this->formBuilder->radio($this->name, $value, $isChecked, $attributes->toArray());

        return $input;
    }

    /**
     * Get error message.
     *
     * @param string $format
     * @return string
     */
    public function error($format)
    {
        return $this->util->getError($this->name, $format);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $theme = $this->util->getTheme($this->theme);
        $component = mb_strtolower(class_basename($this));

        return View::make("form-component::components.{$theme}.{$component}");
    }
}
