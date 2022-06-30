@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('zones.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.dimensi_n_zonas.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_zonas.inputs.facilidad_transporte')
                    </h5>
                    <span>{{ $zone->facilidad_transporte ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.dimensi_n_zonas.inputs.seguridad_zona')</h5>
                    <span>{{ $zone->seguridad_zona ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_zonas.inputs.opciones_parqueo')
                    </h5>
                    <span>{{ $zone->opciones_parqueo ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.dimensi_n_zonas.inputs.opciones_vivir')</h5>
                    <span>{{ $zone->opciones_vivir ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.dimensi_n_zonas.inputs.opciones_comer')</h5>
                    <span>{{ $zone->opciones_comer ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.dimensi_n_zonas.inputs.university_id')</h5>
                    <span>{{ optional($zone->university)->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('zones.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Zone::class)
                <a href="{{ route('zones.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
