<?php

namespace Tests;

class TextFormTest extends Testcase
{
    /** @test */
    public function it_return_default_text_input()
    {
        $html = '<div class="form-group">';
        $html .= '<label for="" class="control-label">Name</label>';
        $html .= '<input name="name" class="form-control">';
        $html .= '</div>';

        $component = '<x-form />'; // TODO: Set HTML string compiled from blade component here

        $this->assertEquals(
            $html,
            $component
        );
    }
}
