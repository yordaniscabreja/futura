@php $editing = isset($lifeStyle) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="ambiente"
            label="Ambiente en la U"
            value="{{ old('ambiente', ($editing ? $lifeStyle->ambiente : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="diversion_ocio"
            label="Diversión y Ocio"
            value="{{ old('diversion_ocio', ($editing ? $lifeStyle->diversion_ocio : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="descanso_relax"
            label="Descanso y Relax"
            value="{{ old('descanso_relax', ($editing ? $lifeStyle->descanso_relax : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="cultura_ecologica"
            label="Cultura Ecológica"
            value="{{ old('cultura_ecologica', ($editing ? $lifeStyle->cultura_ecologica : '')) }}"
            max="100"
            step="0.01"
            placeholder="100"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="servicio_estudiante"
            label="Servicio al Estudiante"
            value="{{ old('servicio_estudiante', ($editing ? $lifeStyle->servicio_estudiante : '')) }}"
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
            @php $selected = old('academic_program_id', ($editing ? $lifeStyle->academic_program_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione el programa</option>
            @foreach($academicPrograms as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
