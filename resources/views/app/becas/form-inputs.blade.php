@php $editing = isset($beca) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Beca"
            value="{{ old('name', ($editing ? $beca->name : '')) }}"
            maxlength="255"
            placeholder="Ej: Beca de Enfermería"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select
            name="academic_program_id"
            label="Programa académico"
            required
        >
            @php $selected = old('academic_program_id', ($editing ? $beca->academic_program_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione el programa académico</option>
            @foreach($academicPrograms as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
