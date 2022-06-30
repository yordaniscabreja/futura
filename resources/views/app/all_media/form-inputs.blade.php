@php $editing = isset($media) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Multimedia"
            value="{{ old('name', ($editing ? $media->name : '')) }}"
            maxlength="255"
            placeholder="Ej: Video promocional"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="university_id" label="Universidad" required>
            @php $selected = old('university_id', ($editing ? $media->university_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione la universidad</option>
            @foreach($universities as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="path"
            label="ruta"
            value="{{ old('path', ($editing ? $media->path : '')) }}"
            maxlength="255"
            placeholder="Ej: videos"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.url
            name="url"
            label="Url"
            value="{{ old('url', ($editing ? $media->url : '')) }}"
            maxlength="255"
            placeholder="ej: youtube.com"
        ></x-inputs.url>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="media_type_id" label="Tipo multimedia" required>
            @php $selected = old('media_type_id', ($editing ? $media->media_type_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione el tipo</option>
            @foreach($mediaTypes as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
