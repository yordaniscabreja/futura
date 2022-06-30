@php $editing = isset($agreement) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Nombre del convenio"
            value="{{ old('name', ($editing ? $agreement->name : '')) }}"
            maxlength="255"
            placeholder="Ej: Convenio con Universidad"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="duracion"
            label="Duración"
            value="{{ old('duracion', ($editing ? $agreement->duracion : '')) }}"
            max="255"
            placeholder="ej: 18 (meses)"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="representante"
            label="Representante"
            value="{{ old('representante', ($editing ? $agreement->representante : '')) }}"
            maxlength="255"
            placeholder="Ej: Decano Jhon Doe"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="university_id" label="Universidad" required>
            @php $selected = old('university_id', ($editing ? $agreement->university_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione una Universidad</option>
            @foreach($universities as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="tasa_interes"
            label="Tasa de Interés"
            value="{{ old('tasa_interes', ($editing ? $agreement->tasa_interes : '')) }}"
            max="255"
            placeholder="Ej: 3 %"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="tasa_descuento"
            label="Tasa de descuento"
            value="{{ old('tasa_descuento', ($editing ? $agreement->tasa_descuento : '')) }}"
            max="255"
            placeholder="Ej: 15 %"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
