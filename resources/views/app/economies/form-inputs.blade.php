@php $editing = isset($economy) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="financiacion"
            label="Financiación"
            value="{{ old('financiacion', ($editing ? $economy->financiacion : '')) }}"
            min="0"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="becas_auxilio"
            label="Becas y Auxilios"
            value="{{ old('becas_auxilio', ($editing ? $economy->becas_auxilio : '')) }}"
            min="0"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="costos_calidad"
            label="Costos vs Calidad"
            value="{{ old('costos_calidad', ($editing ? $economy->costos_calidad : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="costos_manutencion"
            label="Costos de manutención"
            value="{{ old('costos_manutencion', ($editing ? $economy->costos_manutencion : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="costos_parqueadero"
            label="Costos de parqueadero"
            value="{{ old('costos_parqueadero', ($editing ? $economy->costos_parqueadero : '')) }}"
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
            @php $selected = old('academic_program_id', ($editing ? $economy->academic_program_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione el Programa académico</option>
            @foreach($academicPrograms as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
