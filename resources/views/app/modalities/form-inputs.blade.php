@php $editing = isset($modality) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Modalidad"
            value="{{ old('name', ($editing ? $modality->name : '')) }}"
            maxlength="255"
            placeholder="Ej: Presencial | Virtual"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
