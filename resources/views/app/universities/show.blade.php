@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('universities.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.universidades.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.universidades.inputs.name')</h5>
                    <span>{{ $university->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.universidades.inputs.oficial')</h5>
                    <span>{{ $university->oficial ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.universidades.inputs.acreditada')</h5>
                    <span>{{ $university->acreditada ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.universidades.inputs.city_id')</h5>
                    <span>{{ optional($university->city)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.universidades.inputs.principal')</h5>
                    <span>{{ $university->principal ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.universidades.inputs.url')</h5>
                    <a target="_blank" href="{{ $university->url }}"
                        >{{ $university->url ?? '-' }}</a
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.universidades.inputs.direccion')</h5>
                    <span>{{ $university->direccion ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.universidades.inputs.fundada_at')</h5>
                    <span>{{ $university->fundada_at ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.universidades.inputs.egresados')</h5>
                    <span>{{ $university->egresados ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.universidades.inputs.description')</h5>
                    <span>{{ $university->description ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.universidades.inputs.image')</h5>
                    <x-partials.thumbnail
                        src="{{ $university->image ? \Storage::url($university->image) : '' }}"
                        size="150"
                    />
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('universities.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\University::class)
                <a
                    href="{{ route('universities.create') }}"
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
