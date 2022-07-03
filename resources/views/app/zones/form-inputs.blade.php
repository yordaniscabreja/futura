@php $editing = isset($zone) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="facilidad_transporte"
            label="Facilidad de Transporte"
            value="{{ old('facilidad_transporte', ($editing ? $zone->facilidad_transporte : '')) }}"
            max="100"
            step="0.01"
            placeholder="1100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="seguridad_zona"
            label="Seguridad de la Zona"
            value="{{ old('seguridad_zona', ($editing ? $zone->seguridad_zona : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="opciones_parqueo"
            label="Opciones de Parqueo"
            value="{{ old('opciones_parqueo', ($editing ? $zone->opciones_parqueo : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="opciones_vivir"
            label="Opciones para Vivir"
            value="{{ old('opciones_vivir', ($editing ? $zone->opciones_vivir : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="opciones_comer"
            label="Opciones para Comer"
            value="{{ old('opciones_comer', ($editing ? $zone->opciones_comer : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select
            name="academic_program_id"
            label="Programa académico"
            required
        >
            @php $selected = old('academic_program_id', ($editing ? $zone->academic_program_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione el Programa académico</option>
            @foreach($academicPrograms as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
