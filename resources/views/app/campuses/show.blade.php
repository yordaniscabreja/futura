@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('campuses.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.dimensi_n_campus_universitario.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_campus_universitario.inputs.conectividad')
                    </h5>
                    <span>{{ $campus->conectividad ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_campus_universitario.inputs.salones')
                    </h5>
                    <span>{{ $campus->salones ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_campus_universitario.inputs.laboratorios')
                    </h5>
                    <span>{{ $campus->laboratorios ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_campus_universitario.inputs.cafeterias_restaurantes')
                    </h5>
                    <span>{{ $campus->cafeterias_restaurantes ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_campus_universitario.inputs.espacios_comunes')
                    </h5>
                    <span>{{ $campus->espacios_comunes ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_campus_universitario.inputs.academic_program_id')
                    </h5>
                    <span
                        >{{ optional($campus->academicProgram)->name ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('campuses.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Campus::class)
                <a href="{{ route('campuses.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
