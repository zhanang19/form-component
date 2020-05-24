@php
    if ($util->hasError($name)) {
        $additionalAttributes = ['class' => "is-danger"];
    } else {
        $additionalAttributes = [];
    }
@endphp

<div class="field{{ $wrapperClass() }}">
    <label for="{{ $attributes->get('id') }}" class="label">
        {!! $label !!}
        {!! $labelSlot !!}
    </label>
    
    <div id="{{ $attributes->get('id') }}">
        @foreach ($options as $optionValue => $optionLabel)
            @php
                $id = $util->generateUniqueId($name, $optionValue);
                $attributesForEachOption = array_merge($additionalAttributes, ['id' => $id, 'value' => $optionValue]);
            @endphp
            <div class="control">
                <label for="{{ $id }}" class="checkbox">
                    {!! $form($attributesForEachOption) !!}
                    {!! $optionLabel !!}
                </label>
            </div>
        @endforeach
        {!! $error('<div class="help is-danger error">%s</div>') !!}
        {!! $helpTextSlot !!}
    </div>
</div>
