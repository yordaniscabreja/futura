@php $editing = isset($academicLevel) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Nivel académico"
            value="{{ old('name', ($editing ? $academicLevel->name : '')) }}"
            maxlength="255"
            placeholder="Ej: Posgrado | Pregrado"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
