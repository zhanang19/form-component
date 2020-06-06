<?php

namespace Tests;

use Zhanang19\FormComponent\View\Components\Input;

class TextFormTest extends TestCase
{
    /** @test */
    public function it_return_default_text_input()
    {
        $inputClass = Input::class;
        $inputAlias = 'form-input';
        $compiledTag = " @component('{$inputClass}', '{$inputAlias}', ['name' => '123'])\n";
        $compiledTag .= "<?php \$component->withAttributes([]); ?>\n";
        $compiledTag .= "@endcomponentClass ";

        $component = $this->getCompiledTag('<x-form-input name="123"/>');

        $this->assertSame($compiledTag, $component);
    }
}
