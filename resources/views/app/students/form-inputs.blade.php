@php $editing = isset($student) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="user_id" label="Usuario" required>
            @php $selected = old('user_id', ($editing ? $student->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione el usuario</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select
            name="academic_program_id"
            label="Programa académico"
            required
        >
            @php $selected = old('academic_program_id', ($editing ? $student->academic_program_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione el Programa académico</option>
            @foreach($academicPrograms as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="semestre"
            label="Semestre"
            value="{{ old('semestre', ($editing ? $student->semestre : '')) }}"
            min="1"
            max="30"
            placeholder="Ej: 8"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
