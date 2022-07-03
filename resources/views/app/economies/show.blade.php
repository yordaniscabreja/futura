@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('economies.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.dimensi_n_presupuesto.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_presupuesto.inputs.financiacion')
                    </h5>
                    <span>{{ $economy->financiacion ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_presupuesto.inputs.becas_auxilio')
                    </h5>
                    <span>{{ $economy->becas_auxilio ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_presupuesto.inputs.costos_calidad')
                    </h5>
                    <span>{{ $economy->costos_calidad ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_presupuesto.inputs.costos_manutencion')
                    </h5>
                    <span>{{ $economy->costos_manutencion ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_presupuesto.inputs.costos_parqueadero')
                    </h5>
                    <span>{{ $economy->costos_parqueadero ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.dimensi_n_presupuesto.inputs.academic_program_id')
                    </h5>
                    <span
                        >{{ optional($economy->academicProgram)->name ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('economies.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Economy::class)
                <a href="{{ route('economies.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
