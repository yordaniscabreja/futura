@php $editing = isset($bond) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Bono"
            value="{{ old('name', ($editing ? $bond->name : '')) }}"
            maxlength="255"
            placeholder="Ej: Bono Spotify"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="agreement_id" label="Convenio" required>
            @php $selected = old('agreement_id', ($editing ? $bond->agreement_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione el convenio</option>
            @foreach($agreements as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
