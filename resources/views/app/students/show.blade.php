@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('students.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.estudiantes.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.estudiantes.inputs.user_id')</h5>
                    <span>{{ optional($student->user)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.estudiantes.inputs.academic_program_id')
                    </h5>
                    <span
                        >{{ optional($student->academicProgram)->name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.estudiantes.inputs.semestre')</h5>
                    <span>{{ $student->semestre ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('students.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Student::class)
                <a href="{{ route('students.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
