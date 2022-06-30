@php $editing = isset($department) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="name"
            label="Departamento"
            maxlength="255"
            required
            >{{ old('name', ($editing ? $department->name : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="country_id" label="País" required>
            @php $selected = old('country_id', ($editing ? $department->country_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione un país</option>
            @foreach($countries as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
