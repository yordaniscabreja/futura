@php $editing = isset($city) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="name" label="Ciudad" maxlength="255" required
            >{{ old('name', ($editing ? $city->name : '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="department_id" label="Departamento" required>
            @php $selected = old('department_id', ($editing ? $city->department_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione un departamento</option>
            @foreach($departments as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
