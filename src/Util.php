<?php

namespace Zhanang19\FormComponent;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;

class Util
{
    /**
     * @var \Illuminate\Support\MessageBag
     */
    public $errorBag;

    /**
     * Create a new util instance.
     */
    public function __construct()
    {
        $this->errorBag = Session::get('errors', new MessageBag());
    }

    /**
     * Get form component theme from config.
     *
     * @param string|null $theme
     * @return string
     */
    public function getTheme($theme = null)
    {
        return empty($theme) ? Config::get('form-component.theme', 'bootstrap') : $theme;
    }

    /**
     * Determine if error exist for the given key.
     *
     * @param string $key
     * @return bool
     */
    public function hasError(string $key)
    {
        $formattedKey = $this->formatArrayKeyName($key);
        if ($this->errorBag->has($formattedKey)) {
            return true;
        }

        $formattedKey = $this->formatImplicitKeyName($key);
        if ($this->errorBag->has($formattedKey)) {
            return true;
        }

        return $this->errorBag->has($key);
    }

    /**
     * Get the first error from the message bag for a given key.
     *
     * @param string $key
     * @param mixed $useImplicitKey
     * @return string
     */
    public function getErrorMessage(string $key, $useImplicitKey)
    {
        // Get error from "dot" notation syntax
        $formattedKey = $this->formatArrayKeyName($key);
        if ($error = $this->errorBag->first($formattedKey)) {
            return $error;
        }

        // Get error from "dot" notation syntax, but using wildcard notation
        // This is useful to get an error from array input
        if ($useImplicitKey) {
            $formattedKey = $this->formatImplicitKeyName($key);
            if ($error = $this->errorBag->first($formattedKey)) {
                return $error;
            }
        }

        return $this->errorBag->first($key);
    }

    /**
     * Get error message.
     *
     * @param mixed $name
     * @param string $format
     * @param bool $useImplicitKey
     * @return string
     */
    public function getError($name, $format, $useImplicitKey = true)
    {
        $error = $this->getErrorMessage($name, $useImplicitKey);

        return empty($error) ? '' : sprintf($format, $error);
    }

    /**
     * Generate label text from name.
     *
     * @param string $name
     * @param string|null $label
     */
    public function generateLabelText($name, $label = null)
    {
        if (is_null($label)) {
            $label = str_replace(['_', '-', '[', ']'], [' ', ' ', '', ''], $name);
            $label = Str::title($label);
        }

        return $label;
    }

    /**
     * Generate an unique DOM id.
     * Useful for generating id on array form.
     *
     * @param string $name
     * @param string $key
     * @return string
     */
    public function generateUniqueId(string $name, string $key)
    {
        return "{$name}_{$key}";
    }

    /**
     * Return formatted class name.
     *
     * @param string $class
     * @return string
     */
    public function formatClass($class = '')
    {
        // Replace multiple space in class name
        $formattedClass = preg_replace('/\s+/', ' ', $class);

        // Make sure no duplicate class name
        $formattedClass = array_unique(explode(' ', $formattedClass));

        // Rejoin class name
        $formattedClass = implode(' ', $formattedClass);

        // Trim space in the beginning and end of class name
        $formattedClass = trim($formattedClass, ' ');

        return empty($formattedClass) ? '' : ' ' . $formattedClass;
    }

    /**
     * Generate wrapper class.
     *
     * @param string|null $wrapperClass
     * @param string|null $additionalClass
     */
    public function getWrapperClass($wrapperClass = null, $additionalClass = null)
    {
        if (!empty($additionalClass)) {
            $wrapperClass .= " {$additionalClass}";
        }

        return $this->formatClass($wrapperClass);
    }

    /**
     * Format array key name.
     *
     * @param string $key
     * @return string
     */
    public function formatArrayKeyName(string $key)
    {
        // Reformat multi-dimensional array key to use "dot" notation instead
        $key = str_replace(['[', ']'], ['.', ''], $key);

        // Remove last "dot" notation
        // Ex: `input[]` must return `input` instead of `input.`
        $key = rtrim($key, '.');

        return $key;
    }

    /**
     * Format array key name to implicit.
     *
     * @param string $key
     * @return string
     */
    private function formatImplicitKeyName($key)
    {
        $key = $this->formatArrayKeyName($key);

        // Add wildcard notation
        $key .= '.*';

        return $key;
    }
}
