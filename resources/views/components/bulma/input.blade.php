@php
    if ($util->hasError($name)) {
        $additionalAttributes = ['class' => 'input is-danger'];
    } else {
        $additionalAttributes = ['class' => 'input'];
    }
@endphp

<div class="field{{ $wrapperClass() }}">
    {!! $previewSlot !!}
    <label for="{{ $attributes->get('id') }}" class="label">
        {!! $label !!}
        {!! $labelSlot !!}
    </label>
    <div class="control">
        {!! $form($additionalAttributes) !!}
    </div>
    {!! $error('<p class="help is-danger error">%s</p>') !!}
    {!! $helpTextSlot !!}
</div>
