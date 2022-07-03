@php $editing = isset($internalization) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="intercambios_movilidad"
            label="Intercambios y Movilidad"
            value="{{ old('intercambios_movilidad', ($editing ? $internalization->intercambios_movilidad : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="facilidad_acceso"
            label="Facilidad de Acceso"
            value="{{ old('facilidad_acceso', ($editing ? $internalization->facilidad_acceso : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="relevancia_internacional"
            label="Relevancia Internacional"
            value="{{ old('relevancia_internacional', ($editing ? $internalization->relevancia_internacional : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="convenios_internacionales"
            label="Convenios Internacionales"
            value="{{ old('convenios_internacionales', ($editing ? $internalization->convenios_internacionales : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="segundo_idioma"
            label="Segundo Idioma"
            value="{{ old('segundo_idioma', ($editing ? $internalization->segundo_idioma : '')) }}"
            min="0"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select
            name="academic_program_id"
            label="Progrma académico"
            required
        >
            @php $selected = old('academic_program_id', ($editing ? $internalization->academic_program_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione el programa</option>
            @foreach($academicPrograms as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
