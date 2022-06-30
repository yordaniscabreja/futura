@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('academic-programs.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.programas_acad_micos.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.programas_acad_micos.inputs.name')</h5>
                    <span>{{ $academicProgram->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.programas_acad_micos.inputs.snies_code')
                    </h5>
                    <span>{{ $academicProgram->snies_code ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.programas_acad_micos.inputs.acreditado')
                    </h5>
                    <span>{{ $academicProgram->acreditado ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.programas_acad_micos.inputs.credits')</h5>
                    <span>{{ $academicProgram->credits ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.programas_acad_micos.inputs.numero_duracion')
                    </h5>
                    <span>{{ $academicProgram->numero_duracion ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.programas_acad_micos.inputs.periodo_duracion')
                    </h5>
                    <span>{{ $academicProgram->periodo_duracion ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.programas_acad_micos.inputs.jornada')</h5>
                    <span>{{ $academicProgram->jornada ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.programas_acad_micos.inputs.precio')</h5>
                    <span>{{ $academicProgram->precio ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.programas_acad_micos.inputs.university_id')
                    </h5>
                    <span
                        >{{ optional($academicProgram->university)->name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.programas_acad_micos.inputs.basic_core_id')
                    </h5>
                    <span
                        >{{ optional($academicProgram->basicCore)->name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.programas_acad_micos.inputs.academic_level_id')
                    </h5>
                    <span
                        >{{ optional($academicProgram->academicLevel)->name ??
                        '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.programas_acad_micos.inputs.modality_id')
                    </h5>
                    <span
                        >{{ optional($academicProgram->modality)->name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.programas_acad_micos.inputs.education_level_id')
                    </h5>
                    <span
                        >{{ optional($academicProgram->educationLevel)->name ??
                        '-' }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('academic-programs.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\AcademicProgram::class)
                <a
                    href="{{ route('academic-programs.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
