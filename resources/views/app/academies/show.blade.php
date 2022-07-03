@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('academies.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.dimensi_n_academia.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_academia.inputs.plan_estudio')
                    </h5>
                    <span>{{ $academy->plan_estudio ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_academia.inputs.recursos_academicos')
                    </h5>
                    <span>{{ $academy->recursos_academicos ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.dimensi_n_academia.inputs.tecnologia')</h5>
                    <span>{{ $academy->tecnologia ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_academia.inputs.tamano_grupos')
                    </h5>
                    <span>{{ $academy->tamano_grupos ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_academia.inputs.excelencia_profesores')
                    </h5>
                    <span>{{ $academy->excelencia_profesores ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_academia.inputs.academic_program_id')
                    </h5>
                    <span
                        >{{ optional($academy->academicProgram)->name ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('academies.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Academy::class)
                <a href="{{ route('academies.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
