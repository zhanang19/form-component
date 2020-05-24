<?php

namespace Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Zhanang19\FormComponent\FormBuilder;
use Zhanang19\FormComponent\FormComponentServiceProvider;
use Zhanang19\FormComponent\Util;

class TestCase extends BaseTestCase
{
    /**
     * @var \Zhanang19\FormComponent\FormBuilder
     */
    protected $formbuilder;

    /**
     * @var \Zhanang19\FormComponent\Util
     */
    protected $util;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp():void
    {
        parent::setUp();

        $this->formBuilder = new FormBuilder();
        $this->util = new Util();
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application   $app
     *
     * @return void
     */
    protected function getPackageProviders($app)
    {
        return [FormComponentServiceProvider::class];
    }
}
