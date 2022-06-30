@php $editing = isset($educationLevel) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Nivel de formación"
            value="{{ old('name', ($editing ? $educationLevel->name : '')) }}"
            maxlength="255"
            placeholder="Ej: Universitaria"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
