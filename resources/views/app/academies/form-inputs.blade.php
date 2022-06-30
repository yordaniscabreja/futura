@php $editing = isset($academy) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="plan_estudio"
            label="Plan de Estudio"
            value="{{ old('plan_estudio', ($editing ? $academy->plan_estudio : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="recursos_academicos"
            label="Recursos Académicos"
            value="{{ old('recursos_academicos', ($editing ? $academy->recursos_academicos : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="tecnologia"
            label="Tecnología"
            value="{{ old('tecnologia', ($editing ? $academy->tecnologia : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="tamano_grupos"
            label="Tamaño Grupos"
            value="{{ old('tamano_grupos', ($editing ? $academy->tamano_grupos : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="excelencia_profesores"
            label="Excelencia Profesores"
            value="{{ old('excelencia_profesores', ($editing ? $academy->excelencia_profesores : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="university_id" label="Universidad" required>
            @php $selected = old('university_id', ($editing ? $academy->university_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione una universidad</option>
            @foreach($universities as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
