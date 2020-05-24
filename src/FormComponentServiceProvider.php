<?php

namespace Zhanang19\FormComponent;

use Illuminate\Support\ServiceProvider;
use Zhanang19\FormComponent\View\Components\Checkbox;
use Zhanang19\FormComponent\View\Components\Input;
use Zhanang19\FormComponent\View\Components\Radio;
use Zhanang19\FormComponent\View\Components\Select;

class FormComponentServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    /**
     * Bootstrap your package's services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/form-component'),
            ], 'views');
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'form-component');

        $this->loadViewComponentsAs('form', [
            Input::class,
            Select::class,
            Checkbox::class,
            Radio::class,
        ]);
    }
}
