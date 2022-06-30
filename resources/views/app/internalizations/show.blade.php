@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('internalizations.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.dimensi_n_internacionalizaci_n.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_internacionalizaci_n.inputs.intercambios_movilidad')
                    </h5>
                    <span
                        >{{ $internalization->intercambios_movilidad ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_internacionalizaci_n.inputs.facilidad_acceso')
                    </h5>
                    <span>{{ $internalization->facilidad_acceso ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_internacionalizaci_n.inputs.relevancia_internacional')
                    </h5>
                    <span
                        >{{ $internalization->relevancia_internacional ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_internacionalizaci_n.inputs.convenios_internacionales')
                    </h5>
                    <span
                        >{{ $internalization->convenios_internacionales ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_internacionalizaci_n.inputs.segundo_idioma')
                    </h5>
                    <span>{{ $internalization->segundo_idioma ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_internacionalizaci_n.inputs.university_id')
                    </h5>
                    <span
                        >{{ optional($internalization->university)->name ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('internalizations.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Internalization::class)
                <a
                    href="{{ route('internalizations.create') }}"
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
