@php $editing = isset($wellness) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="orientacion_psicologia"
            label="Orientación y Psicología"
            value="{{ old('orientacion_psicologia', ($editing ? $wellness->orientacion_psicologia : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="actividades_deportivas"
            label="Actividades Deportivas"
            value="{{ old('actividades_deportivas', ($editing ? $wellness->actividades_deportivas : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="actividades_culturales"
            label="Actividades Culturales"
            value="{{ old('actividades_culturales', ($editing ? $wellness->actividades_culturales : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="plan_covid19"
            label="Plan Covid 19"
            value="{{ old('plan_covid19', ($editing ? $wellness->plan_covid19 : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="felicidad_entorno"
            label="Felicidad y Entorno"
            value="{{ old('felicidad_entorno', ($editing ? $wellness->felicidad_entorno : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="university_id" label="Universidad" required>
            @php $selected = old('university_id', ($editing ? $wellness->university_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione la universidad</option>
            @foreach($universities as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
