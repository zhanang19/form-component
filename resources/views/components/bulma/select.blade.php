@php
    if ($util->hasError($name)) {
        $additionalAttributes = ['class' => 'control is-danger', 'data-error' => $error('%s')];
    } else {
        $additionalAttributes = ['class' => 'control'];
    }
@endphp

<div class="field{{ $wrapperClass() }}">
    <label for="{{ $attributes->get('id') }}" class="label">
        {!! $label !!}
        {!! $labelSlot !!}
    </label>
    <div class="contorl">
        <div class="select">
            {!! $form($additionalAttributes) !!}
        </div>
    </div>
    {!! $error('<div class="help is-danger error">%s</div>') !!}
    {!! $helpTextSlot !!}
</div>
