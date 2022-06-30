@php $editing = isset($basicCore) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="name"
            label="Núcleo básico"
            maxlength="255"
            required
            >{{ old('name', ($editing ? $basicCore->name : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select
            name="knowledge_area_id"
            label="Área del conocimiento"
            required
        >
            @php $selected = old('knowledge_area_id', ($editing ? $basicCore->knowledge_area_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccion un Área del conocimiento</option>
            @foreach($knowledgeAreas as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
