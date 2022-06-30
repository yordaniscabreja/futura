@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('wellnesses.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.dimensi_n_bienestar.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_bienestar.inputs.orientacion_psicologia')
                    </h5>
                    <span>{{ $wellness->orientacion_psicologia ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_bienestar.inputs.actividades_deportivas')
                    </h5>
                    <span>{{ $wellness->actividades_deportivas ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_bienestar.inputs.actividades_culturales')
                    </h5>
                    <span>{{ $wellness->actividades_culturales ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_bienestar.inputs.plan_covid19')
                    </h5>
                    <span>{{ $wellness->plan_covid19 ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_bienestar.inputs.felicidad_entorno')
                    </h5>
                    <span>{{ $wellness->felicidad_entorno ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_bienestar.inputs.university_id')
                    </h5>
                    <span
                        >{{ optional($wellness->university)->name ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('wellnesses.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Wellness::class)
                <a
                    href="{{ route('wellnesses.create') }}"
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
