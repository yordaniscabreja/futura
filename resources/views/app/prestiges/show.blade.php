@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('prestiges.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.dimensi_n_prestigio.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_prestigio.inputs.reputacion_institucional')
                    </h5>
                    <span
                        >{{ $prestige->reputacion_institucional ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_prestigio.inputs.practicas_profesionales')
                    </h5>
                    <span>{{ $prestige->practicas_profesionales ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_prestigio.inputs.imagen_egresado')
                    </h5>
                    <span>{{ $prestige->imagen_egresado ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_prestigio.inputs.asociaciones_externas')
                    </h5>
                    <span>{{ $prestige->asociaciones_externas ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_prestigio.inputs.bolsa_empleo')
                    </h5>
                    <span>{{ $prestige->bolsa_empleo ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_prestigio.inputs.academic_program_id')
                    </h5>
                    <span
                        >{{ optional($prestige->academicProgram)->name ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('prestiges.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Prestige::class)
                <a href="{{ route('prestiges.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
