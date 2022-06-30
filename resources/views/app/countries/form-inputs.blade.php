@php $editing = isset($country) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Pais"
            value="{{ old('name', ($editing ? $country->name : '')) }}"
            maxlength="255"
            placeholder="Ej: Colombia"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
