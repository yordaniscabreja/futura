@php $editing = isset($campus) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="conectividad"
            label="Internet y Conectividad"
            value="{{ old('conectividad', ($editing ? $campus->conectividad : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="salones"
            label="Salones"
            value="{{ old('salones', ($editing ? $campus->salones : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="laboratorios"
            label="Laboratorios"
            value="{{ old('laboratorios', ($editing ? $campus->laboratorios : '')) }}"
            max="100"
            step="0.01"
            placeholder="Laboratorios"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="cafeterias_restaurantes"
            label="Cafeterias y Restaurantes"
            value="{{ old('cafeterias_restaurantes', ($editing ? $campus->cafeterias_restaurantes : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="espacios_comunes"
            label="Espacios Comunes"
            value="{{ old('espacios_comunes', ($editing ? $campus->espacios_comunes : '')) }}"
            max="100"
            step="0.01"
            placeholder="Espacios Comunes"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select
            name="academic_program_id"
            label="Programa académico"
            required
        >
            @php $selected = old('academic_program_id', ($editing ? $campus->academic_program_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione el Programa académico</option>
            @foreach($academicPrograms as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
