<?php

namespace Zhanang19\FormComponent\View\Components;

use Illuminate\Support\Facades\View;
use Illuminate\View\Component;
use Zhanang19\FormComponent\FormBuilder;
use Zhanang19\FormComponent\Util;

class Input extends Component
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
     * @var string
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
     * Type of input form.
     *
     * @var string
     */
    public $type;

    /**
     * Slot for preview.
     *
     * @var string
     */
    public $previewSlot;

    /**
     * Create a new component instance.
     *
     * @param \Zhanang19\FormComponent\Util $util
     * @param \Zhanang19\FormComponent\FormBuilder $formBuilder
     * @param string $name
     * @param mixed|null $value
     * @param string $type
     * @param string $label
     * @param string $theme
     */
    public function __construct(Util $util, FormBuilder $formBuilder, $name, $value = null, $type = 'text', $label = null, $theme = null)
    {
        $this->util = $util;
        $this->formBuilder = $formBuilder;
        $this->name = $name;
        $this->value = $value;
        $this->label = $this->util->generateLabelText($name, $label);
        $this->type = $type;
        $this->theme = $theme;
    }

    /**
     * Generate wrapper class.
     *
     * @param string|null $additionalClass
     * @return string
     */
    public function wrapperClass($additionalClass = null)
    {
        $wrapperClass = $this->attributes->get('wrapper-class');
        $this->attributes->offsetUnset('wrapper-class');

        return $this->util->getWrapperClass($wrapperClass, $additionalClass);
    }

    /**
     * Render input tag.
     *
     * @param mixed $additionalAttributes
     * @return string
     */
    public function form($additionalAttributes = [])
    {
        $attributes = $this->attributes->merge($additionalAttributes);
        $attributes = collect($attributes)->toArray();

        $input = $this->formBuilder->input($this->name, $this->value, $this->type, $attributes);

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
