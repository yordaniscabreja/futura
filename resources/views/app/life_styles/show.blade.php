@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('life-styles.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.dimensi_n_estilos_de_vida.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_estilos_de_vida.inputs.ambiente')
                    </h5>
                    <span>{{ $lifeStyle->ambiente ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_estilos_de_vida.inputs.diversion_ocio')
                    </h5>
                    <span>{{ $lifeStyle->diversion_ocio ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_estilos_de_vida.inputs.descanso_relax')
                    </h5>
                    <span>{{ $lifeStyle->descanso_relax ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_estilos_de_vida.inputs.cultura_ecologica')
                    </h5>
                    <span>{{ $lifeStyle->cultura_ecologica ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_estilos_de_vida.inputs.servicio_estudiante')
                    </h5>
                    <span>{{ $lifeStyle->servicio_estudiante ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_estilos_de_vida.inputs.university_id')
                    </h5>
                    <span
                        >{{ optional($lifeStyle->university)->name ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('life-styles.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\LifeStyle::class)
                <a
                    href="{{ route('life-styles.create') }}"
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
