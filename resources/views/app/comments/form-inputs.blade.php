@php $editing = isset($comment) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="comment"
            label="Comentario"
            value="{{ old('comment', ($editing ? $comment->comment : '')) }}"
            maxlength="255"
            placeholder="Ej: La UNI está buenísima"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="student_id" label="Estudiante" required>
            @php $selected = old('student_id', ($editing ? $comment->student_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Seleccione un estudiante</option>
            @foreach($students as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
