@php $editing = isset($benefit) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Beneficio"
            value="{{ old('name', ($editing ? $benefit->name : '')) }}"
            maxlength="255"
            placeholder="Ej: Financiación hasta doctorado"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="beca_id" label="Beca" required>
            @php $selected = old('beca_id', ($editing ? $benefit->beca_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Sleeccione una beca</option>
            @foreach($becas as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
