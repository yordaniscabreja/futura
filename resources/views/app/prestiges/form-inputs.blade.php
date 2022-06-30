@php $editing = isset($prestige) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="reputacion_institucional"
            label="Reputación Institucional"
            value="{{ old('reputacion_institucional', ($editing ? $prestige->reputacion_institucional : '')) }}"
            max="100"
            step="0.01"
            placeholder="Reputacion Institucional"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="practicas_profesionales"
            label="Prácticas Profesionales"
            value="{{ old('practicas_profesionales', ($editing ? $prestige->practicas_profesionales : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="imagen_egresado"
            label="Imágen del Egresado"
            value="{{ old('imagen_egresado', ($editing ? $prestige->imagen_egresado : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="asociaciones_externas"
            label="Asociaciones Externas"
            value="{{ old('asociaciones_externas', ($editing ? $prestige->asociaciones_externas : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="bolsa_empleo"
            label="Bolsa de Empleo"
            value="{{ old('bolsa_empleo', ($editing ? $prestige->bolsa_empleo : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="university_id" label="Universidad" required>
            @php $selected = old('university_id', ($editing ? $prestige->university_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Selecciona una universidad</option>
            @foreach($universities as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
