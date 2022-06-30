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
                @can('create', App\Models\Zone::class)
                <a href="{{ route('zones.create') }}" class="btn btn-primary">
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
                    @lang('crud.dimensi_n_zonas.index_title')
                </h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-right">
                                @lang('crud.dimensi_n_zonas.inputs.facilidad_transporte')
                            </th>
                            <th class="text-right">
                                @lang('crud.dimensi_n_zonas.inputs.seguridad_zona')
                            </th>
                            <th class="text-right">
                                @lang('crud.dimensi_n_zonas.inputs.opciones_parqueo')
                            </th>
                            <th class="text-right">
                                @lang('crud.dimensi_n_zonas.inputs.opciones_vivir')
                            </th>
                            <th class="text-right">
                                @lang('crud.dimensi_n_zonas.inputs.opciones_comer')
                            </th>
                            <th class="text-left">
                                @lang('crud.dimensi_n_zonas.inputs.university_id')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($zones as $zone)
                        <tr>
                            <td>{{ $zone->facilidad_transporte ?? '-' }}</td>
                            <td>{{ $zone->seguridad_zona ?? '-' }}</td>
                            <td>{{ $zone->opciones_parqueo ?? '-' }}</td>
                            <td>{{ $zone->opciones_vivir ?? '-' }}</td>
                            <td>{{ $zone->opciones_comer ?? '-' }}</td>
                            <td>
                                {{ optional($zone->university)->name ?? '-' }}
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $zone)
                                    <a href="{{ route('zones.edit', $zone) }}">
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $zone)
                                    <a href="{{ route('zones.show', $zone) }}">
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $zone)
                                    <form
                                        action="{{ route('zones.destroy', $zone) }}"
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
                            <td colspan="7">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">{!! $zones->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
