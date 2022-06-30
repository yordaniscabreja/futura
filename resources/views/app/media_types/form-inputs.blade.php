@php $editing = isset($mediaType) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="type"
            label="Tipo de multimedia"
            value="{{ old('type', ($editing ? $mediaType->type : '')) }}"
            maxlength="255"
            placeholder="Ej: Video | Imagen"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
