@php $editing = isset($knowledgeArea) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="name"
            label="Área de conocimiento"
            maxlength="255"
            required
            >{{ old('name', ($editing ? $knowledgeArea->name : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
