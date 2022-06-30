@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('agreements.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.convenios.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.convenios.inputs.name')</h5>
                    <span>{{ $agreement->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.convenios.inputs.duracion')</h5>
                    <span>{{ $agreement->duracion ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.convenios.inputs.representante')</h5>
                    <span>{{ $agreement->representante ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.convenios.inputs.university_id')</h5>
                    <span
                        >{{ optional($agreement->university)->name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.convenios.inputs.tasa_interes')</h5>
                    <span>{{ $agreement->tasa_interes ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.convenios.inputs.tasa_descuento')</h5>
                    <span>{{ $agreement->tasa_descuento ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('agreements.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Agreement::class)
                <a
                    href="{{ route('agreements.create') }}"
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
