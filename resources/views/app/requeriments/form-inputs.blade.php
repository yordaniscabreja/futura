@php $editing = isset($requeriment) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Requisito"
            value="{{ old('name', ($editing ? $requeriment->name : '')) }}"
            maxlength="255"
            placeholder="Ej: Fotocopia documento de identidad 150%"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="beca_id" label="Beca" required>
            @php $selected = old('beca_id', ($editing ? $requeriment->beca_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione una beca</option>
            @foreach($becas as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
