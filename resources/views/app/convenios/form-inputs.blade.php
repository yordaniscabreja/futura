@php $editing = isset($convenio) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="title"
            label="Título"
            value="{{ old('title', ($editing ? $convenio->title : '')) }}"
            maxlength="255"
            placeholder="Ej: Convenio de parqueo"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <div
            x-data="imageViewer('{{ $editing && $convenio->image ? \Storage::url($convenio->image) : '' }}')"
        >
            <x-inputs.partials.label
                name="image"
                label="Imagen"
            ></x-inputs.partials.label
            ><br />

            <!-- Show the image -->
            <template x-if="imageUrl">
                <img
                    :src="imageUrl"
                    class="object-cover rounded border border-gray-200"
                    style="width: 100px; height: 100px;"
                />
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
                <div
                    class="border rounded border-gray-200 bg-gray-100"
                    style="width: 100px; height: 100px;"
                ></div>
            </template>

            <div class="mt-2">
                <input
                    type="file"
                    name="image"
                    id="image"
                    @change="fileChosen"
                />
            </div>

            @error('image') @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="about"
            label="Descripción"
            maxlength="255"
            required
            >{{ old('about', ($editing ? $convenio->about : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="university_id" label="Universidad" required>
            @php $selected = old('university_id', ($editing ? $convenio->university_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione la universidad</option>
            @foreach($universities as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
