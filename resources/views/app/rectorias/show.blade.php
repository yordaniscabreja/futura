@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('rectorias.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.rector_as.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.rector_as.inputs.name')</h5>
                    <span>{{ $rectoria->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.rector_as.inputs.last_name')</h5>
                    <span>{{ $rectoria->last_name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.rector_as.inputs.position')</h5>
                    <span>{{ $rectoria->position ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.rector_as.inputs.image')</h5>
                    <x-partials.thumbnail
                        src="{{ $rectoria->image ? \Storage::url($rectoria->image) : '' }}"
                        size="150"
                    />
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.rector_as.inputs.university_id')</h5>
                    <span
                        >{{ optional($rectoria->university)->name ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('rectorias.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Rectoria::class)
                <a href="{{ route('rectorias.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
