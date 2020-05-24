@php
    if ($util->hasError($name)) {
        $additionalWrapperClass = 'has-error';
        $additionalAttributes = ['class' => 'form-control is-invalid', 'data-error' => $error('%s')];
    } else {
        $additionalWrapperClass = null;
        $additionalAttributes = ['class' => 'form-control'];
    }
@endphp

@if ($attributes->get('horizontal'))
    <div class="form-group row mb-4{{ $wrapperClass($additionalWrapperClass) }}">
        <label for="{{ $attributes->get('id') }}" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
            {!! $label !!}
            {!! $labelSlot !!}
        </label>
        <div class="col-sm-12 col-md-7">
            {!! $form($additionalAttributes) !!}
            {!! $error('<div class="invalid-feedback error">%s</div>') !!}
            {!! $helpTextSlot !!}
        </div>
    </div>
@else
    <div class="form-group{{ $wrapperClass($additionalWrapperClass) }}">
        <label for="{{ $attributes->get('id') }}" class="control-label">
            {!! $label !!}
            {!! $labelSlot !!}
        </label>
        {!! $form($additionalAttributes) !!}
        {!! $error('<div class="invalid-feedback error">%s</div>') !!}
        {!! $helpTextSlot !!}
    </div>
@endif