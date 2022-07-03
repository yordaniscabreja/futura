@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('convenios.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.convenios_universidades.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.convenios_universidades.inputs.title')</h5>
                    <span>{{ $convenio->title ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.convenios_universidades.inputs.image')</h5>
                    <x-partials.thumbnail
                        src="{{ $convenio->image ? \Storage::url($convenio->image) : '' }}"
                        size="150"
                    />
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.convenios_universidades.inputs.about')</h5>
                    <span>{{ $convenio->about ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.convenios_universidades.inputs.university_id')
                    </h5>
                    <span
                        >{{ optional($convenio->university)->name ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('convenios.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Convenio::class)
                <a href="{{ route('convenios.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
