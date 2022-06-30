@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="input-group">
                        <input
                            id="indexSearch"
                            type="text"
                            name="search"
                            placeholder="{{ __('crud.common.search') }}"
                            value="{{ $search ?? '' }}"
                            class="form-control"
                            autocomplete="off"
                        />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="icon ion-md-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-right">
                @can('create', App\Models\University::class)
                <a
                    href="{{ route('universities.create') }}"
                    class="btn btn-primary"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">
                    @lang('crud.universidades.index_title')
                </h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.universidades.inputs.name')
                            </th>
                            <th class="text-left">
                                @lang('crud.universidades.inputs.oficial')
                            </th>
                            <th class="text-left">
                                @lang('crud.universidades.inputs.acreditada')
                            </th>
                            <th class="text-left">
                                @lang('crud.universidades.inputs.city_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.universidades.inputs.principal')
                            </th>
                            <th class="text-left">
                                @lang('crud.universidades.inputs.url')
                            </th>
                            <th class="text-left">
                                @lang('crud.universidades.inputs.direccion')
                            </th>
                            <th class="text-left">
                                @lang('crud.universidades.inputs.fundada_at')
                            </th>
                            <th class="text-right">
                                @lang('crud.universidades.inputs.egresados')
                            </th>
                            <th class="text-left">
                                @lang('crud.universidades.inputs.description')
                            </th>
                            <th class="text-left">
                                @lang('crud.universidades.inputs.image')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($universities as $university)
                        <tr>
                            <td>{{ $university->name ?? '-' }}</td>
                            <td>{{ $university->oficial ?? '-' }}</td>
                            <td>{{ $university->acreditada ?? '-' }}</td>
                            <td>
                                {{ optional($university->city)->name ?? '-' }}
                            </td>
                            <td>{{ $university->principal ?? '-' }}</td>
                            <td>
                                <a target="_blank" href="{{ $university->url }}"
                                    >{{ $university->url ?? '-' }}</a
                                >
                            </td>
                            <td>{{ $university->direccion ?? '-' }}</td>
                            <td>{{ $university->fundada_at ?? '-' }}</td>
                            <td>{{ $university->egresados ?? '-' }}</td>
                            <td>{{ $university->description ?? '-' }}</td>
                            <td>
                                <x-partials.thumbnail
                                    src="{{ $university->image ? \Storage::url($university->image) : '' }}"
                                />
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $university)
                                    <a
                                        href="{{ route('universities.edit', $university) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $university)
                                    <a
                                        href="{{ route('universities.show', $university) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $university)
                                    <form
                                        action="{{ route('universities.destroy', $university) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger"
                                        >
                                            <i class="icon ion-md-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="12">
                                {!! $universities->render() !!}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
