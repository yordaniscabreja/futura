@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('all-media.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.multimedias.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.multimedias.inputs.name')</h5>
                    <span>{{ $media->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.multimedias.inputs.university_id')</h5>
                    <span>{{ optional($media->university)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.multimedias.inputs.path')</h5>
                    <span>{{ $media->path ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.multimedias.inputs.url')</h5>
                    <a target="_blank" href="{{ $media->url }}"
                        >{{ $media->url ?? '-' }}</a
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.multimedias.inputs.media_type_id')</h5>
                    <span>{{ optional($media->mediaType)->type ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('all-media.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Media::class)
                <a href="{{ route('all-media.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
