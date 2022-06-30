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
        <x-inputs.select name="university_id" label="University" required>
            @php $selected = old('university_id', ($editing ? $internalization->university_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the University</option>
            @foreach($universities as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
