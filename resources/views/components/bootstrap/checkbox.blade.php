@php
    if ($attributes->get('switch')) {
        $className = 'custom-control-input';
    } else {
        $className = 'form-check-input';
    }
    if ($util->hasError($name)) {
        $additionalWrapperClass = 'has-error';
        $additionalAttributes = ['class' => "$className is-invalid"];
    } else {
        $additionalWrapperClass = null;
        $additionalAttributes = ['class' => "$className"];
    }
@endphp

@if ($attributes->get('horizontal'))
    <div class="form-group row mb-4{{ $wrapperClass($additionalWrapperClass) }}">
        <label for="{{ $attributes->get('id') }}" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
            {!! $label !!}
            {!! $labelSlot !!}
        </label>
        <div class="col-sm-12 col-md-7">
            @foreach ($options as $optionValue => $optionLabel)
                @php
                    $id = $util->generateUniqueId($name, $optionValue);
                    $attributesForEachOption = array_merge($additionalAttributes, ['id' => $id, 'value' => $optionValue]);
                @endphp
                <div class="form-check">
                    {!! $form($attributesForEachOption) !!}
                    <label for="{{ $id }}" class="form-check-label">
                        {!! $optionLabel !!}
                    </label>
                </div>
            @endforeach
            {!! $error('<div class="text-danger error">%s</div>') !!}
            {!! $helpTextSlot !!}
        </div>
    </div>
@else
    <div class="form-group{{ $wrapperClass($additionalWrapperClass) }}">
        <label for="{{ $attributes->get('id') }}" class="control-label">
            {!! $label !!}
            {!! $labelSlot !!}
        </label>
        
        <div id="{{ $attributes->get('id') }}">
            @foreach ($options as $optionValue => $optionLabel)
                @php
                    $id = $util->generateUniqueId($name, $optionValue);
                    $attributesForEachOption = array_merge($additionalAttributes, ['id' => $id, 'value' => $optionValue]);
                @endphp
                @if ($attributes->get('switch'))
                    <div class="custom-control custom-switch">
                        {!! $form($attributesForEachOption) !!}
                        <label for="{{ $id }}" class="custom-control-label">
                            {!! $optionLabel !!}
                        </label>
                    </div>
                @else
                    <div class="form-check">
                        {!! $form($attributesForEachOption) !!}
                        <label for="{{ $id }}" class="form-check-label">
                            {!! $optionLabel !!}
                        </label>
                    </div>
                @endif
            @endforeach
            {!! $error('<div class="text-danger error">%s</div>') !!}
            {!! $helpTextSlot !!}
        </div>
    </div>
@endif