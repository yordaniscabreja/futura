@php $editing = isset($university) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="name"
            label="Nombre de la Universidad"
            maxlength="255"
            required
            >{{ old('name', ($editing ? $university->name : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.checkbox
            name="oficial"
            label="Es oficial"
            :checked="old('oficial', ($editing ? $university->oficial : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.checkbox
            name="acreditada"
            label="Está acreditada"
            :checked="old('acreditada', ($editing ? $university->acreditada : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="city_id" label="Ciudad" required>
            @php $selected = old('city_id', ($editing ? $university->city_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione la ciudad</option>
            @foreach($cities as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.checkbox
            name="principal"
            label="Es principal"
            :checked="old('principal', ($editing ? $university->principal : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="direccion"
            label="Dirección Domicilio"
            maxlength="255"
            required
            >{{ old('direccion', ($editing ? $university->direccion : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="fundada_at"
            label="Fecha de fundación"
            value="{{ old('fundada_at', ($editing ? optional($university->fundada_at)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="egresados"
            label="Egresados"
            value="{{ old('egresados', ($editing ? $university->egresados : '')) }}"
            min="1"
            step="0.01"
            placeholder="Egresados"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="general_description"
            label="Descripción general"
            maxlength="255"
            required
            >{{ old('general_description', ($editing ?
            $university->general_description : '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <div
            x-data="imageViewer('{{ $editing && $university->logo ? \Storage::url($university->logo) : '' }}')"
        >
            <x-inputs.partials.label
                name="logo"
                label="Logo"
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
                <input type="file" name="logo" id="logo" @change="fileChosen" />
            </div>

            @error('logo') @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.url
            name="url"
            label="Web"
            value="{{ old('url', ($editing ? $university->url : '')) }}"
            maxlength="255"
            placeholder="Url"
            required
        ></x-inputs.url>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.partials.label
            name="about_video_url"
            label="Video promocional"
        ></x-inputs.partials.label
        ><br />

        <input
            type="file"
            name="about_video_url"
            id="about_video_url"
            class="form-control-file"
        />

        @if($editing && $university->about_video_url)
        <div class="mt-2">
            <a
                href="{{ \Storage::url($university->about_video_url) }}"
                target="_blank"
                ><i class="icon ion-md-download"></i>&nbsp;Download</a
            >
        </div>
        @endif @error('about_video_url')
        @include('components.inputs.partials.error') @enderror
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <div
            x-data="imageViewer('{{ $editing && $university->background_image ? \Storage::url($university->background_image) : '' }}')"
        >
            <x-inputs.partials.label
                name="background_image"
                label="Imagen de fondo"
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
                    name="background_image"
                    id="background_image"
                    @change="fileChosen"
                />
            </div>

            @error('background_image')
            @include('components.inputs.partials.error') @enderror
        </div>
    </x-inputs.group>
</div>
