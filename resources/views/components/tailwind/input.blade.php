@php
    $class = "shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-purple-500";
    $additionalAttributes = $util->hasError($name) ? ["class" => "{$class} border-red-600"] : ["class" => $class];
@endphp

<div class="mb-4 w-full">
    <label
        for="{{$attributes->get('id')}}"
        class="block text-gray-700 text-sm font-bold mb-2"
    >
        {!! $label !!}
    </label>
    {!! $form($additionalAttributes) !!}
    {!! $error('<span class="mt-1 text-red-600 text-sm">%s</span>') !!}
    {!! $helpTextSlot !!}
</div>
