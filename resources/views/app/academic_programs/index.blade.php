@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="input-group">
                        <input
                            id="indexSearch"
                            type="text"
                            name="search"
                            placeholder="{{ __('crud.common.search') }}"
                            value="{{ $search ?? '' }}"
                            class="form-control"
                            autocomplete="off"
                        />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="icon ion-md-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-right">
                @can('create', App\Models\AcademicProgram::class)
                <a
                    href="{{ route('academic-programs.create') }}"
                    class="btn btn-primary"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">
                    @lang('crud.programas_acad_micos.index_title')
                </h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.programas_acad_micos.inputs.name')
                            </th>
                            <th class="text-left">
                                @lang('crud.programas_acad_micos.inputs.snies_code')
                            </th>
                            <th class="text-left">
                                @lang('crud.programas_acad_micos.inputs.acreditado')
                            </th>
                            <th class="text-right">
                                @lang('crud.programas_acad_micos.inputs.credits')
                            </th>
                            <th class="text-right">
                                @lang('crud.programas_acad_micos.inputs.numero_duracion')
                            </th>
                            <th class="text-left">
                                @lang('crud.programas_acad_micos.inputs.periodo_duracion')
                            </th>
                            <th class="text-left">
                                @lang('crud.programas_acad_micos.inputs.jornada')
                            </th>
                            <th class="text-left">
                                @lang('crud.programas_acad_micos.inputs.precio')
                            </th>
                            <th class="text-left">
                                @lang('crud.programas_acad_micos.inputs.university_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.programas_acad_micos.inputs.basic_core_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.programas_acad_micos.inputs.academic_level_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.programas_acad_micos.inputs.modality_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.programas_acad_micos.inputs.education_level_id')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($academicPrograms as $academicProgram)
                        <tr>
                            <td>{{ $academicProgram->name ?? '-' }}</td>
                            <td>{{ $academicProgram->snies_code ?? '-' }}</td>
                            <td>{{ $academicProgram->acreditado ?? '-' }}</td>
                            <td>{{ $academicProgram->credits ?? '-' }}</td>
                            <td>
                                {{ $academicProgram->numero_duracion ?? '-' }}
                            </td>
                            <td>
                                {{ $academicProgram->periodo_duracion ?? '-' }}
                            </td>
                            <td>{{ $academicProgram->jornada ?? '-' }}</td>
                            <td>{{ $academicProgram->precio ?? '-' }}</td>
                            <td>
                                {{ optional($academicProgram->university)->name
                                ?? '-' }}
                            </td>
                            <td>
                                {{ optional($academicProgram->basicCore)->name
                                ?? '-' }}
                            </td>
                            <td>
                                {{
                                optional($academicProgram->academicLevel)->name
                                ?? '-' }}
                            </td>
                            <td>
                                {{ optional($academicProgram->modality)->name ??
                                '-' }}
                            </td>
                            <td>
                                {{
                                optional($academicProgram->educationLevel)->name
                                ?? '-' }}
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $academicProgram)
                                    <a
                                        href="{{ route('academic-programs.edit', $academicProgram) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $academicProgram)
                                    <a
                                        href="{{ route('academic-programs.show', $academicProgram) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $academicProgram)
                                    <form
                                        action="{{ route('academic-programs.destroy', $academicProgram) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger"
                                        >
                                            <i class="icon ion-md-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="14">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="14">
                                {!! $academicPrograms->render() !!}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
