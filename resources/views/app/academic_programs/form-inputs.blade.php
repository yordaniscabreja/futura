@php $editing = isset($academicProgram) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="name" label="Programa" maxlength="255" required
            >{{ old('name', ($editing ? $academicProgram->name : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="snies_code"
            label="Código SNIES"
            value="{{ old('snies_code', ($editing ? $academicProgram->snies_code : '')) }}"
            maxlength="255"
            placeholder="Snies Code"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.checkbox
            name="acreditado"
            label="Programa Acreditado"
            :checked="old('acreditado', ($editing ? $academicProgram->acreditado : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="credits"
            label="Créditos"
            value="{{ old('credits', ($editing ? $academicProgram->credits : '')) }}"
            max="255"
            placeholder="120"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="numero_duracion"
            label="Número Duración"
            value="{{ old('numero_duracion', ($editing ? $academicProgram->numero_duracion : '')) }}"
            max="255"
            placeholder="Ej: 2"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="periodo_duracion"
            label="Periodo Duración"
            value="{{ old('periodo_duracion', ($editing ? $academicProgram->periodo_duracion : '')) }}"
            maxlength="255"
            placeholder="Ej: Semestral"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="jornada"
            label="Jornada"
            value="{{ old('jornada', ($editing ? $academicProgram->jornada : '')) }}"
            maxlength="255"
            placeholder="Jornada"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="precio"
            label="Precio"
            value="{{ old('precio', ($editing ? $academicProgram->precio : '')) }}"
            maxlength="255"
            placeholder="Precio"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="university_id" label="Universidad" required>
            @php $selected = old('university_id', ($editing ? $academicProgram->university_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione una Universidad</option>
            @foreach($universities as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="basic_core_id" label="Núcleo Básico" required>
            @php $selected = old('basic_core_id', ($editing ? $academicProgram->basic_core_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione un núcleo básico</option>
            @foreach($basicCores as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select
            name="academic_level_id"
            label="Nivel Académico"
            required
        >
            @php $selected = old('academic_level_id', ($editing ? $academicProgram->academic_level_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione el Nivel Académico</option>
            @foreach($academicLevels as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="modality_id" label="Modalidad" required>
            @php $selected = old('modality_id', ($editing ? $academicProgram->modality_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione la modalidad</option>
            @foreach($modalities as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select
            name="education_level_id"
            label="Nivel de formación"
            required
        >
            @php $selected = old('education_level_id', ($editing ? $academicProgram->education_level_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione el Nivel de formación</option>
            @foreach($educationLevels as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
